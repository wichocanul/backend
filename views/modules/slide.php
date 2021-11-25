<!-- ================================================
SLIDESHOW
================================================= -->
<div class="container-fluid" id="slide">

    

        <div class="row">
            <!-- ================================================
            DIAPOSITIVAS
            ================================================= -->

            <div id="carouselExampleControl" class="carousel slide" data-bs-ride="carousel">
                

                <div class="carousel-inner">

                    <?php

                        $servidor = Ruta::ctrRutaServidor();

                        $slide = ControladorSlide::ctrMostrarSlide();

                        foreach($slide as $key => $value){

                            // Notificar solamente errores de ejecución Menos Warning
                            //https://www.php.net/manual/es/function.error-reporting.php
                            error_reporting(E_ERROR | E_PARSE);

                            $estiloImgProducto = json_decode($value["estiloImgProducto"], true);
                            $estiloTextoSlide = json_decode($value["estiloTextoSlide"], true);
                            $titulo1 = json_decode($value["titulo1"], true);
                            $titulo2 = json_decode($value["titulo2"], true);
                            $titulo3 = json_decode($value["titulo3"], true);

                            echo '<div class="carousel-item '.$value["activar"].'">
                            
                                    <img src="'.$servidor.$value["imgFondo"].'" class="d-block w-100 fondoSlide">
                                    
                                    <div class="slideOpciones '.$value["tipoSlide"].'">';

                                    if($value["imgProducto"] != ""){

                                        echo '<img class="imgProducto" src="'.$servidor.$value["imgProducto"].'" style="top: '.$estiloImgProducto["top"].';   right: '.$estiloImgProducto["right"].'; width: '.$estiloImgProducto["width"].'; left: '.$estiloImgProducto["left"].';">';
                                    
                                    }
                                            
                                            echo '<div class="textosSlide" style="top: '.$estiloTextoSlide["top"].'; left: '.$estiloTextoSlide["left"].'; width: '.$estiloTextoSlide["width"].'; right: '.$estiloTextoSlide["right"].';">

                                                <h1 style="color: '.$titulo1["color"].';">'.$titulo1["texto"].'</h1>

                                                <h2 style="color: '.$titulo2["color"].';">'.$titulo2["texto"].'</h2>

                                                <h3 style="color: '.$titulo3["color"].';">'.$titulo3["texto"].'</h3>

                                                <a href="'.$value["url"].'">
                                                    '.$value["boton"].'
                                                </a>

                                            </div>

                                        </div>

                                    </div>';
                                    
                        }

                    ?>

                    

                </div>


                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControl" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControl" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Next</span>
                </button>


            </div>
            
            
            
            
            
        </div>
    

</div>