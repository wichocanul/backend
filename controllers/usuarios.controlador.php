<?php

    class ControladorUsuarios{

        /*======================================================
			REGISTRO DE USUARIO 
        ======================================================*/

        public static function ctrRegistroUsuario(){

            if(isset($_POST["regUsuario"])){

                if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["regUsuario"]) &&
                    preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["regEmail"]) &&
                    preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["regPassword"])){

                    $encriptar = crypt($_POST["regPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    $encriptarEmail = md5($_POST["regEmail"]);//Encripta en alfanumerico

                    $datos = array("nombre"=>$_POST["regUsuario"],
                                    "password"=> $encriptar,
                                    "email"=>$_POST["regEmail"],
                                    "foto"=>"",
                                    "modo"=> "directo",
                                    "verificacion"=> 1,
                                    "emailEncriptado"=>$encriptarEmail);

                    $tabla = "usuarios";

                    $respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);

                    if($respuesta == "ok"){

                        /*======================================================
                            VERIFICAR EL CORREO ELECTRONICO 
                        ======================================================*/

                        date_default_timezone_set("America/Mexico_City");

                        $url = Ruta::ctrRuta();	

                        $mail = new PHPMailer;

                        $mail->CharSet = 'UTF-8';

                        $mail->isMail();

                        $mail->setFrom('productos@codeshoes.com', 'Code Shoes');

                        $mail->addReplyTo('productos@codeshoes.com', 'Code Shoes');

                        $mail->Subject = "Por favor verifique su dirección de correo electrónico";

                        $mail->addAddress($_POST["regEmail"]);

                        $mail->msgHTML('<div style="width: 100%; background: #eee; position: relative; font-family: sans-serif; padding-bottom: 40px; display: flex; align-items: center; flex-direction: column;">

                            <a href="">
                                <img style="margin: 20px auto; width: 250px;" src="https://i.ibb.co/9H4RDkC/logo.png" alt="">
                            </a>
                    
                            
                            <div class="container" style="width: 50%; background: #ffffff; position: relative;">
                    
                                <div style="background: #ffffff; width: 90%; margin: 40px auto 0px auto; position: relative;">
                    
                                    <img style="width: 160px; display: block; margin: 20px auto;" src="https://i.ibb.co/XXm1vRN/Email-Mail-Message-Blue-Dotted-Line-Line-Icon.jpg" alt="">
                    
                                    <h2 style="width: 100%; display: block; text-align: center; margin-top: 30px; color: #5f5f5f;">VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO</h2>
                    
                                    <hr style="background: #e0e0e0; height: 2px; border: none;">
                    
                                    <p style="width: 100%; display: block; text-align: center; margin-top: 30px;">Para poder utilizar su cuenta de Shoes Code, debe confirmar su dirección de correo electrónico</p>
                    
                                    <div style="width: 80%; max-width: 350px; position: relative; background: #006699; text-align: center; margin: 30px auto; padding: 20px;">
                    
                                        <a href="'.$url.'verificar/'.$encriptarEmail.'" style="text-decoration: none; color: #ffffff; font-weight: bold;" target="blank">
                                            Verificar mi dirección de correo electrónico
                                        </a>
                    
                                    </div>
                                    
                    
                                    <hr style="background: #e0e0e0; height: 2px; border: none;">
                                
                                </div>
                                
                                <p style="text-align: center; color: #6b6b6b;">Si no se registró en esta cuenta, puede ignorar este correo electrónico y la uenta se eliminará.</p>
                    
                            </div>
                    
                        </div>');

                        $envio = $mail->Send();

                            

                        if(!$envio){

                            echo '<script>
                        
                                swal({
                                    title: "¡ERROR!",
                                    text: "¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST["regEmail"].$mail->ErrorInfo.'!",
                                    type:"error",
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false
                                },

                                function(isConfirm){

                                    if(isConfirm){
                                        history.back();
                                    }
                                });
                            
                            </script>';


                        }else{

                            echo '<script>

                                    swal({
                                        title: "¡OK!",
                                        text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["regEmail"].' para verificar la cuenta!",
                                        type:"success",
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm: false
                                    },

                                    function(isConfirm){

                                        if(isConfirm){
                                            history.back();
                                        }
                                    });
                            
                            </script>';
                        
                        }

                    }
                    


                }else{

                        echo '<script>
                        
                            swal({
                                title: "ERROR",
                                text: "Error al registrar el usuario",
                                type: "error",
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            },
                            function(isConfirm){
                                if(isConfirm){
                                    history.back();
                                }
                            });
                        
                        </script>';

                    

                }

            }

        }


        /*======================================================
			MOSTRAR USUARIO
        ======================================================*/
        public static function ctrMostrarUsuario($item, $valor){

            $tabla = "usuarios";

            $respuesta = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

            return $respuesta;

        }


        /*======================================================
			ACTUALIZAR USUARIO
        ======================================================*/
        public static function ctrActualizarUsuario($id, $item2, $valor2){

            $tabla = "usuarios";

            $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item2, $valor2);

            return $respuesta;

        }



        /*======================================================
			INGRESO DE USUARIO
        ======================================================*/
        public static function ctrIngresoUsuario(){

            if(isset($_POST["ingEmail"])){
    
                if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingEmail"]) &&
                   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["ingPassword"])){

                    $encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    $tabla = "usuarios";
                    $item = "email";
                    $valor = $_POST["ingEmail"];

                    $respuesta = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

                    if($respuesta["email"] == $_POST["ingEmail"] && $respuesta["password"] == $encriptar){

                        if($respuesta["verificacion"] == 1){

                            echo '<script>
                        
                                swal({
                                    title: "AUN NO HAS VERIFICADO TU CORREO ELECTRONICO",
                                    text: "Por favor revisa tu bandeja de entrada o SPAM de tu cuenta '.$respuesta["email"].' para poder ingresar",
                                    type: "error",
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false
                                },
                                function(isConfirm){
                                    if(isConfirm){
                                        history.back();
                                    }
                                });
                        
                            </script>'; 

                        }else{

                            // CREAMOS VARIABLE DE SESION 
                            $_SESSION["validarSesion"] = "ok";
                            $_SESSION["id"] = $respuesta["id"];
                            $_SESSION["nombre"] = $respuesta["nombre"];
                            $_SESSION["foto"] = $respuesta["foto"];
                            $_SESSION["email"] = $respuesta["email"];
                            $_SESSION["telefono"] = $respuesta["telefono"];
                            $_SESSION["password"] = $respuesta["password"];
                            $_SESSION["modo"] = $respuesta["modo"];

                            echo '<script>
							
                                window.location = localStorage.getItem("rutaActual");

                            </script>';

                        }

                    }else{

                        echo '<script>
                        
                                swal({
                                    title: "ERROR AL INGRESAR",
                                    text: "Por favor revise que el correo o la contraseña exista",
                                    type: "error",
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false
                                },
                                function(isConfirm){
                                    if(isConfirm){
                                        window.location = localStorage.getItem("rutaActual");
                                    }
                                });
                        
                            </script>'; 

                    }

                }else{

                    echo '<script>
                        
                            swal({
                                title: "ERROR",
                                text: "Error al ingresar, no se permiten caracteres espaciales",
                                type: "error",
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            },
                            function(isConfirm){
                                if(isConfirm){
                                    history.back();
                                }
                            });
                        
                        </script>';

                }

            }

        }


        /*======================================================
			OLVIDO CONTRASEÑA
        ======================================================*/
        public static function ctrOlvidoPassword(){

            if(isset($_POST["passEmail"])){

                if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["passEmail"])){

                    /*======================================================
                        GENERAR CONTRASEÑA ALEATORIA
                    ======================================================*/

                    function generarPassword($longitud){

                        $key = "";
                        $pattern = "1234567890abcdefghijklmnopqrstuvwqyz";

                        for($i = 0; $i < $longitud; $i++){

                            $key .= substr($pattern, rand (0, 36), 1);

                        }

                        return $key;

                    }

                    $nuevaPassword = generarPassword(11);

                    $encriptar = crypt($nuevaPassword, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    $tabla = "usuarios";

                    $item1 = "email";
                    $valor1 = $_POST["passEmail"];

                    $respuesta1 = ModeloUsuarios::mdlMostrarUsuario($tabla, $item1, $valor1); //Buscamos el email del usuario para saber su ID en la base de datos

                    if($respuesta1){

                        $id = $respuesta1["id"];
                        $item2 = "password";
                        $valor2 = $encriptar;

                        $respuesta2 = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item2, $valor2);  //Actualizamos la contraseña por la que se acaba de generar

                        if($respuesta2 == "ok"){

                            /*======================================================
                                CAMBIO DE CONTRASEÑA
                            ======================================================*/
    
                            date_default_timezone_set("America/Mexico_City");
    
                            $url = Ruta::ctrRuta();	
    
                            $mail = new PHPMailer;
    
                            $mail->CharSet = 'UTF-8';
    
                            $mail->isMail();
    
                            $mail->setFrom('productos@codeshoes.com', 'Code Shoes');
    
                            $mail->addReplyTo('productos@codeshoes.com', 'Code Shoes');
    
                            $mail->Subject = "Code Shoes Solicitud de nueva Contraseña";
    
                            $mail->addAddress($_POST["passEmail"]);
    
                            $mail->msgHTML('<div style="width: 100%; background: #eee; position: relative; font-family: sans-serif; padding-bottom: 40px; display: flex; align-items: center; flex-direction: column;">

                                <a href="">
                                    <img style="margin: 20px auto; width: 250px;" src="https://i.ibb.co/9H4RDkC/logo.png" alt="">
                                </a>
                        
                                
                                <div class="container" style="width: 50%; background: #ffffff; position: relative;">
                        
                                    <div style="background: #ffffff; width: 90%; margin: 40px auto 0px auto; position: relative;">
                        
                                        <img style="width: 160px; display: block; margin: 20px auto;" src="https://i.ibb.co/8zntNDw/reset-password-icon-29.png" alt="">
                        
                                        <h2 style="width: 100%; display: block; text-align: center; margin-top: 30px; color: #5f5f5f;">SOLICITUD DE SU NUEVA CONTRASEÑA</h2>
                        
                                        <hr style="background: #e0e0e0; height: 2px; border: none;">
                        
                                        <p style="width: 100%; display: block; text-align: center; margin-top: 30px;"><strong>Su nueva contraseña es: </strong>'.$nuevaPassword.'</p>
                        
                                        <div style="width: 80%; max-width: 350px; position: relative; background: #006699; text-align: center; margin: 30px auto; padding: 20px;">
                        
                                            <a href="'.$url.'" style="text-decoration: none; color: #ffffff; font-weight: bold;" target="blank">
                                                Regresar a Code Shoes
                                            </a>
                        
                                        </div>
                                        
                        
                                        <hr style="background: #e0e0e0; height: 2px; border: none;">
                                    
                                    </div>
                                    
                                    <p style="text-align: center; color: #6b6b6b;">Si no se registró en esta cuenta, puede ignorar este correo electrónico y la uenta se eliminará.</p>
                        
                                </div>
                        
                            </div>');
    
                            $envio = $mail->Send();
    
                                
    
                            if(!$envio){
    
                                echo '<script>
                            
                                    swal({
                                        title: "¡ERROR!",
                                        text: "¡Ha ocurrido un problema enviando la nueva contraseña a '.$_POST["passEmail"].$mail->ErrorInfo.'!",
                                        type:"error",
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm: false
                                    },
    
                                    function(isConfirm){
    
                                        if(isConfirm){
                                            history.back();
                                        }
                                    });
                                
                                </script>';
    
    
                            }else{
    
                                echo '<script>
    
                                        swal({
                                            title: "¡OK!",
                                            text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["passEmail"].' para su cambio de contraseña!",
                                            type:"success",
                                            confirmButtonText: "Cerrar",
                                            closeOnConfirm: false
                                        },
    
                                        function(isConfirm){
    
                                            if(isConfirm){
                                                history.back();
                                            }
                                        });
                                
                                </script>';
                            
                            }
    
                        }

                        

                    }else{

                        echo '<script>
                        
                            swal({
                                title: "ERROR",
                                text: "El correo electronico no existe",
                                type: "error",
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            },
                            function(isConfirm){
                                if(isConfirm){
                                    history.back();
                                }
                            });
                    
                        </script>';

                    }



                }else{

                    echo '<script>
                        
                        swal({
                            title: "ERROR",
                            text: "Error al enviar el correo, está mal escrito!",
                            type: "error",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        },
                        function(isConfirm){
                            if(isConfirm){
                                history.back();
                            }
                        });
                
                    </script>';

                }

            }

        }



        /*======================================================
			REGISTRO CON REDES SOCIALES
        ======================================================*/
        public static function ctrRegistroRedesSociales($datos){

            $tabla = "usuarios";
            $item = "email";
            $valor = $datos["email"];
            $emailRepetido = false;

            $respuesta0 = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

            if($respuesta0){

                if($respuesta0["modo"] != $datos["modo"]){
                    
                    echo '<script>
                        
                        swal({
                            title: "ERROR",
                            text: "El correo '.$datos["email"].', ya esta registrado con un metodo diferente a Google",
                            type: "error",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        },
                        function(isConfirm){
                            if(isConfirm){
                                history.back();
                            }
                        });
                
                    </script>';

                    $emailRepetido = false;

                }

                $emailRepetido = true;

            }else{

                $respuesta1 = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);

            }

            if($emailRepetido || $respuesta1 == "ok"){

                $respuesta2 = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

                if($respuesta2["modo"] == "facebook"){

                    session_start();

                    // CREAMOS VARIABLE DE SESION 
                    $_SESSION["validarSesion"] = "ok";
                    $_SESSION["id"] = $respuesta2["id"];
                    $_SESSION["nombre"] = $respuesta2["nombre"];
                    $_SESSION["foto"] = $respuesta2["foto"];
                    $_SESSION["email"] = $respuesta2["email"];
                    $_SESSION["telefono"] = $respuesta2["telefono"];
                    $_SESSION["password"] = $respuesta2["password"];
                    $_SESSION["modo"] = $respuesta2["modo"];

                    echo "ok";

                }else if($respuesta2["modo"] == "google"){

                    // CREAMOS VARIABLE DE SESION 
                    $_SESSION["validarSesion"] = "ok";
                    $_SESSION["id"] = $respuesta2["id"];
                    $_SESSION["nombre"] = $respuesta2["nombre"];
                    $_SESSION["foto"] = $respuesta2["foto"];
                    $_SESSION["email"] = $respuesta2["email"];
                    $_SESSION["telefono"] = $respuesta2["telefono"];
                    $_SESSION["password"] = $respuesta2["password"];
                    $_SESSION["modo"] = $respuesta2["modo"];

                    echo "<span style='color:white; display:none;'>ok</span>";

                }else{

                    echo "";

                }

            }

        }

        /*======================================================
			ACTUALIZAR PERFIL
        ======================================================*/
        public static function ctrActualizarPerfil(){

            if(isset($_POST["editarNombre"])){

                /*======================================================
                    VALIDAR IMAGEN
                ======================================================*/
                $ruta = $_POST["fotoUsuario"];

                if(isset($_FILES["datosImagen"]["tmp_name"]) && !empty($_FILES["datosImagen"]["tmp_name"])){

                    /*======================================================
                        VERIFICAMOS SI YA EXISTE OTRA IMAGEN EN LA BASE DE DATOS
                    ======================================================*/
                    $directorio = "views/img/usuarios/".$_POST["idUsuario"];

                    if(!empty($_POST["fotoUsuario"])){

                        unlink($_POST["fotoUsuario"]);  //Unlink elimina la ruta de la imagen de nuestra base de datos

                    }else{

                        mkdir($directorio, 0755);//Mkdir se usa para crear un nuevo directorio y el 0755 son los permisos de lectura

                    }

                    /*======================================================
                        GUARDAR IMAGEN EN EL DIRECTORIO
                    ======================================================*/
                    list($ancho, $alto) = getimagesize($_FILES["datosImagen"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    $aleatorio = mt_rand(100, 999);

                    if($_FILES["datosImagen"]["type"] == "image/jpeg"){

                        $ruta = "views/img/usuarios/".$_POST["idUsuario"]."/".$aleatorio.".jpg";

                        /*======================================================
                            MODIFICAMOS EL TAMAÑO DE LA FOTO
                        ======================================================*/

                        $origen = imagecreatefromjpeg($_FILES["datosImagen"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);

                    }


                    if($_FILES["datosImagen"]["type"] == "image/png"){

                        $ruta = "views/img/usuarios/".$_POST["idUsuario"]."/".$aleatorio.".png";

                        /*======================================================
                            MODIFICAMOS EL TAMAÑO DE LA FOTO
                        ======================================================*/

                        $origen = imagecreatefrompng($_FILES["datosImagen"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagealphablending($destino, FALSE);

                        imagesavealpha($destino, TRUE);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);

                    }



                }

                //CONTRASEÑA Wichocanul123   $2a$07$asxx54ahjppf45sd87a5auA8T0fF6pOkOI4JA86ZCf1YqUCb.hS6q

                if($_POST["editarPassword"] == "" && $_POST["passwordActual"] == ""){

                    $password = $_POST["passUsuario"];

                    echo '<script>
                            
                                swal({
                                    title: "OK",
                                    text: "Su cuenta ha sido actualizada correctamente.",
                                    type: "success",
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false
                                },
                                function(isConfirm){
                                    if(isConfirm){
                                        history.back();
                                    }
                                });
                        
                            </script>';

                }else if($_POST["editarPassword"] != "" && $_POST["passwordActual"] == ""){

                    $password = $_POST["passUsuario"];

                    echo '<script>
                            
                                swal({
                                    title: "Error",
                                    text: "Por favor agrega tu contraseña actual para por cambiarla",
                                    type: "error",
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false
                                },
                                function(isConfirm){
                                    if(isConfirm){
                                        history.back();
                                    }
                                });
                        
                            </script>';

                }else if($_POST["editarPassword"] == "" && $_POST["passwordActual"] != ""){

                    $password = $_POST["passUsuario"];

                    echo '<script>
                            
                            swal({
                                title: "Error",
                                text: "Por favor agrega la nueva contraseña",
                                type: "error",
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            },
                            function(isConfirm){
                                if(isConfirm){
                                    history.back();
                                }
                            });
                    
                        </script>';

                }else if($_POST["editarPassword"] != "" && $_POST["passwordActual"] != ""){

                    $passwordActual = crypt($_POST["passwordActual"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    if($passwordActual == $_SESSION["password"]){

                        $password = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                        echo '<script>
                            
                                swal({
                                    title: "OK",
                                    text: "Su cuenta ha sido actualizada correctamente.",
                                    type: "success",
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false
                                },
                                function(isConfirm){
                                    if(isConfirm){
                                        history.back();
                                    }
                                });
                        
                            </script>';

                    }else{

                        $password = $_POST["passUsuario"];

                        echo '<script>
                            
                            swal({
                                title: "Error",
                                text: "Las Contraseñas no Coinciden",
                                type: "error",
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            },
                            function(isConfirm){
                                if(isConfirm){
                                    history.back();
                                }
                            });
                    
                        </script>';

                    }

                }

                $datos = array("nombre" => $_POST["editarNombre"],
                                "email" => $_POST["editarEmail"],
                                "telefono" => $_POST["numeroTelefono"],
                                "password" => $password,
                                "foto" => $ruta,
                                "id" => $_POST["idUsuario"]);

                $tabla = "usuarios";

                $respuesta = ModeloUsuarios::mdlActualizarPerfil($tabla, $datos);

                if($respuesta == "ok"){

                    // ACTUALIZAMOS LAS VARIABLES DE SESION
                    $_SESSION["validarSesion"] = "ok";
                    $_SESSION["id"] = $datos["id"];
                    $_SESSION["nombre"] = $datos["nombre"];
                    $_SESSION["foto"] = $datos["foto"];
                    $_SESSION["email"] = $datos["email"];
                    $_SESSION["telefono"] = $datos["telefono"];
                    $_SESSION["password"] = $datos["password"];
                    $_SESSION["modo"] = $_POST["modoUsuario"];

                }

            }
        
            

        }


        /*======================================================
			MOSTRAR COMPRAS
        ======================================================*/
        public static function ctrMostrarCompras($item, $valor){

            $tabla = "compras";

            $respuesta = ModeloUsuarios::mdlMostrarCompras($tabla, $item, $valor);

            return $respuesta;

        }


        /*======================================================
			MOSTRAR COMENTARIOS PERFIL
        ======================================================*/
        public static function ctrMostrarComentariosPerfil($datos){

            $tabla = "comentarios";

            $respuesta = ModeloUsuarios::mdlMostrarComentariosPerfil($tabla, $datos);

            return $respuesta;

        }


        /*======================================================
			ACTUALIZAR COMENTARIOS
        ======================================================*/
        public static function ctrActualizarComentario(){

            if(isset($_POST["idComentario"])){

                if($_POST["comentario"] != ""){

                    if(preg_match('/^[?\\¿\\¡\\!\\,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["comentario"])){

                        $tabla = "comentarios";

                        $datos = array("id"=>$_POST["idComentario"],
                                        "calificacion"=>$_POST["puntaje"],
                                        "comentario"=>$_POST["comentario"]);

                        $respuesta = ModeloUsuarios::mdlActualizarComentario($tabla, $datos);

                        if($respuesta == "ok"){

                            echo '<script>
                            
                                swal({
                                    title: "GRACIAS POR COMPARTIR TU OPINIÓN",
                                    text: "Su calificacion y comentario se han publicado!",
                                    type: "success",
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false
                                },
                                function(isConfirm){
                                    if(isConfirm){
                                        history.back();
                                    }
                                });
                        
                            </script>';

                        }

                    }else{

                        echo '<script>
                            
                            swal({
                                title: "Error",
                                text: "El comentario no puede llevar caracteres especiales!",
                                type: "error",
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            },
                            function(isConfirm){
                                if(isConfirm){
                                    history.back();
                                }
                            });
                    
                        </script>';

                    }

                }else{

                    $tabla = "comentarios";

                        $datos = array("id"=>$_POST["idComentario"],
                                        "calificacion"=>$_POST["puntaje"],
                                        "comentario"=>$_POST["comentario"]);

                        $respuesta = ModeloUsuarios::mdlActualizarComentario($tabla, $datos);

                        if($respuesta == "ok"){

                            echo '<script>
                            
                                swal({
                                    title: "GRACIAS POR COMPARTIR TU OPINIÓN",
                                    text: "Su calificacion se ha publicado!",
                                    type: "success",
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false
                                },
                                function(isConfirm){
                                    if(isConfirm){
                                        history.back();
                                    }
                                });
                        
                            </script>';

                        }

                }

            }

        }


        /*======================================================
			MOSTRAR COMENTARIOS PRODUCTO
        ======================================================*/
        public static function ctrMostrarComentariosProducto($datos){

            $tabla = "comentarios";

            $respuesta = ModeloUsuarios::mdlMostrarComentariosProducto($tabla, $datos);

            return $respuesta;

        }


        /*======================================================
			AGREGAR A LISTA DE DESEOS
        ======================================================*/
        public static function ctrAgregarDeseo($datos){

            $tabla = "deseos";

            $respuesta = ModeloUsuarios::mdlAgregarDeseo($tabla, $datos);

            return $respuesta;
            
        }


        /*======================================================
			MOSTRAR LISTA DE DESEOS
        ======================================================*/
        public static function ctrMostrarDeseos($item){

            $tabla = "deseos";

            $respuesta = ModeloUsuarios::mdlMostrarDeseos($tabla, $item);

            return $respuesta;

        }


        /*======================================================
			QUITAR DE LISTA DE DESEOS
        ======================================================*/
        public static function ctrQuitarDeseo($datos){

            $tabla = "deseos";

            $respuesta = ModeloUsuarios::mdlQuitarDeseo($tabla, $datos);

            return $respuesta;

        }


        /*======================================================
			ELIMINAR USUARIO 
        ======================================================*/
        public static function ctrEliminarUsuario(){

            if(isset($_GET["id"])){

                $tabla1 = "usuarios";
                $tabla2 = "comentarios";
                $tabla3 = "compras";
                $tabla4 = "deseos";

                $id = $_GET["id"];

                if(isset($_GET["foto"]) != ""){

                    unlink ($_GET["foto"]);
                    rmdir('views/img/usuarios'.$_GET["id"]);

                }

                $respuesta = ModeloUsuarios::mdlEliminarUsuario($tabla1, $id);
                ModeloUsuarios::mdlEliminarComentarios($tabla2, $id);
                ModeloUsuarios::mdlEliminarCompras($tabla3, $id);
                ModeloUsuarios::mdlEliminarListaDeseos($tabla4, $id);

                if($respuesta == "ok"){

                    $url = Ruta::ctrRuta();

                    echo '<script>
                            
                                swal({
                                    title: "SU CUENTA HA SIDO BORRADA!",
                                    text: "Esperamos que regrese pronto =)",
                                    type: "success",
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false
                                },
                                function(isConfirm){
                                    if(isConfirm){
                                        window.location = "'.$url.'salir";
                                    }
                                });
                        
                            </script>';

                }

            }

        }






    }

?>