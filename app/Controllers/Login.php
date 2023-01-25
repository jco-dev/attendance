<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use ReflectionException;

class Login extends BaseController
{
    protected UsuarioModel $usuarioModel;
    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
    }

    public function index()
    {
        if (session()->has('id')) {
            return redirect()->to(base_url(route_to('marcado')));
        }
        return view('login');
    }

    /**
     * @throws ReflectionException
     */
    public function authenticate(): \CodeIgniter\HTTP\RedirectResponse
    {
        $usuario = $this->usuarioModel->buscarUsuarioPorCorreo(trim($this->request->getPost('correo')));
        if (is_null($usuario))
        {
            return redirect()->back()->with(
                'msg',
                "Error al ingresar por favor intente nuevamente con sus datos registrados"
            );
        }

        if(!password_verify($this->request->getPost('clave'), $usuario->clave))
        {
            return redirect()->back()->with(
                'msg',
                "Error al ingresar al sistema de control de asistencia"
            );
        }
        $this->registrarActividad($usuario->id);
        $grupo = 'usuario';
        if($grupoUsuario = $this->usuarioModel->obtenerGrupoUsuario($usuario->id))
            $grupo = $grupoUsuario[0]->nombre_grupo;

        $encrypt  = service('encrypter');
        session()->set([
            'id'        => $encrypt->encrypt($usuario->id),
            'correo'    => $usuario->correo,
            'nombres'   => $usuario->nombres,
            'paterno'   => $usuario->paterno,
            'materno'   => $usuario->materno,
            'celular'   => $usuario->celular,
            'grupo'     => $encrypt->encrypt($grupo)
        ]);

        return redirect()->route('marcado')
            ->with('msg', "Bienvenido al sistema {$usuario->nombres} {$usuario->paterno}")
            ->with('titulo', "Sistema de Control de Asistencia")
            ->with('icono', 'success');
    }

    /**
     * @throws ReflectionException
     */
    private function registrarActividad($persona_id)
    {
        $actividadInicioSesion = model('App\Models\ActividadInicioSesionModel');
        $actividadInicioSesion->save([
            'usuario_id' => $persona_id,
            'agente'     => $this->getUserAgentInfo(),
            'ip' => $this->request->getIPAddress(),
            'hora_inicio_sesion' => date('Y-m-d H:i:s'),
            'estado' => 'REGISTRADO',
        ]);
        $actividad_inicio_sesion_id = $actividadInicioSesion->getInsertID();
        if($actividad_inicio_sesion_id)
            session()->set(['actividad_inicio_sesion_id' => $actividad_inicio_sesion_id]);
    }

    public function getUserAgentInfo(): string
    {
        $agent = $this->request->getUserAgent();
        if ($agent->isBrowser()) {
            $currentAgent = $agent->getBrowser() . ' ' . $agent->getVersion() . '/' . $agent->getPlatform();
        } elseif ($agent->isRobot()) {
            $currentAgent = $agent->getRobot();
        } elseif ($agent->isMobile()) {
            $currentAgent = $agent->getMobile();
        } else {
            $currentAgent = 'Unidentified User Agent';
        }
        return $currentAgent;
    }

    /**
     * @throws ReflectionException
     */
    public function salir(): \CodeIgniter\HTTP\RedirectResponse
    {
        $session = session();
        $this->registrarSalida();
        $session->destroy();
        return redirect()->to(base_url('login'));
    }

    /**
     * @throws ReflectionException
     */
    private function registrarSalida()
    {
        $actividadInicioSesion = model('App\Models\ActividadInicioSesionModel');
        $actividadInicioSesion->update(['id' => session()->get('actividad_inicio_sesion_id')], [
            'hora_cierre_sesion' => date('Y-m-d H:i:s')
        ]);
    }
}
