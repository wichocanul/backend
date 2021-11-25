/* ==============================
    CAPTURA DE RUTAS LOCALSTORAGE
================================ */
var rutaActual = location.href;

$(".btnIngreso, .facebook, .google").click(function(){

    localStorage.setItem("rutaActual", rutaActual);

})



/* ==============================
    FORMATEAR IMPUTS
================================ */
$("input").focus(function(){

    $(".warningAlert2").remove();
    $(".warningAlert").remove();

})

$("textarea").focus(function(){

    $(".warningAlert2").remove();

})


/* ==============================
    VALIDAR EMAIL REPETIDO
================================ */

var validarEmailRepetido = false;

$("#regEmail").change(function(){

    var email = $("#regEmail").val();

    var datos = new FormData();
    datos.append("validarEmail", email);

    $.ajax({

        url:rutaOculta+"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success:function(respuesta){

            if(respuesta == "false"){

                $(".warningAlert2").remove();

                validarEmailRepetido = false;

            }else{

                var modo = JSON.parse(respuesta).modo;

                if(modo == "directo"){

                    modo = "esta página";

                }

                $("#regEmail").parent().before('<div class="warningAlert2"><strong>ERROR:</strong>El correo ya existe, fue registrado a través de '+modo+'</div>')

                validarEmailRepetido = true;

            }

        }

    })




})





/* ==============================
    VALIDAR REGISTRO DE USUARIO
================================ */
function registroUsuario(){

    /* ==============================
    VALIDAR NOMBRE USUARIO
    ================================ */
    var nombre = $("#regUsuario").val();

    if(nombre != ""){

        var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;

        if(!expresion.test(nombre)){

            $("#regUsuario").parent().before('<div class="warningAlert2"><strong>ERROR:</strong> No se permiten números ni caracteres especiales</div>')

            return false;

        }

    }else{

        $("#regUsuario").parent().before('<div class="warningAlert2"><strong>ATENCION:</strong> Este campo es Obligatorio</div>')

        return false;

    }
    
    /* ==============================
    VALIDAR EMAIL
    ================================ */
    var email = $("#regEmail").val();

	if(email != ""){

		var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

		if(!expresion.test(email)){

            $("#regEmail").parent().before('<div class="warningAlert2"><strong>ERROR:</strong> Escriba correctamente el correo electronico</div>')

            return false;

        }

        if(validarEmailRepetido){

            $("#regEmail").parent().before('<div class="warningAlert2"><strong>ERROR:</strong>El correo ya existe, por favor ingrese otro diferente</div>')

            return false;

        }

    }else{

        $("#regEmail").parent().before('<div class="warningAlert2"><strong>ATENCION:</strong> Este campo es Obligatorio</div>')

        return false;

    }

    /* ==============================
    VALIDAR CONTRASEÑA          EXPRESIONES REGULARES
    ================================ */
    var password = $("#regPassword").val();

    if(password != ""){

        var expresion = /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]*$/;

        if(!expresion.test(password)){

            $("#regPassword").parent().before('<div class="warningAlert2"><strong>ERROR:</strong> No se permiten caracteres especiales</div>')

            return false;

        }

    }else{

        $("#regPassword").parent().before('<div class="warningAlert2"><strong>ATENCION:</strong> Este campo es Obligatorio</div>')

        return false;

    }


    /* ==============================
    VALIDAR POLITICAS DE PRIVACIDAD
    ================================ */
    var politicas = $("#regPoliticas:checked").val();

    if(politicas != "on"){

        $("#regPoliticas").parent().before('<div class="warningAlert"><strong>ATENCION:</strong> Debe aceptar nuestras politicas de privacidad</div>')

        return false;
    }


    return true;
}


/* ==============================
    CAMBIAR FOTO
================================ */
$("#btnCambiarFoto").click(function(){

    $("#imgPerfil").toggle();
    $("#subirImagen").toggle();

})

$("#datosImagen").change(function(){    //.change ejecuta una function si el id seleccionado cambia

    var imagen = this.files[0];

    if(Number(imagen["size"]) > 8000000){

        $("#datosImagen").val("");

        swal({
            title: "ERROR AL SUBIR LA IMAGEN",
            text: "El tamaño de la imagen debe ser menor a 8MB",
            type: "error",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
        },
        function(isConfirm){
            if(isConfirm){
                window.location = rutaOculta+"perfil";
            }
        });

    }

    if((imagen["type"] == "image/jpeg") || (imagen["type"] == "image/png")){

        var datosImagen = new FileReader;

        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event){

            var rutaImagen = event.target.result;
            $(".previsualizar").attr("src", rutaImagen);

        })

    }else{

        $("#datosImagen").val("");

        swal({
            title: "ERROR AL SUBIR LA IMAGEN",
            text: "La imagen debe estar en un formato JPG ó PNG",
            type: "error",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
        },
        function(isConfirm){
            if(isConfirm){
                window.location = rutaOculta+"perfil";
            }
        });

    }

})

