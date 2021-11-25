<!-- ======================================================
    VALIDAR SESION
====================================================== -->
<?php

$url = Ruta::ctrRuta();
$servidor = Ruta::ctrRutaServidor();

if(!isset($_SESSION["validarSesion"])){

    echo '<script>
            window.location = "'.$url.'";
        </script>';

    exit();

}

?>

<!-- ======================================================
    BREADCRUMB PERFIL
====================================================== -->
<div class="container-fluid">

    <div class="container">

        <div class="row">

            <ul class="breadcrumb fondoBreadcrumb lead">

                <li class="breadcrumb-item"><a href="<?php echo $url; ?>">INICIO</a></li>
                <li class="breadcrumb-item active pagActiva"><?php echo $rutas[0] ?></li>

            </ul>

        </div>

    </div>

</div>

<div class="container-fluid">

    <div class="container">

        <ul class="nav nav-tabs perfilTabs" id="myTab" role="tablist">

            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="compras-tab" data-bs-toggle="tab" data-bs-target="#compras" type="button" role="tab" aria-controls="compras" aria-selected="true">
                    <i class="fa fa-list-ul"></i>
                    Mis Compras
                </button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="deseos-tab" data-bs-toggle="tab" data-bs-target="#deseos" type="button" role="tab" aria-controls="deseos" aria-selected="false">
                    <i class="fas fa-gifts"></i>
                    Lista de Deseos
                </button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="perfil-tab" data-bs-toggle="tab" data-bs-target="#perfil" type="button" role="tab" aria-controls="perfil" aria-selected="false">
                    <i class="fas fa-user"></i>
                    Editar Perfil
                </button>
            </li>

            <li class="nav-item" role="presentation">
                <a href="<?php echo$url; ?>ofertas">
                    <button class="nav-link" id="ofertas-tab" type="button" aria-controls="ofertas" aria-selected="false">
                        <i class="fas fa-star"></i>
                        Ver Ofertas
                    </button>
                </a>
                
            </li>

        </ul>

        <div class="tab-content" id="myTabContent">
            <!-- ======================================================
                PESTAÑA COMPRAS
            ====================================================== -->
            <div class="tab-pane fade show active" id="compras" role="tabpanel" aria-labelledby="compras-tab">
                
                <div class="comprasGroup">

                    <?php

                        $item = "id_usuario";
                        $valor = $_SESSION["id"];

                        $compras = ControladorUsuarios::ctrMostrarCompras($item, $valor);

                        if(!$compras){

                            echo '<div class="col-12 text-center textError">

                                    <h1>Oops!</h1>
                                    <h4>Aun no tienes compras Realizadas en la tienda</h4>
                            
                                </div>';

                        }else{

                            foreach($compras as $key => $value1){

                                $ordenar = "fecha";
                                $item = "id";
                                $valor = $value1["id_producto"];

                                $productos = ControladorProductos::ctrListarProductos($ordenar, $item, $valor);

                                foreach($productos as $key => $value2){

                                    echo '<div class="panelDefault">
                                        <div class="panel-body">

                                            <div class="row">

                                                <div class="col-md-2 col-sm-6 col-12">
                                                
                                                    <figure>
                                                        <img class="img-thumbnail" src="'.$servidor.$value2["portada"].'">
                                                    </figure>

                                                </div>

                                                <div class="col-sm-6 col-12 progreso">

                                                    <a href="'.$url.$value2["ruta"].'"><h1><small>'.$value2["titulo"].'</small></h1></a>
                                                    <p>'.$value2["titular"].'</p>

                                                    <h6>Proceso de Entrega: '.$value2["entrega"].' días habiles</h6>
                                                    
                                                    <h6>ID de seguimiento: <a href="#">'.$value1["codigoRastreo"].'</a></h6>';

                                                    if($value1["envio"] == 0){

                                                        echo '<div class="barraProgress">

                                                            <div class="progress" style="height: 20px">

                                                                <div class="progress-bar bg-info d-block" role="progressbar" style="width: 33.33%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                                    <p class="activar"><i class="fas fa-check"></i> Preparando</p>
                                                                </div>

                                                                <div class="progress-bar d-block bgNormal" role="progressbar" style="width: 33.33%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                                <p class="desactivar"><i class="fas fa-clock"></i>En Camino</p>
                                                                </div>

                                                                <div class="progress-bar d-block bgNormal" role="progressbar" style="width: 33.33%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                                    <p class="desactivar"><i class="fas fa-clock"></i> Entregado</p>
                                                                </div>

                                                            </div>

                                                            <div class="progress" style="height: 30px">

                                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-info d-block" role="progressbar" style="width: 33.33%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                                    <i class="fas fa-box activar"></i>
                                                                </div>

                                                                <div class="progress-bar fonfo d-block" role="progressbar" style="width: 33.33%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                                    <i class="fas fa-shipping-fast desactivar"></i>
                                                                </div>

                                                                <div class="progress-bar fonfo d-block" role="progressbar" style="width: 33.33%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                                    <i class="fas fa-igloo desactivar"></i>
                                                                </div>

                                                            </div>

                                                        </div>';

                                                    }

                                                    if($value1["envio"] == 1){

                                                        echo '<div class="barraProgress">

                                                            <div class="progress" style="height: 20px">

                                                                <div class="progress-bar bg-info d-block" role="progressbar" style="width: 33.33%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                                    <p class="activar"><i class="fas fa-check"></i> Preparando</p>
                                                                </div>

                                                                <div class="progress-bar bg-camino d-block" role="progressbar" style="width: 33.33%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                                <p class="activar"><i class="fas fa-check"></i>En Camino</p>
                                                                </div>

                                                                <div class="progress-bar d-block bgNormal" role="progressbar" style="width: 33.33%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                                    <p class="desactivar"><i class="fas fa-clock"></i> Entregado</p>
                                                                </div>

                                                            </div>

                                                            <div class="progress" style="height: 30px">

                                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-info d-block" role="progressbar" style="width: 33.33%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                                    <i class="fas fa-box activar"></i>
                                                                </div>

                                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-camino d-block" role="progressbar" style="width: 33.33%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                                    <i class="fas fa-shipping-fast activar"></i>
                                                                </div>

                                                                <div class="progress-bar fonfo d-block" role="progressbar" style="width: 33.33%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                                    <i class="fas fa-igloo desactivar"></i>
                                                                </div>

                                                            </div>

                                                        </div>';

                                                    }


                                                    if($value1["envio"] == 2){

                                                        echo '<div class="barraProgress">

                                                            <div class="progress" style="height: 20px">

                                                                <div class="progress-bar bg-info d-block" role="progressbar" style="width: 33.33%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                                    <p class="activar"><i class="fas fa-check"></i> Preparando</p>
                                                                </div>

                                                                <div class="progress-bar bg-camino d-block" role="progressbar" style="width: 33.33%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                                <p class="activar"><i class="fas fa-check"></i>En Camino</p>
                                                                </div>

                                                                <div class="progress-bar d-block bg-success" role="progressbar" style="width: 33.33%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                                    <p class="activar"><i class="fas fa-check"></i> Entregado</p>
                                                                </div>

                                                            </div>

                                                            <div class="progress" style="height: 30px">

                                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-info d-block" role="progressbar" style="width: 33.33%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                                    <i class="fas fa-box activar"></i>
                                                                </div>

                                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-camino d-block" role="progressbar" style="width: 33.33%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                                    <i class="fas fa-shipping-fast activar"></i>
                                                                </div>

                                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success d-block" role="progressbar" style="width: 33.33%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                                    <i class="fas fa-igloo activar"></i>
                                                                </div>

                                                            </div>

                                                        </div>';

                                                    }
                                                
                                                    echo '<h4 class="fechaCompra">Comprado el: '.substr($value1["fecha"], 0, -8).'</h4>
                                                
                                                </div>

                                                <div class="col-md-4 col-12 comentariosSection">';

                                                    $datos = array("idUsuario" => $_SESSION["id"],
                                                                    "idProducto"=> $value2["id"]);

                                                    $comentarios = ControladorUsuarios::ctrMostrarComentariosPerfil($datos);
                                                
                                                    echo '<div class="btnCalificar text-center">
                                                    
                                                        <a class="calificarProducto" href="#modalComentarios" data-bs-toggle="modal" data-bs-target="#modalComentarios" idComentario="'.$comentarios["id"].'">
                                                            <button class="backColor">Calificar Producto</button>
                                                        </a>

                                                    </div>

                                                    <br>

                                                    <div class="starCal text-center">

                                                        <h4>';

                                                        if($comentarios["calificacion"] == 0 || $comentarios["calificacion"] == ""){

                                                            echo '<i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>';

                                                        }else{

                                                            switch($comentarios["calificacion"]){

                                                                case 1:
                                                                    echo '<i class="fa fa-star"></i>
                                                                         <i class="fa fa-star-o"></i>
                                                                         <i class="fa fa-star-o"></i>
                                                                         <i class="fa fa-star-o"></i>
                                                                         <i class="fa fa-star-o"></i>';
                                                                break;

                                                                case 2:
                                                                    echo '<i class="fa fa-star"></i>
                                                                         <i class="fa fa-star"></i>
                                                                         <i class="fa fa-star-o"></i>
                                                                         <i class="fa fa-star-o"></i>
                                                                         <i class="fa fa-star-o"></i>';
                                                                break;

                                                                case 3:
                                                                    echo '<i class="fa fa-star"></i>
                                                                         <i class="fa fa-star"></i>
                                                                         <i class="fa fa-star"></i>
                                                                         <i class="fa fa-star-o"></i>
                                                                         <i class="fa fa-star-o"></i>';
                                                                break;

                                                                case 4:
                                                                    echo '<i class="fa fa-star"></i>
                                                                         <i class="fa fa-star"></i>
                                                                         <i class="fa fa-star"></i>
                                                                         <i class="fa fa-star"></i>
                                                                         <i class="fa fa-star-o"></i>';
                                                                break;

                                                                case 5:
                                                                    echo '<i class="fa fa-star"></i>
                                                                         <i class="fa fa-star"></i>
                                                                         <i class="fa fa-star"></i>
                                                                         <i class="fa fa-star"></i>
                                                                         <i class="fa fa-star"></i>';
                                                                break;

                                                            }

                                                        }

                                                        echo '</h4>
                                                    
                                                    </div>';

                                                    if($comentarios["comentario"] == ""){

                                                        echo '<p class="comentPanel text-center">
                                                        
                                                        Aun no existe un comentario
                                                    
                                                        </p>';

                                                    }else{

                                                        echo '<p class="comentPanel">
                                                        
                                                        '.$comentarios["comentario"].'
                                                    
                                                        </p>';

                                                    }
                                                    

                                                echo '</div>

                                            </div>

                                        </div>
                                    </div>';

                                }                            

                            }

                        }

                    ?>

                </div>

            </div>

            <!-- ======================================================
                PESTAÑA LISTA DESEOS
            ====================================================== -->
            <div class="tab-pane fade" id="deseos" role="tabpanel" aria-labelledby="deseos-tab">

                <div class="productos">

                    <div class="row">
                
                        <?php

                            $item = $_SESSION["id"];
                            $deseos = ControladorUsuarios::ctrMostrarDeseos($item);

                            if(!$deseos){

                                echo '<div class="col-12 text-center textError">

                                    <h1>Oooh no!</h1>
                                    <h4>Aún no tienes productos en tu lista de deseos</h4>
                            
                                </div>';

                            }else{

                                foreach($deseos as $key => $value1){

                                    $ordenar = "id";
                                    $item = "id";
                                    $valor = $value1["id_producto"]; //casilla en la base de datos

                                    $productos = ControladorProductos::ctrListarProductos($ordenar, $item, $valor);

                                    echo '<ul class="col-12 col-md-6 col-lg-3 grid0">

                                        <div class="row">';

                                            foreach($productos as $key => $value2){

                                                echo '<li class="col-lg-12">

                                                        <figure>

                                                            <a href="'.$url.$value2["ruta"].'">
                                                                <img src="'.$servidor.$value2["portada"].'" class="img-fluid">
                                                            </a>

                                                        </figure>

                                                        
                                                        <h4>
                                                            <small>
                                                                <a href="'.$url.$value2["ruta"].'" class="pixelProducto">
                                                                    '.$value2["titulo"].'
                                                                    <br>
                                                                    <span style="color:rgba(0,0,0,0); margin-left:-5px">-</span>';
                                                                    
                                                                    if($value2["nuevo"] != 0){
                                                                        echo '<span class="badge bg-warning text-dark fontSize">Nuevo</span> ';
                                                                    }

                                                                    if($value2["oferta"] != 0){
                                                                        echo '<span class="badge bg-warning text-dark fontSize">'.$value2["descuentoOferta"].'% off</span>';
                                                                    }

                                                                echo '</a>
                                                            </small>
                                                        </h4>

                                                        
                                                        <div class="container">

                                                            <div class="row">
                                                                
                                                                <div class="col-8 precio">';

                                                                    if($value2["precio"] == 0){

                                                                        echo' <h2>
                                                                            <small class="normal">GRATIS</small>
                                                                        </h2>';

                                                                    }else{

                                                                        if($value2["oferta"] != 0){

                                                                            echo' <small>
                                                                                    <strong class="oferta">MX $'.$value2["precio"].'</strong>
                                                                                </small>
                                            
                                                                                <small class="normal">$'.$value2["precioOferta"].'</small>';

                                                                        }else{

                                                                            echo '<h2>
                                                                                    <small class="normal">$'.$value2["precio"].'</small>
                                                                                </h2>';

                                                                        }

                                                                    }
                                                                    
                                                                echo '</div>

                                                                <div class="col-4 enlaces">

                                                                    <div class="btn-group float-end">

                                                                        <button type="button" class="quitarDeseo bg-danger" idDeseo="'.$value1["id"].'">
                                                                        
                                                                        <img src="'.$ruta.'views/img/plantilla/cora.png" id="EpicButton" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                                                        </button>

                                                                        <a href="'.$url.$value2["ruta"].'" class="pixelProducto">
                                                                        
                                                                            <button type="button">
                                                                                <i class="far fa-eye" id="EpicButton" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ver Producto"></i>
                                                                            </button>

                                                                        </a>

                                                                    </div>

                                                                </div>

                                                            </div>
                                                            
                                                        </div>

                                                    </li>';
                                            }

                                        echo '</div>
                                        
                                    </ul>';

                                }

                            }

                        ?>

                    </div>

                </div>

            </div>
            <!-- ======================================================
                PESTAÑA EDITAR PERFIL
            ====================================================== -->
            <div class="tab-pane fade" id="perfil" role="tabpanel" aria-labelledby="perfil-tab">
            
                <div class="row">

                    <form method="post" enctype="multipart/form-data" action="">

                        <div class="row">

                            <div class="col-md-3 col-sm-4 col-12 text-center">

                                <br>

                                <figure id="imgPerfil">

                                    <?php

                                        if($_SESSION["modo"] == "directo"){

                                            if($_SESSION["foto"] != ""){

                                                echo '<img src="'.$url.$_SESSION["foto"].'" class="img-thumbnail">';

                                            }else{

                                                echo '<img src="'.$servidor.'views/img/usuarios/default/anonymous.png" class="img-thumbnail">';

                                            }
                                            
                                        }else{

                                            echo '<img src="'.$_SESSION["foto"].'" class="img-thumbnail">';
                                            
                                        }

                                    ?>

                                </figure>

                                <br>

                                <?php

                                    if($_SESSION["modo"] == "directo"){
                                        echo '<button type="button" class="CambiarFoto backColor" id="btnCambiarFoto">Cambiar Foto de Perfil</button>';
                                    }

                                ?>

                                <div id="subirImagen">
                                    <div class="contFile">
                                        <p>subir imagen</p>
                                        <input type="file" class="btnFile" id="datosImagen" name="datosImagen">
                                    </div>
                                    

                                    <img class="previsualizar" src="" alt="">
                                </div>

                            </div>

                            <div class="col-md-9 col-sm-8 col-12">
                                
                                <br>

                                <?php

                                    echo '<input type="hidden" value="'.$_SESSION["id"].'" id="idUsuario" name="idUsuario">
                                        <input type="hidden" value="'.$_SESSION["password"].'" name="passUsuario">
                                        <input type="hidden" value="'.$_SESSION["foto"].'" id="fotoUsuario" name="fotoUsuario">
                                        <input type="hidden" value="'.$_SESSION["modo"].'" id="modoUsuario" name="modoUsuario">';

                                    if($_SESSION["modo"] != "directo"){

                                        echo '<div class="boxUser">

                                                <label class="control-label text-muted text-uppercase">Nombre:</label>
                                                <div class="input-group contEditar">
                                                    <span>
                                                        <i class="fas fa-user"></i>
                                                    </span>

                                                    <input type="text" class="" id="editarNombre" name="editarNombre" value="'.$_SESSION["nombre"].'" readonly>
                                                </div>
                                                

                                                <br>

                                                <label class="control-label text-muted text-uppercase" for="editarEmail">EMAIL:</label>
                                                <div class="input-group contEditar">
                                                    <span>
                                                        <i class="fas fa-envelope"></i>
                                                    </span>
                                                    <input type="email" class="" id="editarEmail" name="editarEmail" name="editarEmail" value="'.$_SESSION["email"].'" readonly>
                                                </div>

                                                <br>

                                                <label class="control-label text-muted text-uppercase" for="editarPassword">Modo de Registro: </label>
                                                <div class="input-group contEditar">
                                                    <span>
                                                        <i class="fab fa-'.$_SESSION["modo"].'"></i>
                                                    </span>
                                                    <input type="text" class="" value="'.$_SESSION["modo"].'" readonly>
                                                </div>

                                                <br>

                                                <label class="control-label text-muted text-uppercase" for="numeroTelefono">Numero de Telefono: 2222222222</label>
                                                <div class="input-group contEditar">
                                                    <span>
                                                        <i class="fas fa-lock"></i>
                                                    </span>

                                                    <!-- pattern="[+]{1}[0-9]{2} [0-9]{10}"  Este pattern es para el formato de numero: +52 2222222222-->
                                                    
                                                    <input type="tel" pattern="[0-9]{10}" class="" id="numeroTelefono" name="numeroTelefono" value="'.$_SESSION["telefono"].'">
                                                </div>

                                                <br>

                                                <button type="submit" class="backColor userEnviar">Actualizar Datos</button>

                                            </div>';
                                            

                                    }else{

                                        echo '<div class="boxUser">

                                                <label class="control-label text-muted text-uppercase" for="editarNombre">Nombre:</label>
                                                <div class="input-group contEditar">
                                                    <span>
                                                        <i class="fas fa-user"></i>
                                                    </span>
                                                    <input type="text" class="" id="editarNombre" name="editarNombre" value="'.$_SESSION["nombre"].'">
                                                </div>

                                                <br>

                                                <label class="control-label text-muted text-uppercase" for="editarEmail">EMAIL:</label>
                                                <div class="input-group contEditar">
                                                    <span>
                                                        <i class="fas fa-envelope"></i>
                                                    </span>
                                                    <input type="email" class="" id="editarEmail" name="editarEmail" value="'.$_SESSION["email"].'">
                                                </div>

                                                <br>

                                                <label class="control-label text-muted text-uppercase" for="passwordActual">Contraseña Actual:</label>
                                                <div class="input-group contEditar">
                                                    <span>
                                                        <i class="fas fa-lock"></i>
                                                    </span>
                                                    <input type="password" class="" id="passwordActual" name="passwordActual" placeholder="Escribe la Contraseña Actual">
                                                </div>

                                                <br>

                                                <label class="control-label text-muted text-uppercase" for="editarPassword">Contraseña Nueva:</label>
                                                <div class="input-group contEditar">
                                                    <span>
                                                        <i class="fas fa-lock"></i>
                                                    </span>
                                                    <input type="password" class="" id="editarPassword" name="editarPassword" placeholder="Escribe la nueva contraseña">
                                                </div>

                                                <br>

                                                <label class="control-label text-muted text-uppercase" for="numeroTelefono">Numero de Telefono: 2222222222</label>
                                                <div class="input-group contEditar">
                                                    <span>
                                                        <i class="fas fa-lock"></i>
                                                    </span>

                                                    <!-- pattern="[+]{1}[0-9]{2} [0-9]{10}"  Este pattern es para el formato de numero: +52 2222222222-->
                                                    
                                                    <input type="tel" pattern="[0-9]{10}" class="" id="numeroTelefono" name="numeroTelefono" value="'.$_SESSION["telefono"].'">
                                                </div>

                                                <br>

                                                <button type="submit" class="backColor userEnviar">Actualizar Datos</button>

                                            </div>';

                                            

                                    }

                                ?>

                            </div>

                            <?php

                                $actualizarPerfil = new ControladorUsuarios();
                                $actualizarPerfil -> ctrActualizarPerfil();

                            ?>

                        </div>

                    </form>

                    <button class="btnEliminarUsuario" id="eliminarUsuario">Eliminar Cuenta</button>

                    <?php

                        $borrarUsuario = new ControladorUsuarios();
                        $borrarUsuario -> ctrEliminarUsuario();

                    ?>

                </div>
            
            </div>
        </div>

    </div>

