<?php

require_once "../controllers/template.controlador.php";
require_once "../models/template.modelo.php";

class AjaxTemplate{

    public function ajaxEstiloTemplate(){

        $respuesta = ControladorPlantilla::ctrEstiloTemplate();

        echo json_encode($respuesta);

    }

}


$objeto = new ajaxTemplate();
$objeto -> ajaxEstiloTemplate();