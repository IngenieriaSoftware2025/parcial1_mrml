<?php

namespace Model;

class registro extends ActiveRecord {

    //El nombre de la tabla
    public static $tabla = 'registro';
    
    public static $columnasDB = [
        'act_id',
        'reg_fecha', 
        'estado_asistencia',
        'situacion'
    ];

    //PRIMARY KEY
    public static $idTabla = 'reg_id';
    
    public $reg_id;
    public $act_id;
    public $reg_fecha;
    public $estado_asistencia;
    public $situacion;

    public function __construct($args = []){
        $this->reg_id = $args['reg_id'] ?? null;
        $this->act_id = $args['act_id'] ?? null;
        $this->reg_fecha = $args['reg_fecha'] ?? null;
        $this->estado_asistencia = $args['estado_asistencia'] ?? '';
        $this->situacion = $args['situacion'] ?? 1;
    }

    //Eliminación, situacion 0
    public static function EliminarRegistro($id){
        $sql = "UPDATE registro SET situacion = 0 WHERE reg_id = $id";
        return self::SQL($sql);
    }

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

    // Restaurar registro eliminado
    public static function RestaurarRegistro($id){
        $sql = "UPDATE registro SET situacion = 1 WHERE reg_id = $id";
        return self::SQL($sql);
    }

    //Obtener registros eliminados
    public static function obtenerRegistrosEliminados() {
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
                WHERE r.situacion = 0 
                ORDER BY r.reg_fecha DESC";
        
        return self::fetchArray($sql);
    }
}