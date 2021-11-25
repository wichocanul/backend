<!-- ================================================
ERROR 404 
================================================= -->
<?php
    $social = ControladorPlantilla::ctrEstiloTemplate(); 
    
    $servidor = Ruta::ctrRutaServidor();
?>


<div class="container">

    <div class="row contError">

        <div class="col-12 col-md-7 text-md-center text-center textError">
            <h1>Ooooops!</h1>
            <h4>La pagina no esta disponible</h4>
        </div>

        <div class="col-12 col-md-5">
        <img src="<?php echo $servidor.$social["error404"]; ?>" alt="">
        </div>

    </div>

</div>