/* ==============================
    COMENTARIOS ID
================================ */
$(".calificarProducto").click(function(){
    
    var idComentario = $(this).attr("idComentario");

    $("#idComentario").val(idComentario);

})

/* ==============================
    COMENTARIOS CAMBIO DE ESTRELLAS
================================ */

$("input[name='puntaje']").change(function(){

    var puntaje = $(this).val();

    switch(puntaje){

        case "1":
            $("#estrellas").html('<i class="fa fa-star"></i> '+
                                    '<i class="fa fa-star-o"></i> '+
                                    '<i class="fa fa-star-o"></i> '+
                                    '<i class="fa fa-star-o"></i> '+
                                    '<i class="fa fa-star-o"></i> ');
        break;

        case "2":
            $("#estrellas").html('<i class="fa fa-star"></i> '+
                                    '<i class="fa fa-star"></i> '+
                                    '<i class="fa fa-star-o"></i> '+
                                    '<i class="fa fa-star-o"></i> '+
                                    '<i class="fa fa-star-o"></i> ');
        break;
        
        case "3":
            $("#estrellas").html('<i class="fa fa-star"></i> '+
                                    '<i class="fa fa-star"></i> '+
                                    '<i class="fa fa-star"></i> '+
                                    '<i class="fa fa-star-o"></i> '+
                                    '<i class="fa fa-star-o"></i> ');
        break;

        case "4":
        $("#estrellas").html('<i class="fa fa-star"></i> '+
                                '<i class="fa fa-star"></i> '+
                                '<i class="fa fa-star"></i> '+
                                '<i class="fa fa-star"></i> '+
                                '<i class="fa fa-star-o"></i> ');
        break;

        case "5":
        $("#estrellas").html('<i class="fa fa-star"></i> '+
                                '<i class="fa fa-star"></i> '+
                                '<i class="fa fa-star"></i> '+
                                '<i class="fa fa-star"></i> '+
                                '<i class="fa fa-star"></i> ');
        break;
        

    }

})


/* ==============================
    VALIDAR COMENTARIO 
================================ */
function validarComentario(){

    var comentario = $("#comentario").val();

    if(comentario != ""){

        var expresion = /^[?\\¿\\¡\\!\\,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]*$/;

        if(!expresion.test(comentario)){

            $("#comentario").parent().before('<div class="warningAlert2"><strong>ERROR:</strong> No se permiten caracteres especiales</div>');

            return false;

        }

    }

    return true;

}


/* ==============================
    LISTA DE DESEOS
================================ */
$(".deseos").click(function(){

    var idProducto = $(this).attr("idProducto");
    var idUsuario = localStorage.getItem("usuario");

    console.log(idProducto, idUsuario);

    if(idUsuario == null){

        swal({
            title: "Debe ingresar al sistema",
            text: "Para agregar un producto a la lista de deseos debe ingresar al sistema",
            type: "warning",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
        });

    }else{

        $(this).addClass("bg-danger");

        var datos = new FormData();
        datos.append("idUsuario", idUsuario);
        datos.append("idProducto", idProducto);

        $.ajax({

            url:rutaOculta+"ajax/usuarios.ajax.php",
            method:"POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta){

            }

        })

    }

})


/* ==============================
    BORRAR PRODUCTO DE LISTA DE DESEOS
================================ */
$(".quitarDeseo").click(function(){

    var idDeseo = $(this).attr("idDeseo");

    
    $(this).parent().parent().parent().parent().parent().parent().parent().remove();

    var datos = new FormData();
    datos.append("idDeseo", idDeseo);

    $.ajax({
        url:rutaOculta+"ajax/usuarios.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta){
            console.log(respuesta);
        }
    });

})


/* ==============================
    BORRAR CUENTA USUARIO
================================ */
$("#eliminarUsuario").click(function(){

    var id = $("#idUsuario").val();

    if($("#modoUsuario").val() == "directo"){

        if($("#fotoUsuario").val() != ""){

            var foto = $("#fotoUsuario").val();

        }

    }

    swal({
        title: "¿ESTAS SEGURO DE ELIMINAR TU CUENTA?",
        text: "Si borras la cuenta ya no se podran recuperar los datos",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, borrar cuenta",
        closeOnConfirm: false
    },
    function(isConfirm){

        if(isConfirm){
            window.location = "index.php?ruta=perfil&id="+id+"&foto"+foto;
        }
    
    });

})