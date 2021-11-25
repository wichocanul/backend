<?php

class ControladorProductos{

    /* ==============================
    MOSTRAR CATEGORIAS
	================================ */

    public static function ctrMostrarCategorias($item, $valor){

        $tabla = "categorias";

        $respuesta = ModeloProductos::mdlMostrarCategorias($tabla, $item, $valor);

        return $respuesta;

    }

    /* ==============================
    MOSTRAR SUB CATEGORIAS
	================================ */

    public static function ctrMostrarSubCategorias($item, $valor){

        $tabla = "subcategorias";

        $respuesta = ModeloProductos::mdlMostrarSubCategorias($tabla, $item, $valor);

        return $respuesta;

    }

    /* ==============================
    MOSTRAR PRODUCTOS
	================================ */
    public static function ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo){
        
        $tabla = "productos";

        $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $ordenar, $item, $valor, $base, $tope, $modo);

        return $respuesta;

    }

    /* ==============================
    MOSTRAR INFO-PRODUCTO
	================================ */
    public static function crtMostrarInfoProducto($item, $valor){

        $tabla = "productos";

        $respuesta = ModeloProductos::mdlMostrarInfoProductos($tabla, $item, $valor);

        return $respuesta;

    }


    /* ==============================
    LISTAR PRODUCTOS
	================================ */
    public static function ctrListarProductos($ordenar, $item, $valor){
        
        $tabla = "productos";

        $respuesta = ModeloProductos::mdlListarProductos($tabla, $ordenar, $item, $valor);

        return $respuesta;

    }


    /* ==============================
    MOSTRAR BANNER
	================================ */
    public static function ctrMostrarBanner($ruta){

        $tabla = "banner";

        $respuesta = ModeloProductos::mdlMostrarBanner($tabla, $ruta);

        return $respuesta;

    }

    /* ==============================
    BUSCADOR
	================================ */
    public static function ctrBuscarProductos($busqueda, $ordenar, $modo, $base, $tope){

        $tabla = "productos";

        $respuesta = ModeloProductos::mdlBuscarProductos($tabla, $busqueda, $ordenar, $modo, $base, $tope);

        return $respuesta;

    }

    /* ==============================
    LISTAR PRODUCTOS BUSQUEDA
	================================ */
    public static function ctrListarProductosBusqueda($busqueda){

        $tabla = "productos";

        $respuesta = ModeloProductos::mdlListarProductosBusqueda($tabla, $busqueda);

        return $respuesta;

    }

    /* ==============================
    ACTUALIZAR VISTA PRODUCTO AJAX
	================================ */
    public static function ctrActualizarVistaProducto($datos, $item){

        $tabla = "productos";

        $respuesta = ModeloProductos::mdlActualizarVistaProducto($tabla, $datos, $item);

        return $respuesta;

    }

}