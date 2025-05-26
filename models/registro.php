<?php

namespace Model;

class registro extends ActiveRecord {

    //El nombre de la tabla de mi Aqua
    public static $tabla = 'registro';
    
    //Columnas de la Tabala
    public static $columnasDB = [
        'act_nombre',
        'reg_fecha',
        'reg_hora',
        'estado_asistencia',
        'situacion'
    ];

    //PRIMARY KEY
    public static $idTabla = 'reg_id';
    
    //TODAS las propiedades
    public $reg_id;
    public $act_id;
    public $reg_fecha;
    public $reg_hora;
    public $estado_asistencia;
    public $situacion;

    //El constructor inicializa TODAS las propiedades
    public function __construct($args = []){
         $this->reg_id = $args['reg_id'] ?? null;
        $this->act_id = $args['act_id'] ?? null;
        $this->reg_fecha = $args['reg_fecha'] ?? '';
        $this->reg_hora = $args['reg_hora'] ?? 'ACTIVO';
        $this->situacion = $args['situacion'] ?? 1;
        
    }

    //Eliminar producto
    public static function EliminarRegistro($id){
        $sql = "DELETE FROM registro WHERE reg_id = $id";
        return self::SQL($sql);
    }
}


///Termine de llenar todo el model del registro