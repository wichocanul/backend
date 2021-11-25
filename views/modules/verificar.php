<!-- ======================================================
    VERIFICAR
====================================================== -->

<?php

    $item = "emailEncriptado";  //Es el item que esta en mi base de datos
    $valor = $rutas[1]; //El valorque viene en la url de rutas[1]
    $usuarioVerificado = false;

    $respuesta = ControladorUsuarios::ctrMostrarUsuario($item, $valor);

    if($valor == $respuesta["emailEncriptado"]){

        $id = $respuesta["id"];
        $item2 = "verificacion";
        $valor2 = 0;

        $respuesta2 = ControladorUsuarios::ctrActualizarUsuario($id, $item2, $valor2);

        if($respuesta2 == "ok"){

            $usuarioVerificado = true;

        }

    }

    

?>

<div class="container">

    <div class="row">

        <div class="col-12 text-center verificar">

            <?php

                if($usuarioVerificado){

                    echo '<h3>Gracias</h3>
                        <h2><small>!Hemos verificado tu correo electronico, ya puede ingresar al sistema!</small><//h2>
                        
                        <br>
                        
                        <div class="btnRegresarIngresar">
                            <a href="#modalIngreso" data-bs-toggle="modal" data-bs-target="#modalIngreso">INGRESAR</a>
                        </div>';

                }else{

                    echo '<h3>ERROR</h3>
                    <h2><small>!No se ha podido verificar el correo electronico, vuelva a registrarse!</small><//h2>
                    
                    <br>
                    
                    <div class="btnRegresarIngresar">
                        <a href="#modalRegistro" data-bs-toggle="modal" data-bs-target="#modalRegistro">REGISTRO</a>
                    </div>';

                }

            ?>

        </div>

    </div>

</div>