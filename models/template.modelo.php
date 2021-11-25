<?php

require_once "conexion.php";

class ModeloTemplate{

    static public function mdlEstilotemplate($tabla){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

        $stmt -> execute();

        return $stmt -> fetch();

        $stmt -> close();

    }

}