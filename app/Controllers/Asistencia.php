<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AsignacionHorarioModel;
use App\Models\AsistenciaModel;
use App\Models\PersonaModel;
use App\Models\TurnoModel;
use Exception;
use ReflectionException;

class Asistencia extends BaseController
{
    public $model;

    public function __construct()
    {
        $this->model = new AsistenciaModel();
    }

    public function index(): string
    {
        return view('asistencia/marcado');
    }

    /**
     * @throws Exception
     */
    public function marcado()
    {
        if (!empty($this->verificarInicioSesion()))
            return $this->response->setJSON($this->verificarInicioSesion());

        $ci = trim($this->request->getPost('ci'));

        $persona = $this->verificarRegistroPersona($ci);
        if (!empty($persona))
            return $this->response->setJSON($persona);

        $asignacion = $this->verificarAsignacionHorario($ci);
        if (!empty($asignacion))
            return $this->response->setJSON($asignacion);

        $oficina = $this->obtenerIpOficina($ci);
        if ($this->request->getIPAddress() != $oficina->ip) {
            return $this->response->setJSON([
                'compuesto' => true,
                'icono'     => 'error',
                'titulo'    => "Marcado Asistencia",
                'button'    => 'danger',
                'msg'       => "Error al marcar su asistencia verifique con el administrador."
            ]);
        }

        $respuesta = $this->determinarSiEsEntradaSalida($this->buscarOficinaPersona($ci));
        switch ($respuesta) {
            case 'ENTRADA':
                $respuesta = $this->registrarEntrada($ci);
                return $this->response->setJSON($respuesta);
                break;
            case 'SALIDA':
                $persona = (new PersonaModel())->where('ci', $ci)->first();
                $asignacion = (new AsignacionHorarioModel())->where(['persona_id' => $persona->id, 'estado' => 'REGISTRADO'])->first();
                if (!$this->model->where("asignacion_horario_id", $asignacion->id)->where("fecha", date('Y-m-d'))->first()) {
                    return $this->response->setJSON([
                        'compuesto' => true,
                        'icono'      => 'error',
                        'titulo'    => "Control de Asistencia",
                        'button'    => "danger",
                        'msg'       => "<strong>{$persona->nombres} {$persona->paterno} {$persona->materno}</strong><br>No ha marcado la entrada, marque su entrada con el administrador para marcar la salida."
                    ]);
                }

                $asistencia = $this->model->where("asignacion_horario_id", $asignacion->id)->where("fecha", date('Y-m-d'))->first();
                $turno = $this->buscarOficinaPersona($ci);
                if($this->verificarHora($turno->salida, date("H:i:s"))){
                    $respuesta = $this->marcarSalida($asistencia->salida, $asistencia->id, $persona);
                    return $this->response->setJSON($respuesta);
                }else{
                    // Salida con confimación //
                    $salida = $turno->salida;
                    $hora   = date('H:i:s');
                    $date1 = new \DateTime($salida);
                    $date2 = new \DateTime($hora);
                    $intervalo = $date1->diff($date2);
                    $hora = $this->getFormat($intervalo);
                    return $this->response->setJSON([
                        'confirmado'    => true,
                        'icono'         => 'info',
                        'titulo'        => 'Control de Asistencia',
                        'msg'           => "Falta {$hora} para cumplir su horario asignado.<br><strong>¿Está seguro de marcar la salida?</strong>",
                        'id'            => $asistencia->id
                    ]);
                }

                break;
            case 'FUERA DE HORARIO':
                $persona = (new PersonaModel())->where('ci', $ci)->first();
                return $this->response->setJSON(
                    [
                        'simple'    => true,
                        'icono'      => 'error',
                        'titulo'    => "Control de Asistencia",
                        'msg'   => "<strong>{$persona->nombres}  {$persona->paterno} {$persona->materno}</strong><br>No estás dentro del horario asignado."
                    ]
                );
                break;
            default:
                return $this->response->setJSON([
                    'compuesto' => true,
                    'icono'     => 'error',
                    'titulo'    => "Marcado Asistencia",
                    'button'    => "danger",
                    'msg'   => "Error al marcar su asistencia. Por favor verificar su hora de entrada y salida con el administrador!."
                ]);
                break;
        }
    }

