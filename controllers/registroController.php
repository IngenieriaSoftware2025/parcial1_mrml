<?php

namespace Controllers;

use Exception;
use Model\ActiveRecord;
use Model\registro;
use Model\actividades;
use MVC\Router;
use DateTime;

class registroController extends ActiveRecord
{

    public static function renderizarPagina(Router $router)
    {
        $router->render('registro/index', []);  
    }

    //*************************************************************************************** 
    // Guardar
    public static function guardarAPI()
    {
        getHeadersApi();

        try {
            // Validar que se haya enviado el ID de la actividad
            if (empty($_POST['act_id'])) {
                http_response_code(400);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Debe seleccionar una actividad'
                ]);
                return;
            }

            $act_id = (int)$_POST['act_id'];
            
            // Obtener los datos de la actividad ANTES de usarla
            $actividad = actividades::find($act_id);
            if (!$actividad || $actividad->situacion != 1 || $actividad->act_estado != 'ACTIVO') {
                http_response_code(400);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'La actividad seleccionada no existe o no está disponible'
                ]);
                return;
            }

            // Verificar si ya existe un registro para esta actividad (opcional)
            if (registro::existeRegistroActividad($act_id)) {
                http_response_code(400);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Ya existe un registro de asistencia para esta actividad'
                ]);
                return;
            }

            // Obtener fecha/hora actual
            $fechaActual = date('Y-m-d H:i:s');
            
            $fechaActividad = new DateTime($actividad->act_fecha);
            $fechaRegistro = new DateTime($fechaActual);
            
            // Calcular diferencia en minutos
            $diferencia = $fechaRegistro->getTimestamp() - $fechaActividad->getTimestamp();
            $diferenciaMinutos = round($diferencia / 60);
            
            // Determinar estado de asistencia
            $estadoAsistencia = '';
            if ($diferenciaMinutos <= 5) {
                $estadoAsistencia = 'PUNTUAL';
            } elseif ($diferenciaMinutos <= 15) {
                $estadoAsistencia = 'TARDANZA';
            } else {
                $estadoAsistencia = 'IMPUNTUAL';
            }

            // Crear el registro
            $nuevoRegistro = new registro([
                'act_id' => $act_id,
                'reg_fecha' => $fechaActual,
                'estado_asistencia' => $estadoAsistencia,
                'situacion' => 1
            ]);

            $resultado = $nuevoRegistro->crear();

            if ($resultado['resultado']) {
                http_response_code(200);
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => "Asistencia registrada como: {$estadoAsistencia}",
                    'estado_asistencia' => $estadoAsistencia,
                    'diferencia_minutos' => abs($diferenciaMinutos)
                ]);
            } else {
                throw new Exception('Error al crear el registro');
            }

        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al registrar asistencia',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    //*************************************************************************** 
    // Buscar registros CON FILTROS
    public static function buscarAPI()
    {
        try {
   
            $filtroActividad = $_GET['actividad'] ?? '';
            $filtroFechaInicio = $_GET['fecha_inicio'] ?? '';
            $filtroFechaFin = $_GET['fecha_fin'] ?? '';
            

            $sql = "SELECT 
                        r.reg_id,
                        r.act_id,
                        r.reg_fecha,
                        r.estado_asistencia,
                        r.situacion,
                        a.act_nombre,
                        a.act_fecha as fecha_programada_actividad
                    FROM registro r 
                    INNER JOIN actividades a ON r.act_id = a.act_id 
                    WHERE r.situacion = 1";
            

            if (!empty($filtroActividad)) {
                $sql .= " AND r.act_id = " . (int)$filtroActividad;
            }
            
            if (!empty($filtroFechaInicio)) {
                $sql .= " AND DATE(r.reg_fecha) >= '" . date('Y-m-d', strtotime($filtroFechaInicio)) . "'";
            }
            
            if (!empty($filtroFechaFin)) {
                $sql .= " AND DATE(r.reg_fecha) <= '" . date('Y-m-d', strtotime($filtroFechaFin)) . "'";
            }
            
            $sql .= " ORDER BY r.reg_fecha DESC";
            
            $data = self::fetchArray($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Registros obtenidos correctamente',  
                'data' => $data,
                'filtros_aplicados' => [
                    'actividad' => $filtroActividad,
                    'fecha_inicio' => $filtroFechaInicio,
                    'fecha_fin' => $filtroFechaFin
                ]
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener los registros',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    //*************************************************************************** 
    // Obtener actividades situacion 1
    public static function obtenerActividadesAPI()
    {
        try {
            $sql = "SELECT act_id, act_nombre, act_fecha 
                    FROM actividades 
                    WHERE situacion = 1 AND act_estado = 'ACTIVO' 
                    ORDER BY act_fecha ASC";
            
            $data = self::fetchArray($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Actividades obtenidas correctamente',  
                'data' => $data
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener las actividades',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    //*************************************************************************** 
    // ObtenerActividades
    public static function obtenerTodasActividadesAPI()
    {
        try {
            $sql = "SELECT act_id, act_nombre, act_fecha, act_estado 
                    FROM actividades 
                    WHERE situacion = 1 
                    ORDER BY act_nombre ASC";
            
            $data = self::fetchArray($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Todas las actividades obtenidas correctamente',  
                'data' => $data
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener las actividades',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    //****************************************************************** 
    
  //Eliminación
  
    public static function EliminarAPI()
    {
        try {
            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
            
            if (!$id) {
                throw new Exception('ID de registro inválido');
            }

            $sql = "UPDATE registro SET situacion = 0 WHERE reg_id = $id";
            $ejecutar = self::SQL($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'El registro de asistencia ha sido eliminado correctamente'
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al eliminar',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}