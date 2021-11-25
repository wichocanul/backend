/*======================================================
BUSCADOR
======================================================*/

$("#buscador a").click(function(){

    //Si no hay nada escrito en el buscador se queda en la pagina de inicio

    if($("#buscador input").val() == ""){

        $("#buscador a").attr("href", "");

    }

})


$("#buscador input").change(function(){

    var busqueda = $("#buscador input").val();

    var expresion = /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]*$/;

    if(!expresion.test(busqueda)){

        $("#buscador input").val("");

    }else{

        var evaluarBusqueda = busqueda.replace(/[áéíóúÁÉÍÓÚ ]/g, "_");

        var rutaBuscador = $("#buscador a").attr("href");

        if($("#buscador input").val() != ""){

            //Si hay algo escrito en el buscador entonces te manda al modulo cabezote

            $("#buscador a").attr("href", rutaBuscador+"/"+evaluarBusqueda);

        }

    }

})


/*======================================================
BUSCADOR CON ENTER
======================================================*/

$("#buscador input").focus(function(){

    $(document).keyup(function(event){

        event.preventDefault();

        if(event.keyCode == 13 && $("#buscador input").val() != ""){

            var rutaBuscador = $("#buscador a").attr("href");

            window.location.href = rutaBuscador;

        }

    })

})