</div>


 <!-- ======================================================
    VENTANA MODAL DE COMENTARIOS
====================================================== -->


    <div class="modal fade" id="modalComentarios" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalComentarios" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body modalTitulo">
                    <h3 class="backColor">Calificar este Producto</h3>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    
                        <form method="post" onsubmit="return validarComentario()">

                            <input type="hidden" value="" id="idComentario" name="idComentario">

                            <div class="estrellasCal text-center">

                                <div class="estrellasBody" id="estrellas">

                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>

                                </div>

                                <div class="estrellaslabel">

                                    
                                    <input type="radio" name="puntaje" value="1">
                                
                                    <input type="radio" name="puntaje" value="2">
                                
                                    <input type="radio" name="puntaje" value="3">
                                
                                    <input type="radio" name="puntaje" value="4">
                                
                                    <input type="radio" name="puntaje" value="5" checked>
                                    

                                </div>

                            </div>

                            <div class="comentarioGroup text-center">

                                <label for="comentario" class="text-muted">Tu opinión acerca de este producto: <span><small>(Max 300 caracteres)</small></span></label>
                                <textarea placeholder="Escribe un comentario" class="areaComentario" name="comentario" id="comentario" maxlength="300"></textarea>

                                <input type="submit" class="calificarProductoBtn mt-3 btnIngreso" value="ENVIAR">

                            </div>

                            <?php

                                $actualizarComentario = new ControladorUsuarios();
                                $actualizarComentario -> ctrActualizarComentario();  //Ejecutamos el metodo ctrActualizarComentario sin traer respuesta

                            ?>

                        </form>


                </div>
                
                <div class="modal-footer">
                    
                </div>

            </div>
        </div>
    </div>

