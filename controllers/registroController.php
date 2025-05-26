<?php

namespace Controllers;

use Exception;
use Model\ActiveRecord;
use Model\registro;
use MVC\Router;

class registroController extends ActiveRecord
{
    // Renderizar vista de registro
    public static function renderizarPagina(Router $router)
    {
        $router->render('registro/index', []);  
    }

    //*************************************************************************************** 
    // Guardar Asistencia
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
            $registro = new registro([
                'act_id' => $act_id,
                'reg_fecha' => $fechaActual,
                'estado_asistencia' => $estadoAsistencia,
                'situacion' => 1
            ]);

            $resultado = $registro->crear();

            if ($resultado['resultado']) {
                http_response_code(200);
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => "Asistencia registrada como: {$estadoAsistencia}",
                    'estado_asistencia' => $estadoAsistencia,
                    'diferencia_minutos' => $diferenciaMinutos
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

    //********************************************************* */
    //Este es un Join para poder mandar a traer todos los datos de la otra tabla


    public static function obtenerRegistrosConActividades() {
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
                WHERE r.situacion = 1 
                ORDER BY r.reg_fecha DESC";
        
        return self::fetchArray($sql);
    }


    
    public static function existeRegistroActividad($act_id) {
        $sql = "SELECT COUNT(*) as total FROM registro WHERE act_id = $act_id AND situacion = 1";
        $resultado = self::fetchFirst($sql);
        return $resultado['total'] > 0;
    }

    //*************************************************************************** 
    // Buscar registros con información de actividades
    public static function buscarAPI()
    {
        try {
            $data = registro::obtenerRegistrosConActividades();

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Registros obtenidos correctamente',  
                'data' => $data
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
    // Obtener actividades activas para el select
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

    //****************************************************************** 
    // Eliminar registro
    public static function EliminarAPI()
    {
        try {
            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
            
            if (!$id) {
                throw new Exception('ID de registro inválido');
            }

            $ejecutar = registro::EliminarRegistro($id);

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