<?php
    $servidor = Ruta::ctrRutaServidor();
    $url = Ruta::ctrRuta();

    /*======================================================
    INICIO DE SESION USUARIO
    ======================================================*/
    if(isset($_SESSION["validarSesion"])){

        if($_SESSION["validarSesion"] == "ok"){

            echo '<script>

                    localStorage.setItem("usuario","'.$_SESSION["id"].'");

                </script>';

        }

    }


    /*======================================================
    CREACION DEL OBJETO API DE GOOGLE
    ======================================================*/
    $cliente = new Google_Client();
    $cliente -> setAuthConfig('models/client_secret.json');
    $cliente->setAccessType("offline");
    $cliente->setScopes(['profile','email']);


    /*======================================================
    RUTA PARA EL LOGIN DE GOOGLE
    ======================================================*/
    $rutaGoogle = $cliente->createAuthUrl();

    /*======================================================
    RECIBIMOS LA VARIABLE GET DE GOOGLE LLAMADA CODE
    ======================================================*/
    if(isset($_GET["code"])){

        $token = $cliente->authenticate($_GET["code"]);

        $_SESSION['id_token_google'] = $token;

        $cliente->setAccessToken($token);

    }

    /*======================================================
    RECIBIMOS LOS DATOS CIFRADOS DE GOOGLE EN UN ARRAY
    ======================================================*/
    if($cliente->getAccessToken()){

        $item = $cliente->verifyIdToken();

        $datos = array("nombre"=>$item["name"],
                        "email"=>$item["email"],
                        "foto"=>$item["picture"],
                        "password"=>"null",
                        "modo"=>"google",
                        "verificacion"=>0,
                        "emailEncriptado"=>"null");

        $respuesta = ControladorUsuarios::ctrRegistroRedesSociales($datos);
  
        echo '<script>
        
                setTimeout(function(){
                    window.location = localStorage.getItem("rutaActual");
                },1000);

            </script>';

    }


?>

<!-- BOTON SCROLL UP -->
<div id="button_up">
    <i class="fas fa-chevron-up"></i>
</div>

<div class="container-fluid barraSuperior" id="top">

    <div class="container">

        <div class="row">
            
            <!-- SOCIAL --------------------------->
            <div class="col-lg-9 col-md-8 col-sm-7 col-12 social">

                <ul>

                    <?php
                      $social = ControladorPlantilla::ctrEstiloTemplate();

                      $jsonRedesSociales = json_decode($social["redesSociales"],true);

                      foreach ($jsonRedesSociales as $key => $value){

                        echo    '<li>
                                    <a href="'.$value["url"].'" target="_blank">
                                        <i class="fab '.$value["red"].' redSocial '.$value["estilo"].'"></i>
                                    </a>
                                </li>';

                      }
                    ?>

                    

                </ul>

            </div>

            <!-- REGISTRO -------------------------->
            <div class="col-lg-3 col-md-4 col-sm-5 col-12 registro">

                <ul>

                    <?php

                        if(isset($_SESSION["validarSesion"])){    //Linea 246 del controlador

                            if($_SESSION["validarSesion"] == "ok"){

                                if($_SESSION["modo"] == "directo"){

                                    if($_SESSION["foto"] != ""){

                                        echo '<li>
                                                <img class="imgCabePerfil" src="'.$url.$_SESSION["foto"].'" width="10%">
                                            </li>';

                                    }else{

                                        echo '<li>
                                                <img class="imgCabePerfil" src="'.$servidor.'views/img/usuarios/default/anonymous.png" width="10%">
                                            </li>';

                                    }

                                    echo '<li>|</li>
                                    <li><a href="'.$url.'perfil">Ver Perfil</a></li>
                                    <li>|</li>
                                    <li><a href="'.$url.'salir">Salir</a></li>';

                                }if($_SESSION["modo"] == "facebook"){

                                    echo '<li>
                                            <img class="imgCabePerfil" src="'.$_SESSION["foto"].'" width="10%">
                                        </li>
                                        <li>|</li>
                                        <li><a href="'.$url.'perfil">Ver Perfil</a></li>
                                        <li>|</li>
                                        <li><a href="'.$url.'salir" class="salir">Salir</a></li>';

                                }
                                
                                if($_SESSION["modo"] == "google"){

                                    echo '<li>
                                            <img class="imgCabePerfil" src="'.$_SESSION["foto"].'" width="10%">
                                        </li>
                                        <li>|</li>
                                        <li><a href="'.$url.'perfil">Ver Perfil</a></li>
                                        <li>|</li>
                                        <li><a href="'.$url.'salir">Salir</a></li>';

                                }

                            }

                        }else{

                            echo '<li><a href="#modalIngreso" data-bs-toggle="modal" data-bs-target="#modalIngreso">Ingresar</a></li>
                            <li>|</li>
                            <li><a href="#modalRegistro" data-bs-toggle="modal" data-bs-target="#modalRegistro">Crear Cuenta</a></li>';

                        }

                    ?>

                </ul>

            </div>

        </div>

    </div>

