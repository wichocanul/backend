/* ==============================
/* ==============================
/* ==============================
/* ==============================
    VISUALIZAR CESTA DEL CARRITO
================================ */
if(localStorage.getItem("cantidadCesta") != null){

    $(".cantidadCesta").html(localStorage.getItem("cantidadCesta"));
    $(".sumaCesta").html(localStorage.getItem("sumaCesta"));

}else{

    $(".cantidadCesta").html("0");
    $(".sumaCesta").html("0");

}



/* ==============================
/* ==============================
/* ==============================
/* ==============================
    VISUALIZAR LOS PRODUCTOS EN LA PAGINA CARRITO DE COMPRAS
================================ */

if(localStorage.getItem("listaProductos") != null){

    var listaCarrito = JSON.parse(localStorage.getItem("listaProductos"));

    listaCarrito.forEach(funcionForEach);

    function funcionForEach(item, index){

        $(".cuerpoCarrito").append(

            '<div class="row itemCarrito">'+

                '<div class="borrarCarrito col-sm-1 col-12">'+
                    '<br>'+
                    '<button class="quitarItemCarrito" idProducto="'+item.idProducto+'" peso="'+item.peso+'" tipo="'+item.tipo+'">'+
                        '<i class="fa fa-times"></i>'+
                    '</button>'+
                '</div>'+

                '<div class="col-sm-1 col-12">'+
                    '<figure>'+
                        '<a href="'+item.ruta+'">'+
                            '<img src="'+item.imagen+'" class="img-thumbnail" alt="">'+
                        '</a>'+
                    '</figure>'+
                '</div>'+

                '<div class="col-sm-4 col-12">'+
                    '<br>'+
                    
                    '<p class="tituloCarritoCompras">'+
                        '<a href="'+item.ruta+'">'+item.titulo+'</a>'+
                    '</p>'+
                '</div>'+

                '<div class="col-md-2 col-sm-1 col-12">'+
                    '<br>'+
                    '<p class="precioCarritoCompra text-center">MX $<span>'+item.precio+'</span></p>'+
                '</div>'+

                '<div class="cantidadCarrito col-md-2 col-sm-1 col-8">'+
                    '<br>'+
                    '<input type="number" class="cantidadItem text-center" min="1" value="'+item.cantidad+'" precio="'+item.precio+'" idProducto="'+item.idProducto+'">'+
               '</div>'+

                '<div class="col-md-2 col-sm-1 col-4">'+
                    '<br>'+
                    '<p class="subtotalCarritoCompra'+item.idProducto+' subtotales text-center"><strong>MX $<span>'+item.precio+'</span></strong></p>'+
                '</div>'+

                '<hr></hr>'+

            '</div>');

    }

}else{

    $(".cuerpoCarrito").html('<div class="textCarritoNull text-center"><h4>Aún no existen productos en el carrito de compras</h4></div>');
    $(".sumaCarrito").hide();

}


/* ==============================
/* ==============================
/* ==============================
/* ==============================
    AGREGAR AL CARRITO
================================ */