    private function verificarInicioSesion(): array
    {
        if (!session()->has('nombres'))
            return [
                'simple' => false,
                'msg' => 'No ha iniciado sesión en el sistema'
            ];
        return [];
    }

    private function verificarRegistroPersona($ci): array
    {
        $persona = (new PersonaModel())->where('ci', $ci)->first();
        if (!$persona)
            return [
                'compuesto' => true,
                'titulo'    => 'Error no registrado',
                'icono'     => 'warning',
                'button'    => 'warning',
                'msg'       => "El CI: {$ci} no está registrado en el sistema."
            ];

        return [];
    }

    private function verificarAsignacionHorario($ci): array
    {
        $persona = (new PersonaModel())->where('ci', $ci)->first();
        $asignacion = (new AsignacionHorarioModel())->where(['persona_id' => $persona->id, 'estado' => 'REGISTRADO'])->first();
        if ($asignacion) {
            // verificar horario de asignación //
            if (!$this->verificarRangoFecha($asignacion->fecha_inicio, $asignacion->fecha_fin, date('Y-m-d'))) {
                $msg = [
                    'compuesto' => true,
                    'titulo'    => 'Asignación de Horario',
                    'icono'     => 'error',
                    'button'    => 'danger',
                    'msg'       => "{$persona->nombres} {$persona->paterno} con CI: {$persona->ci} {$persona->expedido}<br>Su asignación de horario ha expirado, por favor consulte con el administrador."
                ];
            } else $msg = [];
        } else
            $msg = [
                'compuesto' => true,
                'titulo'    => 'Asignación de Horario',
                'icono'     => 'error',
                'button'    => 'danger',
                'msg'       => "{$persona->nombres} {$persona->paterno} con CI: {$persona->ci} {$persona->expedido} <br>No tiene asignación de horario vigente."
            ];

        return $msg;

    }

    private function verificarRangoFecha($fecha_inicio, $fecha_fin, $fecha): bool
    {
        $fecha_inicio = strtotime($fecha_inicio);
        $fecha_fin = strtotime($fecha_fin);
        $fecha = strtotime($fecha);
        return (($fecha >= $fecha_inicio) && ($fecha <= $fecha_fin));
    }

    public function obtenerIpOficina($ci)
    {
        $persona = (new PersonaModel())->where('ci', $ci)->first();
        return $this->model->obtenerIpOficina($persona->id);
    }

    public function buscarOficinaPersona($ci)
    {
        $persona = (new PersonaModel())->where('ci', $ci)->first();
        $asignacion = (new AsignacionHorarioModel())->where(['persona_id' => $persona->id, 'estado' => 'REGISTRADO'])->first();
        return (new TurnoModel())->find($asignacion->turno_id);
    }

    /**
     * @throws Exception
     */
    public function determinarSiEsEntradaSalida($turno): string
    {
        $tipo = '';

        $resp = $this->verificarRangoFecha(
            $this->cambiarHoraMinutoSegundo(date('Y-m-d') . ' ' . $turno->entrada, '-1 hours'),
            $this->cambiarHoraMinutoSegundo(date('Y-m-d') . ' ' . $turno->salida, '+6 hours'),
            date("Y-m-d H:i:s")
        );

        if (!$resp) {
            $tipo = 'FUERA DE HORARIO';
        } else {
            if ($this->verificarRangoFecha(
                $this->cambiarHoraMinutoSegundo(date('Y-m-d') . ' ' . $turno->entrada, '-1 hours'),
                $this->cambiarHoraMinutoSegundo(date('Y-m-d') . ' ' . $turno->entrada, '+2 hours'),
                date("Y-m-d H:i:s")
            ))
                $tipo = 'ENTRADA';
            else
                $tipo = 'SALIDA';
        }
        return $tipo;
    }

    /**
     * @throws Exception
     */
    private function cambiarHoraMinutoSegundo($fecha, $agregar): string
    {
        $fechaIn = new \DateTime($fecha);
        $fechaIn->modify($agregar);
        return $fechaIn->format('Y-m-d H:i:s');
    }

    private function verificarHora($horaVerificar, $horaActual): bool
    {
        $salida = strtotime($horaVerificar);
        $actual = strtotime($horaActual);
        return ($actual >= $salida);
    }

