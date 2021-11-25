<?php

require_once "controllers/template.controlador.php";
require_once "controllers/productos.controlador.php";
require_once "controllers/slide.controlador.php";
require_once "controllers/usuarios.controlador.php";

require_once "models/template.modelo.php";
require_once "models/productos.modelo.php";
require_once "models/slide.modelo.php";
require_once "models/rutas.php";
require_once "models/usuarios.modelo.php";


require_once "extensiones/PHPMailer/PHPMailerAutoload.php";
require_once "extensiones/vendor/autoload.php";

$template = new ControladorPlantilla();
$template -> plantilla();

?>
