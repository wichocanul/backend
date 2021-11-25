<?php

class ControladorPlantilla{

	/* ==============================
    LLAMADA A LA PLANTILLA
	================================ */

	public static function plantilla(){

		include "views/template.php";

	}

	/* ==============================
    TRAER LOS ESTILOS DINAMICOS DE LA PLANTILLA
	================================ */
	public static function ctrEstiloTemplate(){

		$tabla = "plantilla";

		$respuesta = ModeloTemplate::mdlEstiloTemplate($tabla);

		return $respuesta;

	}


}