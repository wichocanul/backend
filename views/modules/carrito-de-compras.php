<!-- ======================================================
    BREADCRUMB CARRITO DE COMPRAS
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

<!-- ======================================================
    TABLA DE CARRITO DE COMPRAS
====================================================== -->

<div class="container-fluid">

    <div class="container">

        <div class="panel-compras ">

            <!-- ======================================================
                CABECERA CARRITO DE COMPRAS 
            ====================================================== -->
            <div class="cabeceraCarrito">

                <div class="row">

                    <div class="col-md-6 col-sm-7 col-12 text-center">
                        <h3>
                            <small>PRODUCTO</small>
                        </h3>
                    </div>

                    <div class="col-md-2 col-sm-1 col-0 text-center">
                        <h3>
                            <small>PRECIO</small>
                        </h3>
                    </div>

                    <div class="col-sm-2 col-0 text-center">
                        <h3>
                            <small>CANTIDAD</small>
                        </h3>
                    </div>

                    <div class="col-sm-2 col-0 text-center">
                        <h3>
                            <small>SUBTOTAL</small>
                        </h3>
                    </div>

                </div>

            </div>

            <!-- ======================================================
                CUERPO CARRITO DE COMPRAS 
            ====================================================== -->
            <div class="cuerpoCarrito">

           

            </div>

            <!-- ======================================================
                SUMA TOTAL DE PRODUCTOS
            ====================================================== -->
            <div class="sumaCarrito">

                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 sumaCont">

                        <div class="row">

                            <div class="col-6">
                                <h4>TOTAL: </h4>
                            </div>

                            <div class="col-6">
                                <h4 class="sumaTotal">
                                    
                                </h4>
                            </div>

                        </div>

                    </div>

            </div>


            <!-- ======================================================
                BOTON CHECKOUT
            ====================================================== -->
            <div class="cabeceraCheckout sumaCarrito">

                <button class="">REALIZAR PAGO</button>

            </div>



        </div>

    </div>

</div>