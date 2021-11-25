<?php

    $servidor = Ruta::ctrRutaServidor();
    $url = Ruta::ctrRuta();

?>

<!-- ======================================================
BREADCRUMB INFOPRODUCTOS
======================================================-->

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


<!-- ======================================================
INFOPRODUCTO
======================================================-->

<div class="container-fluid infoproducto">

    <div class="container">

        <div class="row">

            <?php
                
                $item = "ruta"; 
                $valor = $rutas[0];

                $infoproducto = ControladorProductos::crtMostrarInfoProducto($item, $valor);

                $multimedia = json_decode($infoproducto["multimedia"], true);

            

            /*-- ======================================================
            VISOR DE PRODUCTOS
            ======================================================-*/

            if(isset($multimedia)){

            echo '<div class="col-md-5 col-sm-6 col-12 visorImg">

                    <figure class="visor">';

                        for($i = 0; $i < count($multimedia); $i++){

                            echo '<img id="lupa'.($i+1).'" class="img-thumbnail" src="'.$servidor.$multimedia[$i]["foto"].'" alt="">';

                        }

                    echo ' </figure>

                    <div class="flexslider carousel">

                        <ul class="slides">';

                        for($i = 0; $i < count($multimedia); $i++){

                            echo '<li>
                                    <img value="'.($i+1).'" class="img-thumbnail" src="'.$servidor.$multimedia[$i]["foto"].'" alt="'.$infoproducto["titulo"].'">
                                </li>';

                        }

                        echo '</ul>

                    </div>

                </div>';
            
            }else{

                /*-- ======================================================
                SI NO HAY PRODUCTOS CARGAR IMAGEN DE TENNIS VERDES POR UNA DONDE EXPLIQUE QUE NO HAY PRODUCTOS
                ======================================================-*/

                echo '<div class="col-md-5 col-sm-6 col-12 visorImg">

                    <figure class="visor">
                    
                        <img id="lupa1" class="img-thumbnail" src="http://localhost/backend/views/img/multimedia/no-producto/no_photo.gif" alt="">

                    </figure>

                    <!-- QUITAR COMENTARIO PARA VER LA IMAGEN PEQUEÑA
                    <div class="flexslider carousel">

                        <ul class="slides">

                            <li>
                                <img value="1" class="img-thumbnail" src="http://localhost/backend/views/img/multimedia/tennis-verde/img-01.jpg" alt="Nothing">
                            </li>

                        </ul>

                    </div> -->

                </div>';

            }

            ?>

            <!-- ======================================================
            PRODUCTO
            ======================================================-->
            <div class="col-md-7 col-sm-6 col-12 producto">
                

                <div class="row">

                    <!-- ======================================================
                    REGRESAR A LA TIENDA
                    ======================================================-->

                    <div class="col-7 col-sm-6 btnContinua">

                        <h6>
                            <a href="javascript:history.back()" class="text-muted">

                                <i class="fa fa-reply"></i> Continuar Comprando

                            </a>
                        </h6>

                    </div>

                    <!-- ======================================================
                    COMPARTIR EN REDES SOCIALES
                    ======================================================-->

                    <div class="col-5 col-sm-6 btnContinua">

                        <h6>

                            <a class="dropdown-toggle float-end text-muted" id="dropdownCompartirRedesSociales" data-bs-toggle="dropdown" href="#">

                                <i class="fa fa-plus"></i> Compartir

                            </a>

                            <ul class="dropdown-menu float-end compartirRedes" id="dropdownCompartirRedesSociales">

                                <li>
                                    <p class="btnFacebook">
                                        <i class="fa fa-facebook"></i>
                                        Facebook
                                    </p>
                                </li>

                                <li>
                                    <p class="btnInstagram">
                                        <i class="fa fa-instagram"></i>
                                        Instagram
                                    </p>
                                </li>

                            </ul>

                        </h6>

                    </div>

                </div>

                <div class="clearfix"></div>

                <!-- ======================================================
                ESPACIO PARA EL PRODUCTO
                ======================================================-->

                <?php

                    /* ======================================================
                    TITULO
                    ====================================================== */

                    echo '<h1 class="infoPTitulo text-uppercase">'.$infoproducto["titulo"].'</h1>';
                    
                    if($infoproducto["oferta"] == 0){ 
                        
                        if($infoproducto["nuevo"] == 0){

                        }else{

                            echo '<h3>
                                <small>

                                    <span class="badge bg-warning text-dark">NUEVO</span>

                                </small>
                            </h3>';

                        }

                    }else{

                        if($infoproducto["nuevo"] == 0){

                            echo '<h3>
                                    <small>

                                        <span class="badge bg-warning text-dark">'.$infoproducto["descuentoOferta"].'% OFF</span>

                                    </small>
                                </h3>';
                        
                        }else{

                            echo '<h3>
                                    <small>

                                        <span class="badge bg-warning text-dark">NUEVO</span>
                                        <span class="badge bg-warning text-dark">'.$infoproducto["descuentoOferta"].'% OFF</span> 

                                    </small>
                                </h3>';

                        }

                    }

                    /* ======================================================
                    PRECIO
                    ====================================================== */
                    if($infoproducto["oferta"] == 0){ 
                        
                        echo '<h3 class="infoPPrecio">MX $'.$infoproducto["precio"].'</h3>';

                    }else{

                        echo '<h3 class="infoPPrecio">

                                <span>
                                    <strong class="oferta">MX $'.$infoproducto["precio"].'</strong>
                                </span>
                            
                                <span>
                                    $'.$infoproducto["precioOferta"].'
                                </span>
                            
                            </h3>';

                    }

                    /* ======================================================
                    DESCRIPCION
                    ====================================================== */
                    echo '<p class="infoDesc">'.$infoproducto["descripcion"].'</p>
                    
                    <div class="mt-4"></div>';

                ?>

                <!-- ======================================================
                CARACTERISTICAS DEL PRODUCTO
                ======================================================-->

                <div class="form-group row d-flex align-items-center">

                    <?php

                        if($infoproducto["detalles"] != null){

                            $detalles = json_decode($infoproducto["detalles"], true);
                            $dimensiones = json_decode($infoproducto["dimensiones"], true);

                            if($detalles["Talla"] != null){

                                echo '<div class="col-lg-3 col-md-5 col-sm-6 col-12">
                                
                                        <select class="btnDetalles seleccionarDetalle" id="seleccionarTalla">

                                            <option value="">Talla</option>';

                                            for($i = 0; $i < count($detalles["Talla"]); $i++){

                                                echo '<option value="'.$detalles["Talla"][$i].'">'.$detalles["Talla"][$i].'</option>';

                                            }

                                        echo '</select>

                                    </div>';

                            }


                            if($detalles["Color"] != null){

                                echo '<div class="col-lg-3 col-md-5 col-sm-6 col-12">
                                
                                        <select class="btnDetalles seleccionarDetalleC" id="seleccionarColor">

                                            <option value="">Color</option>';

                                            for($i = 0; $i < count($detalles["Color"]); $i++){

                                                echo '<option value="'.$detalles["Color"][$i].'">'.$detalles["Color"][$i].'</option>';

                                            }

                                        echo '</select>

                                    </div>';

                            }

                            if($detalles["Marca"] != null){

                                echo '<div class="col-lg-3 col-md-12 col-sm-12 col-12 marca d-flex justify-content-center justify-content-md-start">
                                        <h3>
                                            <small>';

                                                for($i = 0; $i < count($detalles["Marca"]); $i++){
                                                    echo '<p><span class="badge bg-light text-dark"> '.$detalles["Marca"][$i].'</span></p>';
                                                }

                                            echo '</small>
                                        </h3>
                                    </div>';

                            }

                        }

                    ?>

                </div>

                <!-- ======================================================
                BOTONES DE COMPRA
                ======================================================-->
                
                <div class="row">

                    <div class="botonCompra">

                        <div class="row">

                        <div class="col-md-6 col-12 ">

                            <button class="compra">
                                <i class="fas fa-shopping-bag"></i>
                                <p>COMPRAR AHORA</p>
                            </button>

                        </div>

                        <div class="col-md-6 col-12">

                            <?php

                                if($infoproducto["precioOferta"]){

                                    echo '<button class="compra agregarCarrito" idProducto="'.$infoproducto["id"].'" imagen="'.$servidor.$infoproducto["portada"].'" titulo="'.$infoproducto["titulo"].'" precio="'.$infoproducto["precioOferta"].'" tipo="'.$infoproducto["tipo"].'" peso="'.$infoproducto["peso"].'" ruta="'.$infoproducto["ruta"].'">
                                        <i class="fa fa-shopping-cart"></i> 
                                        <p>AGREGAR AL CARRITO</p>
                                    </button>';

                                }else{

                                    echo '<button class="compra agregarCarrito" idProducto="'.$infoproducto["id"].'" imagen="'.$servidor.$infoproducto["portada"].'" titulo="'.$infoproducto["titulo"].'" precio="'.$infoproducto["precio"].'" tipo="'.$infoproducto["tipo"].'" peso="'.$infoproducto["peso"].'" ruta="'.$infoproducto["ruta"].'">
                                        <i class="fa fa-shopping-cart"></i> 
                                        <p>AGREGAR AL CARRITO</p>
                                    </button>';

                                }

                            ?>

                        </div>

                        </div>

                    </div>
                
                </div>


                <div class="row">
                
                    <?php

                        /* ======================================================
                        ENTREGA
                        ====================================================== */

                        if($infoproducto["entrega"] > 0){
                            echo '<div class="col-12 secEntrega">


                                <span class="badge bg-secondary" style="font-weight:100">
                                    <i class="fa fa-clock-o" style="margin-right:5px"></i>
                                    '.$infoproducto["entrega"].' días habiles para la entrega
                                </span>  
                                <span class="badge bg-secondary" style="font-weight:100">
                                    <i class="fa fa-shopping-cart" style="margin-right:5px"></i>
                                    '.$infoproducto["ventas"].' ventas
                                </span>
                                <span class="badge bg-secondary" style="font-weight:100">
                                    <i class="fa fa-eye" style="margin-right:5px"></i>
                                    visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].'</span> personas
                                </span>

                            </div>';
                        }

                    ?>

                </div>

                

                <!-- ======================================================
                ZONA DE LUPA
                ======================================================-->
                <div class="row">

                    <figure class="lupa">

                        <img src="" alt="">

                    </figure>
                
                </div>

            </div>

        </div>


        <!-- ======================================================
        TABLA DE DIMENSIONES
        ======================================================-->

        <div class="row">

            <!-- <div class="col-md-5 col-12"></div> -->

            <div class="col-md-12 col-12 text-center">

                <?php

                    /* ======================================================
                    CALZADO
                    ====================================================== */
                    if($infoproducto["tipo"] == "calzado" || $infoproducto["tipo"] == "accesorio"){

                        echo '';
                        


                        /* ======================================================
                        FALDA/JEANS
                        ====================================================== */

                    }else if($infoproducto["tipo"] == "falda/jeans"){
                        
                        echo '<div class="table-responsive">
                                
                                <table class="table">

                                    <thead>
                                    
                                        <tr>
                                            <th scope="col">Talla</th>
                                            <th scope="col">Cintura</th>
                                            <th scope="col">Cadera</th>
                                            <th scope="col">Largo</th>
                                        </tr>

                                    </thead>

                                    <tbody>';
                                            
                                        for($i = 0; $i < count($detalles["Talla"]); $i++){

                                            echo '<tr>
                                                    <th scope="row" value="'.$detalles["Talla"][$i].'">'.$detalles["Talla"][$i].'</th>
                                                    <th scope="row" value="'.$dimensiones["Cintura"][$i].'">'.$dimensiones["Cintura"][$i].'</th>
                                                    <th scope="row" value="'.$dimensiones["Cadera"][$i].'">'.$dimensiones["Cadera"][$i].'</th>
                                                    <th scope="row" value="'.$dimensiones["Largo"][$i].'">'.$dimensiones["Largo"][$i].'</th>
                                                <tr>';

                                        }                            
                                    
                                    echo '</tbody>
                        
                                </table>
                            
                            </div>';

                        /* ======================================================
                        CAMISA/SUDADERA
                        ====================================================== */

                    }else if($infoproducto["tipo"] == "camisa/sudadera"){
                        
                        echo '<div class="table-responsive">

                                <table class="table">

                                    <thead>
                                    
                                        <tr>
                                            <th scope="col">Talla</th>
                                            <th scope="col">Hombro</th>
                                            <th scope="col">Pecho</th>
                                            <th scope="col">Largo</th>
                                            <th scope="col">Manga</th>
                                        </tr>

                                    </thead>

                                    <tbody>';
                                            
                                        for($i = 0; $i < count($detalles["Talla"]); $i++){

                                            echo '<tr>
                                                    <th scope="row" value="'.$detalles["Talla"][$i].'">'.$detalles["Talla"][$i].'</th>
                                                    <th scope="row" value="'.$dimensiones["Hombro"][$i].'">'.$dimensiones["Hombro"][$i].'</th>
                                                    <th scope="row" value="'.$dimensiones["Pecho"][$i].'">'.$dimensiones["Pecho"][$i].'</th>
                                                    <th scope="row" value="'.$dimensiones["Largo"][$i].'">'.$dimensiones["Largo"][$i].'</th>
                                                    <th scope="row" value="'.$dimensiones["Manga"][$i].'">'.$dimensiones["Manga"][$i].'</th>
                                                <tr>';

                                        }                            
                                    
                                    echo '</tbody>
                        
                                </table>

                            </div>';

                        /* ======================================================
                        VESTIDO CON MANGAS
                        ====================================================== */
                    }else if($infoproducto["tipo"] == "vestido con mangas"){
                        
                        echo '<div class="table-responsive">

                                <table class="table">

                                    <thead>
                                    
                                        <tr>
                                            <th scope="col">Talla</th>
                                            <th scope="col">Hombro</th>
                                            <th scope="col">Pecho</th>
                                            <th scope="col">Cintura</th>
                                            <th scope="col">Cadera</th>
                                            <th scope="col">Largo Manga</th>
                                            <th scope="col">Largo</th>
                                        </tr>

                                    </thead>

                                    <tbody>';
                                            
                                        for($i = 0; $i < count($detalles["Talla"]); $i++){

                                            echo '<tr>
                                                    <th scope="row" value="'.$detalles["Talla"][$i].'">'.$detalles["Talla"][$i].'</th>
                                                    <th scope="row" value="'.$dimensiones["Hombro"][$i].'">'.$dimensiones["Hombro"][$i].'</th>
                                                    <th scope="row" value="'.$dimensiones["Pecho"][$i].'">'.$dimensiones["Pecho"][$i].'</th>
                                                    <th scope="row" value="'.$dimensiones["Cintura"][$i].'">'.$dimensiones["Cintura"][$i].'</th>
                                                    <th scope="row" value="'.$dimensiones["Cadera"][$i].'">'.$dimensiones["Cadera"][$i].'</th>
                                                    <th scope="row" value="'.$dimensiones["LargoManga"][$i].'">'.$dimensiones["LargoManga"][$i].'</th>
                                                    <th scope="row" value="'.$dimensiones["Largo"][$i].'">'.$dimensiones["Largo"][$i].'</th>
                                                <tr>';

                                        }                            
                                    
                                    echo '</tbody>
                        
                                </table>
                            
                            </div>';


                        /* ======================================================
                        VESTIDO SIN MANGAS
                        ====================================================== */
                    
                    }else if($infoproducto["tipo"] == "vestido sin mangas"){
                        
                        echo '<table class="table">

                                <thead>
                                
                                    <tr>
                                        <th scope="col">Talla</th>
                                        <th scope="col">Pecho</th>
                                        <th scope="col">Cintura</th>
                                        <th scope="col">Cadera</th>
                                        <th scope="col">Largo</th>
                                    </tr>

                                </thead>

                                <tbody>';
                                        
                                    for($i = 0; $i < count($detalles["Talla"]); $i++){

                                        echo '<tr>
                                                <th scope="row" value="'.$detalles["Talla"][$i].'">'.$detalles["Talla"][$i].'</th>
                                                <th scope="row" value="'.$dimensiones["Pecho"][$i].'">'.$dimensiones["Pecho"][$i].'</th>
                                                <th scope="row" value="'.$dimensiones["Cintura"][$i].'">'.$dimensiones["Cintura"][$i].'</th>
                                                <th scope="row" value="'.$dimensiones["Cadera"][$i].'">'.$dimensiones["Cadera"][$i].'</th>
                                                <th scope="row" value="'.$dimensiones["Largo"][$i].'">'.$dimensiones["Largo"][$i].'</th>
                                            <tr>';

                                    }                            
                                
                                echo '</tbody>
                        
                            </table>';
                    }

                ?>

            </div>

        </div>



        <!-- ======================================================
        COMENTARIOS
        ======================================================-->
        <div class="row">

            <?php

                $datos = array("idUsuario"=>"",
                                "idProducto"=>$infoproducto["id"]); 

                $comentarios = ControladorUsuarios::ctrMostrarComentariosProducto($datos);

                $cantidad = 0;
                $caliCantidad = 0;

                foreach($comentarios as $key => $value){

                    if($value["comentario"] != ""){

                        $cantidad += count((array)$value["id"]);

                    }

                    if($value["calificacion"] != ""){
                        $caliCantidad += count((array)$value["id"]);
                    }

                }

            ?>

            <div class="comentBox col-12">

                <ul class="nav nav-tabs">

                    <?php

                        $cantidadCalificacion = 0;

                        if($caliCantidad != 0 && $cantidad == 0){                      
                                
                            echo '<div class="col-6 d-flex">

                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="#">Este producto aun no tiene comentarios</a>
                                    </li>

                                    <li></li>
                                    
                                </div>';

                            $sumaCalificacion = 0;

                            foreach($comentarios as $key => $value){

                                if($value["calificacion"] != 0){

                                    $cantidadCalificacion += count((array)$value["id"]);
                                    $sumaCalificacion += $value["calificacion"];

                                }

                            }

                            if($sumaCalificacion == 0 || $cantidadCalificacion == 0){

                                $promedio = 5;

                            }else{

                                $promedio = round($sumaCalificacion/$cantidadCalificacion,1);

                            }

                            echo '<li class="nav-item caliBox col-6">
                                    <a class="nav-link disabled float-end" href="">CALIFICACIÓN: '.$promedio.' ';

                                if($promedio >= 0 && $promedio <= 0.5){

                                    echo '<i class="fa fa-star-half-alt"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>';

                                }else if($promedio > 0.5 && $promedio <= 1){

                                    echo '<i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>';

                                }else if($promedio > 1 && $promedio <= 1.5){

                                    echo '<i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-alt"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>';

                                }else if($promedio > 1.5 && $promedio <= 2){

                                    echo '<i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>';

                                }else if($promedio > 2 && $promedio <= 2.5){

                                    echo '<i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-alt"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>';

                                }else if($promedio > 2.5 && $promedio <= 3){

                                    echo '<i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>';

                                }else if($promedio > 3 && $promedio <= 3.5){

                                    echo '<i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-alt"></i>
                                    <i class="fa fa-star-o"></i>';

                                }else if($promedio > 3.5 && $promedio <= 4){

                                    echo '<i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>';

                                }else if($promedio > 4 && $promedio <= 4.5){

                                    echo '<i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-alt"></i>';

                                }else{

                                    echo '<i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>';

                                }
                                    
                            echo '</a>
                                </li>';


                        }else if($cantidad == 0){
                        
                            echo '<div class="col-6 d-flex">

                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">Este producto no tiene comentarios</a>
                                </li>

                                <li></li>
                                
                            </div>
                            
                            <li class="nav-item caliBox col-6">
                                <a class="nav-link disabled float-end" href="">CALIFICACIÓN: 5
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </a>
                            </li>';

                        }else{

                            echo '<div class="col-6 d-flex">

                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="#">Comentarios '.$cantidad.'</a>
                                    </li>
                                    
                                    
                                    <li class="nav-item ">
                                        <a class="nav-link" id="verMasComentarios" href="#">Ver Más...</a>
                                    </li>
                                    
                            </div>';

                            $sumaCalificacion = 0;

                            foreach($comentarios as $key => $value){

                                if($value["calificacion"] != 0){

                                    $cantidadCalificacion += count((array)$value["id"]);
                                    $sumaCalificacion += $value["calificacion"];

                                }

                            }

                            $promedio = round($sumaCalificacion/$cantidadCalificacion,1);

                            echo '<li class="nav-item caliBox col-6">
                                    <a class="nav-link disabled float-end" href=""> CALIFICACIÓN:   '.$promedio.' ';
                                    //<a class="nav-link disabled float-end" href="">'.$caliCantidad.' CALIFICACIÓNES:   '.$promedio.' ';

                                if($promedio >= 0 && $promedio <= 0.5){

                                    echo '<i class="fa fa-star-half-alt"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>';

                                }else if($promedio > 0.5 && $promedio <= 1){

                                    echo '<i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>';

                                }else if($promedio > 1 && $promedio <= 1.5){

                                    echo '<i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-alt"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>';

                                }else if($promedio > 1.5 && $promedio <= 2){

                                    echo '<i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>';

                                }else if($promedio > 2 && $promedio <= 2.5){

                                    echo '<i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-alt"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>';

                                }else if($promedio > 2.5 && $promedio <= 3){

                                    echo '<i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>';

                                }else if($promedio > 3 && $promedio <= 3.5){

                                    echo '<i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-alt"></i>
                                    <i class="fa fa-star-o"></i>';

                                }else if($promedio > 3.5 && $promedio <= 4){

                                    echo '<i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>';

                                }else if($promedio > 4 && $promedio <= 4.5){

                                    echo '<i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-alt"></i>';

                                }else{

                                    echo '<i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>';

                                }
                                    
                            echo '</a>
                                </li>';

                        }

                    ?>

                    

                </ul>

            </div>

        </div>

        <br>

        <div class="row">

            <div class="comentarios">

                <div class="row">

                    <?php

                        foreach($comentarios as $key => $value){
                        
                            if($value["comentario"] != ""){

                                $item = "id";
                                $valor = $value["id_usuario"];

                                $usuario = ControladorUsuarios::ctrMostrarUsuario($item, $valor);

                                echo '<div class="col-xl-3 col-lg-4 col-sm-6 col-12 alturaComentarios">

                                    <div class="GrupoComent">
            
                                        <div class="namePhoto">
                                            <div class="contima">';

                                                if($usuario["modo"] == "directo"){

                                                    if($usuario["foto"] == ""){

                                                        echo '<img src="'.$servidor.'views/img/usuarios/default/anonymous.png" alt="">';

                                                    }else{

                                                        echo '<img src="'.$url.$usuario["foto"].'" alt="">';

                                                    }

                                                }else{

                                                    echo '<img src="'.$usuario["foto"].'" alt="">';

                                                }
                                                
                                            echo '</div>
                                            <p>'.$usuario["nombre"].'</p>
                                        </div>
            
                                        <div class="comentPersonal">
                                            <p>'.$value["comentario"].'</p>
                                        </div>
            
                                        <div class="caliPersonal">';

                                            switch($value["calificacion"]){

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
                                                
                                        echo '</div>
            
                                    </div>
            
                                </div>';

                                

                            }

                        }

                    ?>
 
                    
                    

                </div>


            </div>

        </div>

        <hr>


    </div>

</div>


<!-- ======================================================
ARTICULOS RELACIONADOS
======================================================-->

<div class="container-fluid productos">

    <div class="container">

        <div class="row">
        
            <!-- BARRA TITULO -->
            <div class="col-12 tituloDestacado">

                <div class="row">
                    
                    <div class="col-lg-6 col-md-6 col-12">
                        
                        <h1><small>PRODUCTOS RELACIONADOS</small></h1>

                    </div>

                    <div class="col-lg-6 col-md-6 col-12">

                    <?php

                        $item = "id";
                        $valor = $infoproducto["id_subcategoria"]; //id_categoria

                        $rutaArticulosDestacados = ControladorProductos::ctrMostrarSubCategorias($item, $valor); //ctrMostrarCategorias

                        echo '<a href="'.$url.$rutaArticulosDestacados[0]["ruta"].'">  <!-- $rutaArticulosDestacados["ruta"] -->
                                <button class="btn btn-default backColor float-end">
                                    VER MAS<span class="fas fa-chevron-right"></span>
                                </button>
                            </a>';

                    ?>

                        

                    </div>

                </div>

                <hr class="hrrelacionados">

            </div>

        </div>
        
        <!-- ======================================================
        PRODUCTOS EN BLOQUE
        ====================================================== -->

        <?php

            $ordenar = ""; 
            $item = "id_subcategoria";
            $valor = $infoproducto["id_subcategoria"];
            $base = 0;
            $tope = 4;
            $modo = "Rand()";

            $productosRelacionados = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

            if(!$productosRelacionados){ //SI la variable viene falso o sin informacion

                echo '<div class="col-12 textError">

                    <h1><small>Opps!!!</small></h1>

                    <h4>No hay productos relacionados</h4>

                </div>';

            }else{

                echo '<ul class="grid0">

                    <div class="row">';

                        foreach($productosRelacionados as $key => $value){

                            echo '<li class="col-lg-3 col-sm-6 col-12">

                                    <figure>

                                        <a href="'.$url.$value["ruta"].'">
                                            <img src="'.$servidor.$value["portada"].'" class="img-fluid">
                                        </a>

                                    </figure>

                                    
                                    <h4>
                                        <small>
                                            <a href="'.$url.$value["ruta"].'" class="pixelProducto">
                                                '.$value["titulo"].'
                                                <br>
                                                <span style="color:rgba(0,0,0,0); margin-left:-5px">-</span>';
                                                
                                                if($value["nuevo"] != 0){
                                                    echo '<span class="badge bg-warning text-dark fontSize">Nuevo</span> ';
                                                }

                                                if($value["oferta"] != 0){
                                                    echo '<span class="badge bg-warning text-dark fontSize">'.$value["descuentoOferta"].'% off</span>';
                                                }

                                            echo '</a>
                                        </small>
                                    </h4>

                                    
                                    <div class="container">

                                        <div class="row">
                                            
                                            <div class="col-8 precio">';

                                                if($value["precio"] == 0){

                                                    echo' <h2>
                                                        <small class="normal">GRATIS</small>
                                                    </h2>';

                                                }else{

                                                    if($value["oferta"] != 0){

                                                        echo' <small>
                                                                <strong class="oferta">MX $'.$value["precio"].'</strong>
                                                            </small>
                        
                                                            <small class="normal">$'.$value["precioOferta"].'</small>';

                                                    }else{

                                                        echo '<h2>
                                                                <small class="normal">$'.$value["precio"].'</small>
                                                            </h2>';

                                                    }

                                                }
                                                
                                            echo '</div>

                                            <div class="col-4 enlaces">

                                                <div class="btn-group float-end">

                                                    <button type="button" class="deseos" idProducto="'.$value["id"].'">
                                                    <i class="far fa-heart" id="EpicButton" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Agregar a lista de deseos"></i>
                                                    </button>

                                                    <a href="'.$url.$value["ruta"].'" class="pixelProducto">
                                                    
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

        ?>
            
        

    </div>

</div>