$(".agregarCarrito").click(function(){

    var idProducto = $(this).attr("idProducto");
    var imagen = $(this).attr("imagen");
    var titulo = $(this).attr("titulo");
    var precio = $(this).attr("precio");
    var tipo = $(this).attr("tipo");
    var peso = $(this).attr("peso");
    var ruta = $(this).attr("ruta");

    var agregarAlCarrito = false;
    var agregarAlCarritoD = false;
    var agregarAlCarritoC = false;

    /* ==============================
    CAPTURAR DETALLES
    ================================ */

    var seleccionarDetalle = $(".seleccionarDetalle");
    var seleccionarColor = $(".seleccionarDetalleC");

    for( var i = 0; i < seleccionarColor.length; i++){

        if($(seleccionarColor[i]).val() == ""){

            swal({
                title: "¡Debe Seleccionar un color!",
                text: "",
                type:"warning",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Seleccionar",
                closeOnConfirm: false
            })

        }else{

            titulo =  titulo + " - " + $(seleccionarColor[i]).val();

            agregarAlCarritoC = true;

        }

    }

    for( var i = 0; i < seleccionarDetalle.length; i++){

        if($(seleccionarDetalle[i]).val() == ""){

            swal({
                title: "¡Debe Seleccionar una talla!",
                text: "",
                type:"warning",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Seleccionar",
                closeOnConfirm: false
            })

        }else{

            titulo =  titulo + " - " + $(seleccionarDetalle[i]).val();

            agregarAlCarritoD = true;

        }

    }


    if(agregarAlCarritoD && agregarAlCarritoC){

        agregarAlCarrito = true;

    }


    /* ==============================
    ALMACENAR EN EL LOCALSTORAGE LOS PRODUCTOS AGREGADOS AL CARRITO
    ================================ */
    if(agregarAlCarrito){

        /* ==============================================
        RECUPERAR ALMACENAMIENTO DEL LOCALSTORAGE
        ================================================= */
        if(localStorage.getItem("listaProductos") == null){

            listaCarrito = [];

        }else{

            // ============================================= Evitar que se repita el mismo producto

            // var listaProductos = JSON.parse(localStorage.getItem("listaProductos"));

            // for(var i = 0; i < listaProductos.length; i++){

            //     if(listaProductos[i]["idProducto"]){

            //         swal({
            //             title: "EL PRODUCTO YA FUE AGREGADO AL CARRITO DE COMPRAS",
            //             text: "",
            //             type: "warning",
            //             confirmButtonText: "Cerrar",
            //             closeOnConfirm: false
            //         })

            //         return;

            //     }

            // }
            // ============================================= FIN Evitar que se repita el mismo producto

            listaCarrito.concat(localStorage.getItem("listaProductos"));

        }

        listaCarrito.push({"idProducto":idProducto,
                            "imagen":imagen,
                            "titulo":titulo,
                            "precio":precio,
                            "tipo":tipo,
                            "peso":peso,
                            "cantidad":"1",
                            "ruta":ruta});

        localStorage.setItem("listaProductos", JSON.stringify(listaCarrito));

        /* ==============================================
        ACTUALIZAR CESTA
        ================================================= */
        var cantidadCesta = Number($(".cantidadCesta").html()) + 1;
        var sumaCesta = Number($(".sumaCesta").html()) + Number(precio);

        $(".cantidadCesta").html(cantidadCesta);
        $(".sumaCesta").html(sumaCesta);

        localStorage.setItem("cantidadCesta", cantidadCesta);
        localStorage.setItem("sumaCesta", sumaCesta);


        /* ==============================================
        MOSTRAR ALERTA DE PRODUCTO AGREGADO
        ================================================= */
        swal({
            title: "",
            text: "El producto se agrego a tu carrito de compras!",
            type:"success",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Continuar Comprando",
            confirmButtonText: "Ir al carrito de compras",
            closeOnConfirm: false
        },
        function(isConfirm){
            if(isConfirm){
                window.location = rutaOculta+"carrito-de-compras";
            }
        });

    }


})


/* ==============================
/* ==============================
/* ==============================
/* ==============================
    QUITAR PRODUCTOS DEL CARRITO
================================ */
$(".quitarItemCarrito").click(function(){

    $(this).parent().parent().remove();

    var idProducto = $(".cuerpoCarrito button");
    var imagen = $(".cuerpoCarrito img");
    var titulo = $(".cuerpoCarrito .tituloCarritoCompras a");
    var precio = $(".cuerpoCarrito .precioCarritoCompra span");
    var tipo = $(".cuerpoCarrito button");
    var peso = $(".cuerpoCarrito .button");
    var cantidad = $(".cuerpoCarrito .cantidadItem");
    var ruta = $(".cuerpoCarrito figure a");

    /* ==============================================
    ACTUALIZAR EL LOCALSTORAGE
    ================================================= */
    listaCarrito = [];
    
    if(idProducto.length != 0){

        for(var i = 0; i < idProducto.length; i++){

            var idProductoArray = $(idProducto[i]).attr("idProducto");
            var imagenArray = $(imagen[i]).attr("src");
            var tituloArray = $(titulo[i]).html();
            var precioArray = $(precio[i]).html();
            var tipoArray = $(tipo[i]).attr("tipo");
            var pesoArray = $(peso[i]).attr("peso");
            var cantidadArray = $(cantidad[i]).val();
            var rutaArray = $(ruta[i]).attr("href");

            listaCarrito.push({"idProducto":idProductoArray,
                            "imagen":imagenArray,
                            "titulo":tituloArray,
                            "precio":precioArray,
                            "tipo":tipoArray,
                            "peso":pesoArray,
                            "cantidad":cantidadArray,
                            "ruta":rutaArray});

        }

        localStorage.setItem("listaProductos", JSON.stringify(listaCarrito));

        sumaSubTotales();
        cestaCarrito(listaCarrito.length);

    }else{

        /* ==============================================
        REMOVER TODO
        ================================================= */
        localStorage.removeItem("listaProductos");

        localStorage.setItem("cantidadCesta", "0");
        localStorage.setItem("sumaCesta", "0");

        $(".cantidadCesta").html("0");
        $(".sumaCesta").html("0");

        $(".cuerpoCarrito").html('<div class="textCarritoNull text-center"><h4>Aún no existen productos en el carrito de compras</h4></div>');
        $(".sumaCarrito").hide();

    }

})