    /**
     * @throws ReflectionException
     */
    private function marcarSalida($salida, $asistencia_id, $persona): array
    {
        if($salida !== NULL)
        {
            return [
                'simple' => true,
                'icono'  => 'info',
                'titulo' => "Marcado",
                'msg'    => "{$persona->nombres} {$persona->paterno}<br>Ya está registrado su salida de hoy."
            ];
        }
        $respuesta = $this->model->update($asistencia_id,['salida' => date('Y-m-d H:i:s')]);
        if ($respuesta){
            $msg =  [
                'simple' => true,
                'icono'  => 'success',
                'titulo' => "Control de Asistencia",
                'msg'    => "<strong>{$persona->nombres} {$persona->paterno}</strong><br>Salida registrado correctamente."
            ];
        }else{
            $msg =  [
                'simple' => true,
                'icono'  => 'error',
                'titulo' => "Control de Asistencia",
                'msg'    => "<strong>{$persona->nombres} {$persona->paterno}</strong><br>Error al registrar la salida."
            ];
        }

        return $msg;
    }

    public function getFormat($df): string
    {
        $str = "";
        if ($df->y > 0)
            $str .= ($df->y > 1) ? $df->y . ' años ' : $df->y . ' año ';
        if ($df->m > 0)
            $str .= ($df->m > 1) ? $df->m . ' meses ' : $df->m . ' mes ';
        if ($df->d > 0)
            $str .= ($df->d > 1) ? $df->d . ' días ' : $df->d . ' día ';
        if ($df->h > 0)
            $str .= ($df->h > 1) ? $df->h . ' horas ' : $df->h . ' hora ';
        if ($df->i > 0)
            $str .= ($df->i > 1) ? $df->i . ' minutos ' : $df->i . ' minuto ';
        return $str;
    }

    /**
     * @throws ReflectionException
     */
    private function registrarEntrada($ci): array
    {
        $persona = (new PersonaModel())->where('ci', $ci)->first();
        $asignacion = (new AsignacionHorarioModel())->where(['persona_id' => $persona->id, 'estado' => 'REGISTRADO'])->first();
        if($this->verificarMarcadoHoy($asignacion)){
            return  [
                'simple'    => true,
                'icono'     => 'info',
                'titulo'    => 'Control de Asistencia Entrada',
                'msg'       => "<strong>{$persona->nombres} {$persona->paterno}</strong><br>La entrada de hoy ya está registrado."
            ];
        }else{
            $encrypt  = service('encrypter');
            if($this->model->insert([
                'asignacion_horario_id' => $asignacion->id,
                'usuario_id'            => $encrypt->decrypt(session()->get('id')),
                'entrada'               => date('Y-m-d H:i:s'),
                'fecha'                 => date('Y-m-d'),
            ]))
                $msg = [
                    'simple'        => true,
                    'icono'         => 'success',
                    'titulo'        => "Control de Asistencia Entrada",
                    'msg'           => "<strong>{$persona->nombres} {$persona->paterno}</strong><br>Entrada registrado correctamente"
                ];
            else
                $msg = [
                    'simple'        => true,
                    'icono'         => 'error',
                    'titulo'        => "Control de Asistencia",
                    'msg'           => "Error al registrar la entrada, verifique con el administrador."
                ];
            return $msg;

        }
    }

    private function verificarMarcadoHoy($asignacion): bool
    {
        $asistencia = $this->model->where(["asignacion_horario_id" => $asignacion->id, "fecha" => date('Y-m-d')])->first();
        if($asistencia)
            return true;
        else
            return false;
    }

    /**
     * @throws ReflectionException
     */
    public function marcarSalidaConfirmacion(): \CodeIgniter\HTTP\ResponseInterface
    {
        $asistencia_id = $this->request->getPost('id');
        $asistencia = $this->model->find($asistencia_id);
        $asignacion = (new AsignacionHorarioModel())->where(['id' => $asistencia->asignacion_horario_id, 'estado' => 'REGISTRADO'])->first();
        $persona = (new PersonaModel())->where('id', $asignacion->persona_id)->first();
        $res = [];
        if ($asistencia)
            $res = $this->marcarSalida($asistencia->salida, $asistencia->id, $persona);
        return $this->response->setJSON($res);
    }
}
