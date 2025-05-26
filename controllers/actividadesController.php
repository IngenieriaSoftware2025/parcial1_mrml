<?php

namespace Controllers;

use Exception;
use Model\ActiveRecord;
use Model\actividades;
use Model\actvidades;
use MVC\Router;

class actividadesController extends ActiveRecord
{

    // Renderizar vista de actividades
    public static function renderizarPagina(Router $router)
    {
        $router->render('actividades/index', []);  

    }

    //*************************************************************************************** */
    //Guardar

    public static function guardarAPI()
    {

        getHeadersApi();

        // echo json_encode($_POST);
        // return;

        // VALIDACIÓN: Nombre de actividad(mayor 2 digitos))
        $_POST['act_nombre'] = htmlspecialchars($_POST['act_nombre']);

        $cantidad_actividad = strlen($_POST['act_nombre']);

        if ($cantidad_actividad < 2) {

            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'La cantidad de digitos que debe de contener el nombre de la actividad debe de ser mayor a dos'
            ]);
            return;
        }

        //Formatear fecha

        $_POST['act_fecha'] = date('Y-m-d H:i:s', strtotime($_POST['act_fecha']));

        //Valido Estado
         $_POST['act_estado'] = htmlspecialchars($_POST['act_estado']);
        $estado = $_POST['act_estado'];

        //Validación de estados
        if ($estado == "ACTIVO" || $estado == "INACTIVO" || $estado == "SUSPENDIDO") {

            try {

                // 🎯 CAMBIO: Crear instancia de actividades con TODOS los campos
                $data = new actividades([
                    'act_nombre' => $_POST['act_nombre'],
                    'act_estado' => $_POST['act_estado'],
                    'act_fecha' => $_POST['act_fecha'],
                    'situacion' => 1
                ]);

                $crear = $data->crear();

                http_response_code(200);
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'Actvidad Registrada con Exito'
                ]);
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Error al guardar',
                    'detalle' => $e->getMessage(),
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Los estados solo pueden ser "ACTIVO, INACTIVO, SUSPENDIDO"'  
            ]);
            return;
        }
    }


    //*************************************************************************** */
    //Buscar
    public static function buscarAPI()
    {

        try {

    
            $sql = "SELECT * FROM actividades where situacion = 1";
            $data = self::fetchArray($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Actividades obtenidos correctamente',  
                'data' => $data
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener los Actividades',
                'detalle' => $e->getMessage(),
            ]);
        }
    }



    //*************************************************************************** */
    //Modificar
    public static function modificarAPI()
    {

        getHeadersApi();

        // ID de Actvidades
        $id = $_POST['act_id'];
        
       // VALIDACIÓN: Nombre de actividad(mayor 2 digitos))
        $_POST['act_nombre'] = htmlspecialchars($_POST['act_nombre']);

        $cantidad_actividad = strlen($_POST['act_nombre']);

        if ($cantidad_actividad < 2) {

            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'La cantidad de digitos que debe de contener el nombre de la actividad debe de ser mayor a dos'
            ]);
            return;
        }

        //Formatear fecha

        $_POST['act_fecha'] = date('Y-m-d H:i:s', strtotime($_POST['act_fecha']));

        //Valido Estado
         $_POST['act_estado'] = htmlspecialchars($_POST['act_estado']);
        $estado = $_POST['act_estado'];

        if ($estado == "ACTIVO" || $estado == "INACTIVO" || $estado == "SUSPENDIDO") {

            try {

                //
                $data = actividades::find($id);
                $data->sincronizar([
                    'act_nombre' => $_POST['act_nombre'],
                    'act_estado' => $_POST['act_estado'],
                    'act_fecha' => $_POST['act_fecha'],
                    'situacion' => 1
                ]);
                $data->actualizar();

                http_response_code(200);
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'La informacion de Actvidades ha sido modificada exitosamente'
                ]);
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Error al guardar',
                    'detalle' => $e->getMessage(),
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Los estados solo pueden ser "ACTIVO, INACTIVO, SUSPENDIDO"'
            ]);
            return;
        }
    }

    //****************************************************************** */
    //Eliminar
    public static function EliminarAPI()
    {

        try {

            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

            
            $ejecutar = actividades::EliminarActividad($id);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'El registro ha sido eliminado correctamente'
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al Eliminar',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}