/* ==============================
/* ==============================
/* ==============================
/* ==============================
    GENERAR EL SUBTOTAL CON CAMBIO DE CANTIDAD
================================ */
$(".cantidadItem").change(function(){

    var cantidad = $(this).val();
    var precio = $(this).attr("precio");
    var idProducto = $(this).attr("idProducto");

    $(".subtotalCarritoCompra"+idProducto).html('<strong>MX $<span>'+(cantidad*precio)+'</span></strong>');

    /* ==============================================
    ACTUALIZAR EL LOCALSTORAGE
    ================================================= */
    var idProducto = $(".cuerpoCarrito button");
    var imagen = $(".cuerpoCarrito img");
    var titulo = $(".cuerpoCarrito .tituloCarritoCompras a");
    var precio = $(".cuerpoCarrito .precioCarritoCompra span");
    var tipo = $(".cuerpoCarrito button");
    var peso = $(".cuerpoCarrito .button");
    var cantidad = $(".cuerpoCarrito .cantidadItem");
    var ruta = $(".cuerpoCarrito figure a");

    listaCarrito = [];

    for(var i = 0; i < idProducto.length; i++){

        var idProductoArray = $(idProducto[i]).attr("idProducto");
        var imagenArray = $(imagen[i]).attr("src");
        var tituloArray = $(titulo[i]).html();
        var precioArray = $(precio[i]).html();
        var tipoArray = $(tipo[i]).attr("tipo");
        var pesoArray = $(peso[i]).attr("peso");
        var cantidadArray = $(cantidad[i]).val();
        var rutaArray = $(ruta[i]).attr("href");

        listaCarrito.push({"idProducto":idProductoArray,
                        "imagen":imagenArray,
                        "titulo":tituloArray,
                        "precio":precioArray,
                        "tipo":tipoArray,
                        "peso":pesoArray,
                        "cantidad":cantidadArray,
                        "ruta":rutaArray});

    }

    localStorage.setItem("listaProductos", JSON.stringify(listaCarrito));

    sumaSubTotales();
    cestaCarrito(listaCarrito.length);

})


/* ==============================
/* ==============================
/* ==============================
/* ==============================
    ACTUALIZAR SUBTOTAL
================================ */
var precioCarritoCompra = $(".cuerpoCarrito .precioCarritoCompra span");
var cantidadItem = $(".cuerpoCarrito .cantidadItem");

for(var i = 0; i < precioCarritoCompra.length; i++){

    var precioCarritoCompraArray = $(precioCarritoCompra[i]).html();
    var cantidadItemArray = $(cantidadItem[i]).val();
    var idProductoArray = $(cantidadItem[i]).attr("idProducto");

    $(".subtotalCarritoCompra"+idProductoArray).html('<strong>MX $<span>'+(precioCarritoCompraArray*cantidadItemArray)+'</span></strong>');

    // Ejecutamos la funcion sumaSubTotales()
    sumaSubTotales();
    cestaCarrito(precioCarritoCompra.length);

}


/* ==============================
/* ==============================
/* ==============================
/* ==============================
    SUMA DE TODOS LOS SUBTOTALES
================================ */
function sumaSubTotales(){
    var subtotales = $(".subtotales span");
    var arraySumaSubTotales = [];
    
    for(var i = 0; i < subtotales.length; i++){

        var subtotalesArray = $(subtotales[i]).html();
        arraySumaSubTotales.push(Number(subtotalesArray));

    }

    function sumaArraySubTotales(total, numero){

        return total + numero;

    }

    var sumaTotal = arraySumaSubTotales.reduce(sumaArraySubTotales);

    $(".sumaTotal").html('<strong>MX $ <span>'+sumaTotal+'</span></strong>');

    $(".sumaCesta").html(sumaTotal);

    localStorage.setItem("sumaCesta", sumaTotal);
    
}


/* ==============================
/* ==============================
/* ==============================
/* ==============================
    ACTUALIZAR CESTA AL CAMBIAR CANTIDAD
================================ */
function cestaCarrito(cantidadProductos){

    /* ==============================================
    HAY PRODUCTOS EN EL CARRITO?
    ================================================= */
    if(cantidadProductos != 0){

        var cantidadItem = $(".cuerpoCarrito .cantidadItem");
        var arraySumaCantidades = [];

        for(var i = 0; i < cantidadItem.length; i++){

            var cantidadItemArray = $(cantidadItem[i]).val();
            arraySumaCantidades.push(Number(cantidadItemArray));
    
        }
    
        function sumaArrayCantidades(total, numero){
    
            return total + numero;
    
        }
    
        var sumaTotalCantidades = arraySumaCantidades.reduce(sumaArrayCantidades);

        $(".cantidadCesta").html(sumaTotalCantidades);
        localStorage.setItem("cantidadCesta", sumaTotalCantidades);

    }

}