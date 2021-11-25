<!-- ======================================================
BANNER
====================================================== -->

<?php

    $servidor = Ruta::ctrRutaServidor();

    $ruta = "sin-categoria";

    $banner = ControladorProductos::ctrMostrarBanner($ruta);

    $titulo1 = json_decode($banner["titulo1"],true);
    $titulo2 = json_decode($banner["titulo2"],true);
    $titulo3 = json_decode($banner["titulo3"],true);

    if($banner != null){

        echo '<figure class="banner">

                <img src="'.$servidor.$banner["img"].'" class="img-responsive" width="100%">

                <div class="textoBanner '.$banner["estilo"].'">

                    <h1 style="color:'.$titulo1["color"].'">'.$titulo1["texto"].'</h1>

                    <h2 style="color:'.$titulo2["color"].'"><strong>'.$titulo2["texto"].'</strong></h2>

                    <h3 style="color:'.$titulo3["color"].'">'.$titulo3["texto"].'</h3>

                </div>

            </figure>';
    
    }




    $titulosModulos = array("MEJORES OFERTAS", "LO MÁS VENDIDO", "LO MÁS RECIENTE");
    $rutaModulos = array("mejores-ofertas", "lo-mas-vendido", "lo-mas-reciente");

    $base = 0; 
    $tope = 4;

    if($titulosModulos[0] == "MEJORES OFERTAS"){

        $ordenar = "descuentoOferta";
        $item = null;
        $valor = null;

        $ofertas = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

    }

    if($titulosModulos[1] == "LO MÁS VENDIDO"){

        $ordenar = "ventas";
        $item = null;
        $valor = null;

        $ventas = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

    }

    if($titulosModulos[2] == "LO MÁS RECIENTE"){

        $ordenar = "id";
        $item = null;
        $valor = null;

        $reciente = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

    }

    $modulos = array($ofertas, $ventas, $reciente);

    for($i = 0; $i < count($titulosModulos); $i ++){

        echo '<div class="container-fluid barraProductos">

                <div class="container">
            
                    <div class="row">
            
                        <div class="col-12 organizarProductos">
            
                            <div class="btn-group float-end contbtn">
            
                                <button type="button" class="btnGrid contbtn2" id="btnGrid'.$i.'">
                                    <i class="fas fa-th"></i>
                                    <span class="d-none d-md-block d-lg-block float-end">GRID</span>
                                </button>
            
                                <button type="button" class="btnList" id="btnList'.$i.'">
                                    <i class="fas fa-list"></i>
                                    <span class="d-none d-md-block d-lg-block float-end">LIST</span>
                                </button>
            
                            </div>
            
                        </div>
            
                    </div>
            
                </div>
            
            </div>
            
            <div class="container-fluid productos">

                <div class="container">

                    <div class="row">
                    
                        <!-- BARRA TITULO -->
                        <div class="col-12 tituloDestacado">

                            <div class="row">
                                
                                <div class="col-lg-6 col-md-6 col-12">
                                    
                                    <h1><small>'.$titulosModulos[$i].'</small></h1>

                                </div>

                                <div class="col-lg-6 col-md-6 col-12">

                                    <a href="'.$rutaModulos[$i].'">
                                        <button class="btn btn-default backColor float-end">
                                            VER MAS<span class="fas fa-chevron-right"></span>
                                        </button>
                                    </a>

                                </div>

                            </div>

                        </div>

                        <hr>

                    </div>
                    
                    <!-- ======================================================
                    PRODUCTOS EN BLOQUE
                    ====================================================== -->

                    <ul class="grid'.$i.'">
                    
                        <div class="row">';

                            foreach($modulos[$i] as $key => $value){

                                echo '<li class="col-lg-3 col-sm-6 col-12">

                                        <figure>

                                            <a href="'.$value["ruta"].'">
                                                <img src="'.$servidor.$value["portada"].'" class="img-fluid">
                                            </a>

                                        </figure>

                                        <!-- ================================================================ -->
                                        <h4>
                                            <small>
                                                <a href="'.$value["ruta"].'" class="pixelProducto">
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

                                        <!-- ================================================================ -->
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

                                                        <a href="'.$value["ruta"].'" class="pixelProducto">
                                                        
                                                            <button type="button" class="">
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
                        
                    </ul>

                    <ul class="list'.$i.'" style="display:none;">

                        <div class="row">';

                            foreach($modulos[$i] as $key => $value){

                                echo '<li class="col-12">

                                    <div class="row">

                                        <div class="col-lg-2 col-md-3 col-sm-4 col-12">

                                            <figure>

                                                <a href="'.$value["ruta"].'">
                                                    <img src="'.$servidor.$value["portada"].'" class="img-fluid">
                                                </a>
                                                
                                            </figure>

                                        </div>

                                        <div class="col-lg-10 col-md-9 col-sm-8 col-12">

                                            <h1>

                                                <small>

                                                    <a href="'.$value["ruta"].'" class="pixelProducto">

                                                        '.$value["titulo"].'

                                                        <br>';
                                                        
                                                        if($value["nuevo"] != 0){
                                                            echo '<span class="badge bg-warning text-dark fontSize">Nuevo</span> ';
                                                        }
    
                                                        if($value["oferta"] != 0){
                                                            echo '<span class="badge bg-warning text-dark fontSize">'.$value["descuentoOferta"].'% off</span>';
                                                        }

                                                    echo '</a>

                                                </small>

                                            </h1>

                                            <p class="text-muted">'.$value["titular"].'</p>

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
                                                                        <strong class="oferta">MX $'.$value["precio"]. '</strong>
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

                                                            <button type="button" class="deseos" idProducto="'.$value["id"].'" >
                                                                <i class="far fa-heart" id="EpicButton" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Agregar a lista de deseos"></i>
                                                            </button>

                                                            <a href="'.$value["ruta"].'" class="pixelProducto">
                                                            
                                                                <button type="button" class="">
                                                                    <i class="far fa-eye" id="EpicButton" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ver Producto"></i>
                                                                </button>

                                                            </a>

                                                        </div>

                                                    </div>

                                                </div>
                                                
                                            </div>

                                        </div>

                                    </div>

                                    <div class="listahr">
                                        <hr>
                                    </div>

                                </li>';

                            }

                        echo '</div>

                    </ul>
                    
                </div>

            </div>';

            

    }

?>
