loadTableCart();

function tableCartUpdate(cart){
    let template=``;
    let totalPrice=0;
    if(Object.keys(cart).length>0){
        template+=`
            <div class="m-l-25 m-r--38 m-lr-0-xl mb-sm-5">
                <div class="wrap-table-shopping-cart">
                    <table class="table-shopping-cart">
                        <tr class="table_head">
                            <th class="column-1">Producto</th>
                            <th class="column-2"></th>
                            <th class="column-3">Color</th>
                            <th class="column-3">Talla</th>
                            <th class="column-3">Precio</th>
                            <th class="column-4 text-center">Cantidad</th>
                            <th class="column-5">Total</th>
                        </tr>`;
        for (let key of Object.keys(cart)) {
            let item = cart[key];
            template+=`
                        <tr class="table_row">
                            <td class="column-1">
                                <a onclick="btnDelete('${item.rowId}')">
                                    <div class="how-itemcart1">
                                        <img src="/img/products/${item.options.image}" alt="IMG">
                                    </div>
                                </a>
                            </td>
                            <td class="column-2">${item.name}</td>
                            <td class="column-2">${item.options.color.name}</td>
                            <td class="column-2">${item.options.size.name}</td>
                            <td class="column-3">S/${parseFloat(item.price).toFixed(2)}</td>
                            <td class="column-4 text-center">
                                ${item.qty}
                            </td>
                            <td class="column-5">S/${parseFloat(item.price*parseInt(item.qty)).toFixed(2)}</td>
                        </tr>`;
            console.log(item.price);
            console.log(item.qty);
            console.log(item.price*parseInt(item.qty));
            totalPrice=totalPrice+(item.price*parseFloat(item.qty));
        }
        console.log(totalPrice);
        template+=`
                   </table>
                </div>
                <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                    <div class="flex-w flex-m m-r-20 m-tb-5">
                        <span>Sub Total:</span>
                    </div>
                    <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13" id="totalPrice">
                        S/ ${parseFloat(totalPrice).toFixed(2)}
                    </div>
                </div>
                <a href="/finalizar" class="btn btn-dark d-flex ml-auto my-3 my-sm-5">Finalizar Compra</a>
            </div>`;
    }
    else{
        template+=`
            <div class="m-l-25 m-r--38 m-lr-0-xl">
               <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4 p-md-5">
                        <img src="/page-img/icons/cart.png" width="100%">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-sm-5 d-flex">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-center"><strong>No hay productos en tu carrito.</strong></h5>
                            </div>
                            <div class="col-12">
                                <a href="/catalogo" class="btn btn-block btn-dark my-3">Ir a catálogo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `;
        }
    $("#tableCart").html(template);
}

function loadTableCart(){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "GET",
        url: '/cart/query',
        cache: false,
        success: function (response) {
            let cart = JSON.parse(response);
            tableCartUpdate(cart);
        },
        error: function () {
            swal('', "Ocurrió un problema al obtener el carrito!", "error");
        }
    });
}

// function showPurchaseDiv(purchaseMethod){
//     $(".purchaseMethodDiv").addClass('d-none');
//     let element="#"+purchaseMethod+"MethodDiv";
//     $(element).removeClass("d-none");
// }
