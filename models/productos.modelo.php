<?php

require_once "conexion.php";

class ModeloProductos{

    /* ==============================
    MOSTRAR CATEGORIAS
	================================ */

    public static function mdlMostrarCategorias($tabla, $item, $valor){

        if($item != ""){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        }else{
        
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt -> execute();

            return $stmt -> fetchAll();
        
        }

        $stmt -> close();

        $stmt = null; //Vaciamos el objeto PDO

    }

    /* ==============================
    MOSTRAR SUB CATEGORIAS
	================================ */
    
    public static function mdlMostrarSubCategorias($tabla, $item, $valor){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();
        
        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt = null;

    }


    /* ==============================
    MOSTRAR PRODUCTOS  
	================================ */
    public static function mdlMostrarProductos($tabla, $ordenar, $item, $valor, $base, $tope, $modo){

        if($item != null){

            $stmt = Conexion::conectar()->prepare("SELECT *FROM $tabla WHERE $item = :$item ORDER BY $ordenar $modo LIMIT $base, $tope");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetchAll();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT *FROM $tabla ORDER BY $ordenar $modo LIMIT $base, $tope");

            $stmt -> execute();

            return $stmt -> fetchAll();

        }

        $stmt -> close();

        $stmt = null;

    }


    /* ==============================
    MOSTRAR INFO-PRODUCTOS
	================================ */
    public static function mdlMostrarInfoProductos($tabla, $item, $valor){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();

        $stmt -> close();

        $stmt = null;

    }


    /* ==============================
    LISTAR PRODUCTOS
	================================ */
    public static function mdlListarProductos($tabla, $ordenar, $item, $valor){

        if($item != null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY $ordenar DESC");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetchAll();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $ordenar DESC");

            $stmt -> execute();

            return $stmt -> fetchAll();

        }

        $stmt -> close();

        $stmt = null;

    }


    /* ==============================
    MOSTRAR BANNER
	================================ */
    public static function mdlMostrarBanner($tabla, $ruta){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ruta = :ruta");

        $stmt -> bindParam(":ruta", $ruta, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();

        $stmt -> close();

        $stmt = null;

    }


    /* ==============================
    BUSCADOR
	================================ */
    public static function mdlBuscarProductos($tabla, $busqueda, $ordenar, $modo, $base, $tope){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ruta like '%$busqueda%' OR titulo like '%$busqueda%' OR titular like '%$busqueda%' OR descripcion like '%$busqueda%' ORDER BY $ordenar $modo LIMIT $base, $tope");
        //like busca coincidencias de ruta, titulo, titular, etc, con la variable busqueda, Ordena el id($ordenar) de manera ASC o DESC($modo) con un limite de productos por pagina($base y $tope)

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt = null;

    }


    /* ==============================
    LISTAR PRODUCTOS BUSQUEDA
	================================ */
    public static function mdlListarProductosBusqueda($tabla, $busqueda){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ruta like '%$busqueda%' OR titulo like '%$busqueda%' OR titular like '%$busqueda%' OR descripcion like '%$busqueda%'");

        $stmt -> execute();

        return $stmt -> fetchAll();
        
        $stmt -> close();

        $stmt = null;

    }

    /* ==============================
    ACTUALIZAR VISTA PRODUCTO AJAX
	================================ */
    public static function mdlActualizarVistaProducto($tabla, $datos, $item){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE ruta = :ruta");

        $stmt -> bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
        $stmt -> bindParam(":".$item, $datos["valor"], PDO::PARAM_STR);

        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt -> close();

        $stmt = null;

    }

}