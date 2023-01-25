<?php

namespace App\Filters;

use App\Models\UsuarioModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default, it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null $arguments
     *
     * @return RedirectResponse
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->has('id')) {
            $persona = (new UsuarioModel())->buscarUsuarioPorCorreo(session()->get('correo'));
            if (!$persona)
                $this->redireccionarLogin();

            $encrypt = service('encrypter');
            $grupoAsignadoUsuario = (new UsuarioModel())->obtenerGrupoUsuario($encrypt->decrypt(session()->get('id')));
            if (!$grupoAsignadoUsuario)
                $this->redireccionarLogin();

            $data = false;
            if (!in_array('superadmin', $this->objectoAVector($grupoAsignadoUsuario))) {
                foreach ($this->objectoAVector($grupoAsignadoUsuario) as $item) {
                    $respuesta = in_array($item, $arguments);
                    if ($respuesta) {
                        $data = true;
                        break;
                    }
                    throw PageNotFoundException::forPageNotFound();
                }
            }
        } else {
            if (session()->has('id'))
                session()->destroy();
            return redirect()->to(base_url('login'));
        }
    }

    protected function redireccionarLogin(): RedirectResponse
    {
        if (session()->has('id'))
            session()->destroy();
        return redirect()->to(base_url('login'));
    }
    private function objectoAVector($objecto): array
    {
        $aux = [];
        foreach ($objecto as $object) {
            $aux[] = $object->nombre_grupo;
        }
        return $aux;
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array|null $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
