<?php   

    require_once "conexion.php";

    class ModeloUsuarios{

        /*======================================================
			REGISTRO DE USUARIO 
        ======================================================*/

        public static function mdlRegistroUsuario($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, password, email, foto, modo, verificacion, emailEncriptado) VALUES (:nombre, :password, :email, :foto, :modo, :verificacion, :emailEncriptado)");

            $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
            $stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
            $stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
            $stmt -> bindParam(":modo", $datos["modo"], PDO::PARAM_STR);
            $stmt -> bindParam(":verificacion", $datos["verificacion"], PDO::PARAM_INT);
            $stmt -> bindParam(":emailEncriptado", $datos["emailEncriptado"], PDO::PARAM_STR);

            if($stmt->execute()){

                return "ok";

            }else{

                return "error";

            }

            $stmt->close();
            $stmt = null;

        }


        /*======================================================
			MOSTRAR USUARIO
        ======================================================*/
        public static function mdlMostrarUsuario($tabla, $item, $valor){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

            $stmt -> close();

            $stmt = null;

        }


        /*======================================================
			ACTUALIZAR USUARIO
        ======================================================*/
        public static function mdlActualizarUsuario($tabla, $id, $item, $valor){

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id = :id");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt -> bindParam(":id", $id, PDO::PARAM_INT);

            if($stmt -> execute()){

                return "ok";

            }else{

                return "error";

            }

            $stmt-> close();

            $stmt = null;

        }


        /*======================================================
			ACTUALIZAR PERFIL
        ======================================================*/
        public static function mdlActualizarPerfil($tabla, $datos){

            $stmt = Conexion::conectar()-> prepare("UPDATE $tabla SET nombre = :nombre, email = :email, telefono = :telefono, password = :password, foto = :foto WHERE id = :id");

            $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
            $stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
            $stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
            $stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
            $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

            if($stmt -> execute()){
                
                return "ok";

            }else{

                return "error";

            }

            $stmt -> close();

            $stmt = null;

        }


        /*======================================================
			MOSTRAR COMPPRAS
        ======================================================*/
        public static function mdlMostrarCompras($tabla, $item, $valor){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetchAll();

            $stmt -> close();

            $stmt = null;

        }


        /*======================================================
			MOSTRAR COMENTARIOS PERFIL
        ======================================================*/
        public static function mdlMostrarComentariosPerfil($tabla, $datos){

            

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_usuario = :id_usuario AND id_producto = :id_producto");

            $stmt -> bindParam(":id_usuario", $datos["idUsuario"], PDO::PARAM_INT);
            $stmt -> bindParam(":id_producto", $datos["idProducto"], PDO::PARAM_INT);

            $stmt -> execute();

            return $stmt -> fetch();

            $stmt -> close();

            $stmt = null;

        }


        /*======================================================
			ACTUALIZAR COMENTARIOS PERFIL
        ======================================================*/
        public static function mdlActualizarComentario($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET calificacion = :calificacion, comentario = :comentario WHERE id = :id");

            $stmt -> bindParam(":calificacion", $datos["calificacion"], PDO::PARAM_INT);
            $stmt -> bindParam(":comentario", $datos["comentario"], PDO::PARAM_STR);
            $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

            if($stmt -> execute()){

                return "ok";

            }else{

                return "error";

            }

            $stmt -> close();

            $stmt = null;

        }


        /*======================================================
			MOSTRAR COMENTARIOS PRODUCTO
        ======================================================*/
        public static function mdlMostrarComentariosProducto($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_producto = :id_producto ORDER BY Rand()");//Si no quiero que los comentarios se muestren de orden aleatoria solo hay que quitar el ORDER BY Rand()

            $stmt -> bindParam(":id_producto", $datos["idProducto"], PDO::PARAM_INT);

            $stmt -> execute();

            return $stmt -> fetchAll(); 

            $stmt -> close();

            $stmt = null;

        }


        /*======================================================
			AGREGAR A LISTA DE DESEOS
        ======================================================*/
        public static function mdlAgregarDeseo($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_usuario, id_producto) VALUES (:id_usuario, :id_producto)");

            $stmt -> bindParam(":id_usuario", $datos["idUsuario"], PDO::PARAM_INT);
            $stmt -> bindParam(":id_producto", $datos["idProducto"], PDO::PARAM_INT);

            if($stmt -> execute()){

                return "ok";

            }else{

                return "error";

            }

            $stmt -> close();

            $stmt = null;

        }


        /*======================================================
			MOSTRAR LISTA DE DESEOS
        ======================================================*/
        public static function mdlMostrarDeseos($tabla, $item){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_usuario = :id_usuario ORDER BY id DESC");

            $stmt -> bindParam(":id_usuario", $item, PDO::PARAM_INT);

            $stmt -> execute();

            return $stmt -> fetchAll();

            $stmt -> close();

            $stmt = null;

        }


        /*======================================================
			QUITAR DE LISTA DE DESEOS
        ======================================================*/
        public static function mdlQuitarDeseo($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

            $stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

            if($stmt -> execute()){

                return "ok";

            }else{

                return "error";

            }

            $stmt -> close();

            $stmt = null;

        }


        /*======================================================
			ELIMINAR USUARIO 
        ======================================================*/
        public static function mdlEliminarUsuario($tabla, $id){

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

            $stmt -> bindParam(":id", $id, PDO::PARAM_INT);

            if($stmt -> execute()){

                return "ok";

            }else{

                return "error";

            }

            $stmt->close();

            $stmt = null;

        } 

        /*======================================================
			ELIMINAR COMENTARIOS USUARIO
        ======================================================*/
        public static function mdlEliminarComentarios($tabla, $id){

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id_usuario");

            $stmt -> bindParam(":id_usuario", $id, PDO::PARAM_INT);

            if($stmt -> execute()){

                return "ok";

            }else{

                return "error";

            }

            $stmt->close();

            $stmt = null;

        } 

        /*======================================================
			ELIMINAR COMPRAS USUARIO
        ======================================================*/
        public static function mdlEliminarCompras($tabla, $id){

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id_usuario");

            $stmt -> bindParam(":id_usuario", $id, PDO::PARAM_INT);

            if($stmt -> execute()){

                return "ok";

            }else{

                return "error";

            }

            $stmt->close();

            $stmt = null;

        } 

        /*======================================================
			ELIMINAR DESEOS DE USUARIOS
        ======================================================*/
        public static function mdlEliminarListaDeseos($tabla, $id){

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id_usuario");

            $stmt -> bindParam(":id_usuario", $id, PDO::PARAM_INT);

            if($stmt -> execute()){

                return "ok";

            }else{

                return "error";

            }

            $stmt->close();

            $stmt = null;

        } 


    }


?>