</div>






<!-- ================================================
HEADER 
================================================= -->

<header class="container-fluid">

    <div class="container">

        <div class="row" id="cabezote">
            <!-- LOGOTIPO -->
            <div class="col-lg-3 col-md-3 col-sm-12" id="logotipo">

                <a href="<?php echo $url; ?>"><img src="<?php echo $servidor.$social["logo"]; ?>" alt=""></a>

            </div>

            <!-- CATEGORIAS Y BUSCADOR -->
            <div class="col-lg-6 col-md-6 col-sm-12" id="logotipo">
                
                <!-- BUSCADOR -->
                <div class="input-group col-lg-8 col-md-8 col-sm-12" id="buscador">

                    <!-- BOTON DE CATEGORIAS -->
                    <div class="col-lg-3 col-md-4 col-sm-12 backColor" id="btnCategorias">
                        <p>CATEGORÍAS
                            <span><i class="fas fa-bars"></i></span>
                        </p>
                    </div>

                    <input type="search" name="buscar" class="form-control" placeholder="Buscar...">
                    
                    <span class="input-group-btn">

                        <a href="<?php echo $url; ?>buscador/1/recientes">

                            <button class="btn btn-default backColor" type="submit">

                                <i class="fas fa-search"></i>
                                
                            </button>

                        </a>

                    </span>

                </div>

            </div>

            <!-- CARRITO DE COMPRAS -->
            <div class="col-lg-3 col-md-3 col-sm-12" id="carrito">

                <a href="<?php echo $url;?>carrito-de-compras">
                    <button class="btn btn-default float-start backColor">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </a>
                <p>TU CARRITO <span class="cantidadCesta"></span> <br> MX $ <span class="sumaCesta"></span></p>

            </div>

        </div>

        <!-- CATEGORIAS -->
        <div class="col-12 backColor" id="categorias">

            <div class="row">
            
            <?php

                $item = null;
                $valor = null;

                $categorias = ControladorProductos::ctrMostrarCategorias($item, $valor);

                foreach($categorias as $key => $value){

                    echo '<div class="col-lg-2 col-md-3 col-sm-4 col-12 firstcat">
                            <h4>
                                <a href="'.$url.$value["ruta"].'" class="pixelCategorias">'.$value["categoria"].'</a>
                            </h4>
                            
                            <hr>

                            <ul>';

                            $item = "id_categoria";
                            $valor = $value["id"];

                            $subcategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);

                            foreach ($subcategorias as $key => $value) {
                                
                                echo '<li><a href="'.$url.$value["ruta"].'" class="pixelSubCategorias">'.$value["subcategoria"].'</a></li>';
                            }	

                            echo '</ul>
                        </div>';
                }
            ?>
    
            </div>

        </div>


    </div>

</header>


<!-- ================================================
VENTANA MODAL PARA EL REGISTRO
================================================= -->

<div class="modal fade modalFormulario" id="modalRegistro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> <!-- modal-backdrop.show{opacity:0.3 -->

    <img class="imaRegistro" src="<?php echo $servidor.$social["logo"]; ?>" alt="">

    <div class="modal-dialog modal-dialog-centered">     

        <div class="modal-content modalBox">

            <div class="modal-body modalTitulo">

                <h3 class="backColor">REGISTRARSE</h3>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <div class="row">

                    <!-- ================================================
                    REGISTRO DE FACEBOOK
                    ================================================= -->
                    <div class="col-sm-6 col-12 facebook">
                        <p>
                            <i class="fa fa-facebook"></i>
                            Registro con Facebook
                        </p>
                    </div>

                    <!-- ================================================
                    REGISTRO DE GOOGLE
                    ================================================= -->
                    <div class="col-sm-6 col-12 google">
                        <a href="<?php echo $rutaGoogle; ?>">
                            <p>
                                <i class="fa fa-google"></i>
                                Registro con Google
                            </p>
                        </a>
                    </div>
                    
                    <!-- ================================================
                    REGISTRO DIRECTO
                    ================================================= -->
                    <form method="post" onsubmit="return registroUsuario()">

                        <div class="formularioRegistro">

                            <div class="boxreg">

                                <span>
                                    <i class="far fa-user"></i>
                                </span>

                                <input type="text" class="" id="regUsuario" name="regUsuario" placeholder="Nombre Completo" required>

                            </div>

                            <div class="boxreg">

                                <span>
                                    <i class="far fa-envelope"></i>
                                </span>

                                <input type="email" class="" id="regEmail" name="regEmail" placeholder="Correo Electrónico" required>

                            </div>

                            <div class="boxreg">

                                <span>
                                    <i class="fas fa-shield-alt"></i>
                                </span>

                                <input type="password" class="" id="regPassword" name="regPassword" placeholder="Contraseña" required>

                            </div>

                            <div class="checkBox">

                                <label>

                                    <input id="regPoliticas" type="checkbox">

                                    <small>Al registrarse, acepta nuestras politicas de privacidad</small>
                                    <p><a href="<?php echo $url; ?>politicas">Leer más</a></p>

                                </label>

                            </div>

                            <?php

                                $registro = new ControladorUsuarios(); //Creamos un nuevo objeto instanciando la clase del controlador
                                $registro -> ctrRegistroUsuario(); //ejecutamos el metodo

                            ?>

                            <input type="submit" class="registroEnviar" value="REGISTRARSE">

                        </div>

                    </form>
                
                </div>

            </div>

            <div class="modal-footer footerReg">

                <p>¿Ya tienes una cuenta? |</p><strong><a href="#modalIngreso" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalIngreso">Ingresar</a></strong>

            </div>
            
        </div>

    </div>

