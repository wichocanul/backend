/*======================================================
CARRUSEL
======================================================*/

$(".flexslider").flexslider({
    animation: "slide",
    controlNav: true,
    animationLoop: false,
    slideshow: false,
    itemWidth: 100,
    itemMargin: 5,
});

$(".flexslider ul li img").click(function(){

    var capturaIndice = $(this).attr("value");

    $(".infoproducto figure.visor img").hide();

    $("#lupa"+capturaIndice).show();

})

/*======================================================
EFECTO LUPA
======================================================*/

$(".infoproducto figure.visor img").mouseover(function(){

    var capturaImg = $(this).attr("src");

    $(".lupa img").attr("src", capturaImg);

    $(".lupa").fadeIn("fast");

    $(".lupa").css({
        "height":$(".visorImg").height()+"px",
        "background":"#fff",
        "width":"100%"
    })

})

$(".infoproducto figure.visor img").mouseout(function(){

    $(".lupa").fadeOut("fast");

})

$(".infoproducto figure.visor img").mousemove(function(){

    var posX = event.offsetX;
    var posY = event.offsetY;
    
    $(".lupa img").css({
        "margin-left":-posX+"px",
        "margin-top":-posY+"px"
    })

})


/*======================================================
CONTADOR DE VISTAS
======================================================*/

let contador = 0;

$(window).on("load", function(){

    let vistas = $("span.vistas").html();
    // let precio = $("span.vistas").attr("tipo");

    contador = Number(vistas) + 1;

    $("span.vistas").html(contador);

    
    //DEFINIMOS PRECIO

    let item = "vistas";

    // if(precio == 0){

    //     var item = "vistas";

    // }else{

    //     var item = "vistas";

    // }

    //EVALUAMOS RUTA PARA DEFINIR EL PRODUCTO A ACTUALIZAR

    let urlActual = location.pathname;

    let ruta = urlActual.split("/");

    let datos = new FormData();

    datos.append("valor", contador);
    datos.append("item", item);
    datos.append("ruta", ruta.pop());

    $.ajax({

        url:rutaOculta+"ajax/producto.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){

        }

    });

})

/*======================================================
ALTURA COMENTARIOS
======================================================*/

$(".comentarios").css({"height":$(".comentarios .alturaComentarios").height()+"px",
                        "overflow":"hidden"})

$("#verMasComentarios").click(function(e){

    e.preventDefault();

    if($("#verMasComentarios").html() == "Ver Más..."){

        $(".comentarios").css({"height":"auto"});

        $("#verMasComentarios").html("Ver Menos...");

    }else{

        $(".comentarios").css({"height":$(".comentarios .alturaComentarios").height()+"px",
                                "overflow":"hidden"})

        $("#verMasComentarios").html("Ver Más...");

    }

})