<div class="container-fluid barraProductos">

    <div class="container">

        <div class="row">

            <div class="col-6 organizarProductos">

                <div class="dropdown">

                    <button class="btn-drop dropdown-toggle" type="button" id="dropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                        Ordenar Productos
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdown1">

                        <?php

                            echo '<li><a class="dropdown-item" href="'.$url.$rutas[0].'/1/recientes/'.$rutas[3].'">Más reciente</a></li>
                            <li><a class="dropdown-item" href="'.$url.$rutas[0].'/1/antiguos/'.$rutas[3].'">Más antiguo</a></li>';

                        ?>

                    </ul>

                </div>

            </div>

            <div class="col-6 organizarProductos">

                <div class="btn-group float-end contbtn">

                    <button type="button" class="btnGrid contbtn2" id="btnGrid0">
                        <i class="fas fa-th"></i>
                        <span class="d-none d-md-block d-lg-block float-end">GRID</span>
                    </button>

                    <button type="button" class="btnList" id="btnList0">
                        <i class="fas fa-list"></i>
                        <span class="d-none d-md-block d-lg-block float-end">LIST</span>
                    </button>

                </div>

            </div>

        </div>

    </div>
            
</div>


<!-- ======================================================
LISTAR PRODUCTOS
====================================================== -->

