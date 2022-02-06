var DESTINATION = {
    id: 14,
    name: "Lambayeque",
    tariff: 16
}

var SUBTOTAL=0;
loadFinalTableCart();

function shippingMethodChange(){
    const id = $("#selectShippingMethod").val();
    if (id==1){
        const destinationId = $("#selectDestination").val();
        ajaxData('/destination/query', {'destinationId':destinationId})
            .done(function (response) {
                DESTINATION = JSON.parse(response);
                $("#divSelectDestination").fadeIn();
                loadFinalTableCart();
            }).fail(function (xhr, textStatus, errorThrown) {
            swal('', "Ocurrió un error", "error");
        }).always(function () {
            }
        );
    }else{
        if(id==0){
            $("#divSelectDestination").fadeOut(800);
            DESTINATION={
                'id':0,
                'name': 'Recojo en Tienda',
                'tariff': 0.00,
            };
            // console.log(DESTINATION.tariff);
            loadFinalTableCart();
        }
    }
}

function purchaseMethodChange(){
    const method = $("#selectPurchaseMethod").val();
    if(method=="Depósito"){
        $('#paymentInfo').collapse('hide');
        $('#depositInfo').collapse('show');
    }else{
        if(method=="Mercado Pago"){
            $('#depositInfo').collapse('hide');
            $('#paymentInfo').collapse('show');
        }
        else{
            if(method==0){
                $('#depositInfo').collapse('hide');
                $('#paymentInfo').collapse('hide');
            }
        }
    }
}

function destinationSelected(){
    const destinationId = $("#selectDestination").val();
    ajaxData('/destination/query', {'destinationId':destinationId})
        .done(function (response) {
            DESTINATION = JSON.parse(response);
            $("#checkoutLabelShipping").html("Costo de Envío ("+DESTINATION.name+")");
            $("#checkoutShipping").html("S/ "+DESTINATION.tariff.toFixed(2));
            $("#checkoutTotal").html("S/ "+(SUBTOTAL+DESTINATION.tariff).toFixed(2));
        }).fail(function (xhr, textStatus, errorThrown) {
        swal('', "Ocurrió un problema al seleccionar el destino!", "error");
    }).always(function () {
        }
    );
}

function sendForm(){
    if ($("#name").val() == "") {
        swal("", "Ingrese su nombre", "error");
        return false;
    }
    if ($("#telephone").val() == "") {
        swal("", "Ingrese su teléfono", "error");
        return false;
    }
    if ($("#address").val() == "") {
        swal("", "Ingrese su dirección", "error");
        return false;
    }
    if ($("#mail").val() == "") {
        swal("", "Ingrese su correo-electrónico", "error");
        return false;
    }
    let shippingMethod=$("#selectShippingMethod").val();
    if (shippingMethod !== "0" && shippingMethod !== "1") {
        swal("", "Seleccione un método de envío", "error");
        return false;
    }
    if (shippingMethod === "0") {
        if($("#selectDestination").val()==""){
            swal("", "Seleccione un método de envío", "error");
            return false;
        }
    }
    if (shippingMethod === "0") {
        if($("#selectDestination").val()==""){
            swal("", "Seleccione un método de envío", "error");
            return false;
        }
    }
    let purchaseMethod=$("#selectPurchaseMethod").val();
    if (purchaseMethod != "Mercado Pago" && purchaseMethod != "Depósito") {
        swal("", "Seleccione un método de pago", "error");
        return false;
    }
    ajax('cart/query','GET')
        .done(function (response) {
            let cart=JSON.parse(response);
            console.log(cart);
            if(cart.length<=0){
                swal('', "Tu carrito está vacío", "error");
                return;
            }
            document.getElementById("paymentForm").submit();
        }).fail(function (xhr, textStatus, errorThrown) {
        swal('', "Ocurrió un problema al obtener el carrito!", "error");
        }).always(function () {
            }
        );
}

function ajaxData(url, data) {
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "GET",
        url: url,
        data: data,
        cache: false,
    });
}

function ajax(url,method) {
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: method,
        url: url,
        cache: false,
    });
}

function loadFinalTableCart(){
    ajax('/cart/query','GET').done(function (response) {
        let cart = JSON.parse(response);
        finalTableCartUpdate(cart);
    }).fail(function (xhr, textStatus, errorThrown) {
        swal('', "Ocurrió un problema al obtener el carrito!", "error");
    }).always(function () {});
}

function finalTableCartUpdate(cart){
    SUBTOTAL=0;
    let template=``;
    if(Object.keys(cart).length>0) {
        for (let key of Object.keys(cart)) {
            let item = cart[key];
            template += `
            <div class="row pb-md-2">
                <div class="col-4 col-md-2 icon-header-noti" aria-hidden="true" data-notify="${item.qty}">
                    <img src="/img/products/${item.options.image}" class="icon-header-noti2" width="95%px" alt="product-image">
                </div>
                <div class="col-5 col-md-8 detalle-datos">
                    <div class="row">&nbsp;&nbsp;</div>
                    <div class="row"><span class="nombre">${item.name}</span></div>
                    <div class="row"><span class="precio">Precio: S/${parseFloat(item.price).toFixed(2)}</span></div>
                </div>
                <div class="col-3 col-md-2 detalle-datos">
                    <div class="row">&nbsp;<br>&nbsp;</div>
                    <div class="row"><span class="nombre">S/. ${(parseFloat(item.price)*parseFloat(item.qty)).toFixed(2)}</span></div>
                    <div class="row"><span class="precio">&nbsp;&nbsp;</span></div>
                    <div class="row">&nbsp;</div>
                </div>
            </div>`;
            SUBTOTAL=SUBTOTAL+item.price*parseInt(item.qty);
        }
    }else {
        template+=`
                <div class="p-sm-3>
                    <h6 class="text-center ml-5">No hay productos en tu carrito...</h6>
                </div>
        `;
    }
    $("#finalTableCart").html(template);
    $("#checkoutSubtotal").html("S/ "+SUBTOTAL.toFixed(2));
    $("#checkoutLabelShipping").html("Costo de Envío ("+DESTINATION.name+")");
    $("#checkoutShipping").html("S/ "+DESTINATION.tariff.toFixed(2));
    $("#checkoutTotal").html("S/ "+(SUBTOTAL+DESTINATION.tariff).toFixed(2));
    $("#transactionAmount").val((SUBTOTAL+DESTINATION.tariff).toFixed(2));
}

//Mercado Pago



