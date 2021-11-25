<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="title" content="Tienda Virtual">

	<meta name="description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa, provident sapiente nesciunt asperiores nostrum magni! Velit illum vitae repudiandae officiis.">

	<meta name="keyword" content="Lorem ipsum, dolor sit amet, consectetur adipisicing, elit. Ipsa, provident sapiente, nesciunt asperiores, nostrum magni! Velit illum vitae repudiandae officiis.">

	<title>Code Shoes</title>

	<?php

		session_start();
		// VARIABLES DE SESION: Se utilizan para privatizar una pagina o cuando necesitamos mantener almacenado una informacion y pasarla entre diferentes paginas

		$servidor = Ruta::ctrRutaServidor();

		$icono = ControladorPlantilla::ctrEstiloTemplate();

		echo '<link rel="icon" href="'.$servidor.$icono["icono"].'">';


		/*======================================================
		MANTENER LA RUTA FIJA DEL PROYECTO
		======================================================*/
		$url = Ruta::ctrRuta();

	?>


	<link rel="stylesheet" href="<?php echo $url; ?>views/css/plugins/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $url; ?>views/css/plantilla.css">
	<link rel="stylesheet" href="<?php echo $url; ?>views/css/cabezote.css">
	<link rel="stylesheet" href="<?php echo $url; ?>views/css/slide.css">
	<link rel="stylesheet" href="<?php echo $url; ?>views/css/productos.css">
	<link rel="stylesheet" href="<?php echo $url; ?>views/css/plugins/flexslider.css">
	<link rel="stylesheet" href="<?php echo $url; ?>views/css/infoproducto.css">
	<link rel="stylesheet" href="<?php echo $url; ?>views/css/perfil.css">
	<link rel="stylesheet" href="<?php echo $url; ?>views/css/carrito-de-compras.css">
	<link rel="stylesheet" href="<?php echo $url; ?>views/css/plugins/sweetalert2.min.css">
	<link rel="stylesheet" href="<?php echo $url; ?>views/css/plugins/sweetalert.css">

	<script src="https://kit.fontawesome.com/666ce126ea.js" crossorigin="anonymous"></script>
	<script src="<?php echo $url; ?>views/js/plugins/popper.min.js"></script>
	<script src="<?php echo $url; ?>views/js/plugins/bootstrap.min.js"></script>
	<script src="<?php echo $url; ?>views/js/plugins/bootstrap.bundle.min.js"></script>
	<script src="<?php echo $url; ?>views/js/plugins/bootstrap.bundle.js"></script>
	<script src="<?php echo $url; ?>views/js/plugins/jquery-3.6.0.min.js"></script>
	<script src="<?php echo $url; ?>views/js/plugins/jquery.flexslider.js"></script>
	<script src="<?php echo $url; ?>views/js/plugins/sweetalert2.all.min.js"></script>
	<script src="<?php echo $url; ?>views/js/plugins/sweetalert2.min.js"></script>
	<script src="<?php echo $url; ?>views/js/plugins/sweetalert.min.js"></script>
	


</head>

<body>

	<?php
	
	/*======================================================
	CABEZOTE
	======================================================*/
	include "modules/cabezote.php";

		/*======================================================
		CONTENIDO DINAMICO
		======================================================*/

		$rutas = array();
		$ruta = null;
		$infoProducto = null;


		if(isset($_GET["ruta"])){
			
			$rutas =explode("/", $_GET["ruta"]);

			$item = "ruta";
			$valor = $rutas[0];

			/*======================================================
			URL'S AMIGABLES DE CATEGORIAS 
			======================================================*/
			// Notificar solamente errores de ejecución Menos Warning
			//https://www.php.net/manual/es/function.error-reporting.php <!-- 08_1 135 -->
			error_reporting(E_ERROR | E_PARSE);

			$rutaCategorias = ControladorProductos::ctrMostrarCategorias($item, $valor);

			if($rutas[0] == $rutaCategorias["ruta"]){

				$ruta = $rutas[0];

			}

			/*======================================================
			URL'S AMIGABLES DE SUBCATEGORIAS 
			======================================================*/

			$rutaSubCategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);

			foreach($rutaSubCategorias as $key => $value){

				if($rutas[0] == $value["ruta"]){

					$ruta = $rutas[0];
		
				}

			}

			/*======================================================
			URL'S AMIGABLES DE PRODUCTOS
			======================================================*/

			$rutaProductos = ControladorProductos::crtMostrarInfoProducto($item, $valor);

			if($rutas[0] == $rutaProductos["ruta"]){

				$infoProducto = $rutas[0];

			}

			/*======================================================
			LISTA BLANCA DE URL'S AMIGABLES DE CATEGORIAS 
			======================================================*/

			if($ruta != null || $rutas[0] == "mejores-ofertas" || $rutas[0] == "lo-mas-vendido" || $rutas[0] == "lo-mas-reciente"){

				include "modules/productos.php";

			}else if($infoProducto != null){

				include "modules/infoproducto.php";
			
			}else if($rutas[0] == "buscador"  || $rutas[0] == "politicas" || $rutas[0] == "verificar" || $rutas[0] == "salir" || $rutas[0] == "perfil" || $rutas[0] == "carrito-de-compras"){

				include "modules/".$rutas[0].".php";
			
			}else{

				include "modules/error404.php";

			}

		}else{

			include "modules/slide.php";
			include "modules/destacados.php";

		}

	?>

	<input type="hidden" value="<?php echo $url; ?>" id="rutaOculta">


	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

	<script src="<?php echo $url; ?>views/js/plugins/bootstrap.bundle.min.js"></script>
	<script src="<?php echo $url; ?>views/js/plugins/bootstrap.bundle.js"></script>        
	<script src="<?php echo $url; ?>views/js/cabezote.js"></script>
	<script src="<?php echo $url; ?>views/js/template.js"></script>
	<script src="<?php echo $url; ?>views/js/buscador.js"></script>
	<script src="<?php echo $url; ?>views/js/infoproducto.js"></script>
	<script src="<?php echo $url; ?>views/js/usuarios.js"></script>
	<script src="<?php echo $url; ?>views/js/registroFacebook.js"></script>
	<script src="<?php echo $url; ?>views/js/carrito-de-compras.js"></script>


	
	<script>
	window.fbAsyncInit = function() {
		FB.init({
		appId      : '1270054946787442',
		cookie     : true,
		xfbml      : true,
		version    : 'v11.0'
		});
		
		FB.AppEvents.logPageView();   
		
	};

	(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "https://connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script>

</body>
</html>