<div class="container-fluid productos">

    <div class="container">

        <div class="row">

            <ul class="breadcrumb fondoBreadcrumb lead">

                <li class="breadcrumb-item"><a href="<?php echo $url; ?>">INICIO</a></li>
                <li class="breadcrumb-item active pagActiva"><?php echo $rutas[0] ?></li>

            </ul>

            <?php
                
                /* ======================================================
                LLAMADO DE PAGINACION
                ====================================================== */
                
                if(isset($rutas[1])){

                    //$_SESSION["ordenar"] = "DESC";
                    //Iniciamos variable de sesion para guardar datos de manera ASC o DESC

                    if(isset($rutas[2])){

                        if($rutas[2] == "antiguos"){

                            $modo = "ASC";
                            $_SESSION["ordenar"] = "ASC";

                        }else{

                            $modo = "DESC";
                            $_SESSION["ordenar"] = "DESC";

                        }

                    }else{

                        $modo = $_SESSION["ordenar"];

                    }

                    $base = ($rutas[1] - 1) * 12; //Cambiar a 12 Operacion matematica para las paginas
                    $tope = 12; //Aqui va 12 de Tope para los productos

                }else{

                    $rutas[1] = 1;
                    $base = 0; 
                    $tope = 12; //Aqui va 12 de Tope para los productos
                    $modo = "DESC";

                }


                /* ======================================================
                LLAMADO DE PRODUCTOS POR BUSQUEDA
                ====================================================== */

                $productos = null;
                $listaProductos = null;

                $ordenar = "id";

                if(isset($rutas[3])){

                    $busqueda = $rutas[3];

                    $productos = ControladorProductos::ctrBuscarProductos($busqueda, $ordenar, $modo, $base, $tope);
                        // Me permite traer cada uno de los items
                    $listaProductos = ControladorProductos::ctrListarProductosBusqueda($busqueda);
                        //Permite configurar la paginacion

                }


                if($productos == false){

                    echo '<div class="col-12 contError text-center">
                            <h1 class="noProductos">¡Oops</h1>
                            <h2 class="subNoProductos">Aún no hay productos en esta sección</h2>
                        </div>';

                }else{

                    echo '<ul class="grid0">
                    
                        <div class="row">';

                            foreach($productos as $key => $value){

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

                    <ul class="list0" style="display:none;">

                        <div class="row">';

                            foreach($productos as $key => $value){

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

                    </ul>';

                }

            ?>

            <div class="clearfix"></div>

            <div class="d-flex w-100 justify-content-center">

            <!-- ======================================================
            PAGINACION
            ====================================================== -->

                <?php

                    if(count($listaProductos) != 0){
                        
                        $pagProductos = ceil(count($listaProductos)/12); #Ceil redondea el numero AL FINAL VA EL /12

                        if($pagProductos > 4){

                            /* ======================================================
                            BOTONES DE LAS PRIMERAS 4 PAG
                            ====================================================== 
                            pagProductos es el numero de mi ultima pagina en entero*/

                            if($rutas[1] == 1){

                                echo '<ul class="pagination">';
                                
                                    for($i = 1; $i <= 4; $i++){

                                        echo '<li class="page-item" id="item'.$i.'"><a class="page-link" href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

                                    }
                                
                                echo '<li class="page-item disabled"><a class="page-link">...</a></li> 

                                        <li class="page-item" id="item'.$pagProductos.'"><a class="page-link" href="'.$url.$rutas[0].'/'.$pagProductos.'/'.$rutas[2].'/'.$rutas[3].'">'.$pagProductos.'</a></li>

                                        <li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'2/'.$rutas[2].'/'.$rutas[3].'">
                                            <i class="fas fa-angle-right"></i>
                                        </a></li>
                                    
                                    </ul>'; 

                                /* ======================================================
                                BOTONES DE LA MITAD DE PAGINAS HACIA ABAJO
                                ====================================================== */
                            
                            }else if ($rutas[1] != $pagProductos && $rutas[1] != 1 && $rutas[1] < ($pagProductos/2) && $rutas[1] < ($pagProductos-3)) {
                                
                                $numPagActual = $rutas[1];

                                echo '<ul class="pagination">
                                
                                        <li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.($numPagActual-1).'/'.$rutas[2].'/'.$rutas[3].'">
                                            <i class="fas fa-angle-left"></i>
                                        </a></li>';
                                
                                    for($i = $numPagActual; $i <= ($numPagActual+3); $i++){

                                        echo '<li class="page-item" id="item'.$i.'"><a class="page-link" href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

                                    }
                                
                                echo '<li class="page-item disabled"><a class="page-link">...</a></li> 

                                        <li class="page-item" id="item'.$pagProductos.'"><a class="page-link" href="'.$url.$rutas[0].'/'.$pagProductos.'/'.$rutas[2].'/'.$rutas[3].'">'.$pagProductos.'</a></li>

                                        <li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.($numPagActual+1).'/'.$rutas[2].'/'.$rutas[3].'">
                                            <i class="fas fa-angle-right"></i>
                                        </a></li>
                                    
                                    </ul>'; 


                                /* ======================================================
                                BOTONES DE LA MITAD DE PAGINAS HACIA ARRIBA
                                ====================================================== */

                            }else if($rutas[1] != $pagProductos && $rutas[1] != 1 && $rutas[1] >= ($pagProductos/2) && $rutas[1] < ($pagProductos-3)){

                                $numPagActual = $rutas[1];
                                
                                echo '<ul class="pagination">
                                
                                        <li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.($numPagActual-1).'/'.$rutas[2].'/'.$rutas[3].'">
                                            <i class="fas fa-angle-left"></i>
                                        </a></li>

                                        <li class="page-item" id="item1"><a class="page-link" href="'.$url.$rutas[0].'/1/'.$rutas[2].'/'.$rutas[3].'">1</a></li>

                                        <li class="page-item disabled"><a class="page-link">...</a></li>
                                    ';
                                
                                    for($i = $numPagActual; $i <= ($numPagActual+3); $i++){

                                        echo '<li class="page-item" id="item'.$i.'"><a class="page-link" href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

                                    }
                                
                                echo ' <li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.($numPagActual+1).'/'.$rutas[2].'/'.$rutas[3].'">
                                            <i class="fas fa-angle-right"></i>
                                        </a></li>                                   
                                    </ul>';


                                /* ======================================================
                                BOTONES DE LAS ULTIMAS 4 PAG
                                ====================================================== */



                            }else{

                                $numPagActual = $rutas[1];

                                echo '<ul class="pagination">
                                
                                        <li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.($numPagActual-1).'/'.$rutas[2].'/'.$rutas[3].'">
                                            <i class="fas fa-angle-left"></i>
                                        </a></li>

                                        <li class="page-item" id="item1"><a class="page-link" href="'.$url.$rutas[0].'/1/'.$rutas[2].'/'.$rutas[3].'">1</a></li>

                                        <li class="page-item disabled"><a class="page-link">...</a></li>
                                    ';
                                
                                    for($i = ($pagProductos-3); $i <= $pagProductos; $i++){

                                        echo '<li class="page-item" id="item'.$i.'"><a class="page-link" href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

                                    }
                                
                                echo '                                    
                                    </ul>'; 
                            
                            }
                            
                            



                        }else{

                            echo '<ul class="pagination">';
                            
                                for($i = 1; $i <= $pagProductos; $i++){

                                    echo '<li class="page-item" id="item'.$i.'"><a class="page-link" href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

                                }
                            
                            echo '</ul>';

                        }

                    }

                ?>
                
                
            </div>

        </div>
        
    </div>

</div>