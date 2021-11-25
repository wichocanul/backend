/* ==============================
    PLANTILLA
================================ */

var rutaOculta = $("#rutaOculta").val()

// Herramienta Tooltip
var options =
{
    animation : true,
    placement : 'bottom',
};

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl, options)
})








$.ajax({

    url:rutaOculta+"ajax/template.ajax.php",
    success:function(respuesta){

        var colorFondo = JSON.parse(respuesta).colorFondo;
        var colorTexto = JSON.parse(respuesta).colorTexto;
        var barraSuperior = JSON.parse(respuesta).barraSuperior;
        var textoSuperior = JSON.parse(respuesta).textoSuperior;

        $(".backColor, .backColor a").css({"background": colorFondo,
                                            "color": colorTexto})
        
        $(".barraSuperior, .barraSuperior a").css({"background": barraSuperior,
                                                    "color": textoSuperior})
    
    }

})

/* ==============================
    SCROLL UP
================================ */

document.getElementById("button_up").addEventListener("click", scrollUp);

function scrollUp(){
    var currentScroll = document.documentElement.scrollTop;

    if(currentScroll > 0){

        window.scrollTo(0,0);

    }
}

buttonUp = document.getElementById("button_up");

window.onscroll = function(){

    var scroll = document.documentElement.scrollTop;

    if(scroll > 500){
        buttonUp.style.transform = "scale(1)";
    }else{
        buttonUp.style.transform = "scale(0)";
    }
}


/* ==============================
    CUADRICULA O LISTA
================================ */

var btnList = $(".btnList");

for(i=0; i<btnList.length; i++){

    $("#btnGrid"+i).click(function(){

        var numero = $(this).attr("id").substr(-1);

        $(".list"+numero).hide();
        $(".grid"+numero).show();

        $("#btnGrid"+numero).addClass("contbtn2");
        $("#btnList"+numero).removeClass("contbtn2");
    
    })
    
    $("#btnList"+i).click(function(){

        var numero = $(this).attr("id").substr(-1);
    
        $(".grid"+numero).hide();
        $(".list"+numero).show();

        $("#btnList"+numero).addClass("contbtn2");
        $("#btnGrid"+numero).removeClass("contbtn2");
    
    })

}


/* ==============================
    EFECTOS CON SCROLL
================================ */

$(window).scroll(function(){

    var scrollY = window.pageYOffset;

    if(window.matchMedia("(min-width:1024px)").matches){

        if($(".banner").html() != null){

            if($(".banner").html() != null){

                if(scrollY < ($(".banner").offset().top)-130){
                
                    $(".banner img").css({"margin-top": -scrollY/3+"px"});
                    
                }else{
            
                    scrollY = 0;
            
                }
            
            }
        }

    }

})


/* ==============================
    MIGAS DE PAN
================================ */

var pagActiva = $(".pagActiva").html();

if(pagActiva != null){

    var regPagActiva = pagActiva.replace(/-/g, " ");

    $(".pagActiva").html(regPagActiva);

}

/* ==============================
    ENLACES PAGINACION 
================================ */

var url = window.location.href;

var indice = url.split("/");

var pagActual = indice[5];

if(isNaN(pagActual)){//Pregunta si pagina actual No Esta Definida

    $("#item1").addClass("active");

}else{
    
    $("#item"+pagActual).addClass("active");

}