</div>




<!-- ================================================
VENTANA MODAL PARA EL INGRESO
================================================= -->

<div class="modal fade modalFormulario" id="modalIngreso" tabindex="-1" aria-labelledby="modalIngreso" aria-hidden="true"> <!-- modal-backdrop.show{opacity:0.3 -->

    <img class="imaRegistro" src="<?php echo $servidor.$social["logo"]; ?>" alt="">

    <div class="modal-dialog modal-dialog-centered">     

        <div class="modal-content modalBox">

            <div class="modal-body modalTitulo">

                <h3 class="backColor">INGRESAR</h3>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <div class="row">

                    <!-- ================================================
                    INGRESO DE FACEBOOK
                    ================================================= -->
                    <div class="col-sm-6 col-12 facebook">
                        <p>
                            <i class="fa fa-facebook"></i>
                            Ingreso con Facebook
                        </p>
                    </div>

                    <!-- ================================================
                    INGRESO DE GOOGLE
                    ================================================= -->
                    <div class="col-sm-6 col-12 google">
                        <a href="<?php echo $rutaGoogle; ?>">
                            <p>
                                <i class="fa fa-google"></i>
                                Ingreso con Google
                            </p>
                        </a>
                    </div>
                    

                    <!-- ================================================
                    INGRESO DIRECTO
                    ================================================= -->
                    <form method="post">

                        <div class="formularioRegistro">

                            <div class="boxreg">

                                <span>
                                    <i class="far fa-envelope"></i>
                                </span>

                                <input type="email" class="" id="ingEmail" name="ingEmail" placeholder="Correo Electrónico" required>

                            </div>

                            <div class="boxreg">

                                <span>
                                    <i class="fas fa-shield-alt"></i>
                                </span>

                                <input type="password" class="" id="ingPassword" name="ingPassword" placeholder="Contraseña" required>

                            </div>

                            <?php

                                $ingreso = new ControladorUsuarios(); //Creamos un nuevo objeto instanciando la clase del controlador
                                $ingreso -> ctrIngresoUsuario(); //ejecutamos el metodo

                            ?>

                            <input type="submit" class="registroEnviar2 mt-3 btnIngreso" value="INGRESAR">

                            <br>

                            <a href="#modalPassword" class="olvCont" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalPassword">
                                ¿Olvidaste tu contraseña?
                            </a>

                        </div>

                    </form>
                
                </div>

            </div>

            <div class="modal-footer footerReg">

                <p>¿No tienes una cuenta? |</p><strong><a href="#modalRegistro" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalRegistro">Registrarse</a></strong>

            </div>
            
        </div>

    </div>

</div>



<!-- ================================================
VENTANA MODAL PARA OLVIDO DE CONTRASEÑA
================================================= -->
<div class="modal fade modalFormulario" id="modalPassword" tabindex="-1" aria-labelledby="modalPassword" aria-hidden="true"> <!-- modal-backdrop.show{opacity:0.3 -->

<img class="imaRegistro" src="<?php echo $servidor.$social["logo"]; ?>" alt="">

<div class="modal-dialog modal-dialog-centered">     

    <div class="modal-content modalBox">

        <div class="modal-body modalTitulo">

            <h3 class="backColor">SOLICITAR CONTRASEÑA</h3>

            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            <div class="row">

                <!-- ================================================
                OLVIDO CONTRASEÑA
                ================================================= -->
                <form method="post">

                    <div class="formularioRegistro">

                        <div class="boxreg">

                            <label for="passEmail" class="labelPassEmail">Escribe el correo electronico con el que te registraste, y ahí te enviaremos una nueva contraseña:</label>

                            <span>
                                <i class="far fa-envelope"></i>
                            </span>

                            <input type="email" class="" id="passEmail" name="passEmail" placeholder="Correo Electrónico" required>

                        </div>

                        <?php

                            $password = new ControladorUsuarios(); //Creamos un nuevo objeto instanciando la clase del controlador
                            $password -> ctrOlvidoPassword(); //ejecutamos el metodo

                        ?>
                        

                        <input type="submit" class="registroEnviar2 mt-3" value="ENVIAR">     <!-- btnIngreso -->

                    </div>

                </form>
            
            </div>

        </div>

        <div class="modal-footer footerReg">

            <p>¿No tienes una cuenta? |</p><strong><a href="#modalRegistro" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalRegistro">Registrarse</a></strong>

        </div>
        
    </div>

</div>

</div>