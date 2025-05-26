<?php

namespace Model;

class actvidades extends ActiveRecord {

    //El nombre de la tabla de mi Aqua
    public static $tabla = 'actividades';
    
    //Columnas de la Tabala
    public static $columnasDB = [
        'act_nombre',
        'act_estado',
        'act_fecha',
        'situacion'
    ];

    //PRIMARY KEY
    public static $idTabla = 'act_id';
    
    //TODAS las propiedades
    public $act_id;
    public $act_nombre;
    public $act_estado;
    public $act_fecha;
    public $situacion;

    //El constructor inicializa TODAS las propiedades
    public function __construct($args = []){
        $this->act_id = $args['act_id'] ?? null;
        $this->act_nombre = $args['act_nombre'] ?? '';
        $this->act_estado = $args['act_estado'] ?? 'ACTIVO';
        $this->situacion = $args['situacion'] ?? 1;
        $this->act_fecha = $args['act_fecha'] ?? '';
        
    }

    //Eliminar producto
    public static function EliminarActividad($id){
        $sql = "DELETE FROM actividades WHERE act_id = $id";
        return self::SQL($sql);
    }
}

