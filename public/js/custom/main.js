function loadMain() {
    return {
        cart: [],
        qty: 0,
        subtotal: 0,
        cartLoading: false,
        ///Finalizar Compra.
        name: "",
        phone: "",
        address: "",
        reference: "",
        email: "",
        detail: "",

        destinations: [],
        place: 1,
        delivery: 1,
        payMethod: "deposit",
        async init() {
            await fetch("/cart")
                .then((response) => response.json())
                .then((cart) => {
                    this.updateCart(cart);
                })
                .catch((error) => console.log(error));
            await fetch("/destinations")
                .then((response) => response.json())
                .then((destinations) => {
                    this.destinations = destinations;
                })
                .catch((error) => console.log(error));
        },
        async addItem(id) {
            this.cartLoading = true;
            let quantity = parseInt(
                document.getElementById("quantity" + id).value
            );
            if (quantity <= 0) {
                swal("", "Especifica la cantidad por favor!", "error");
                this.cartLoading = false;
                return;
            }
            let data = {
                id,
                quantity,
            };
            let resp = await fetch("/cart", {
                method: "POST",
                cache: "no-cache",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                referrerPolicy: "no-referrer",
                body: JSON.stringify(data),
            });

            resp.json()
                .then((response) => {
                    if(response.status==="Ok"){
                        console.log(response.msg);
                        this.updateCart(response.msg);
                        swal("Bien Hecho", "Agregado Correctamente!", "success");
                    }else{
                        swal("Lo sentimos", response.msg, "error");
                    }
                })
                .catch((error) => {
                    alert("Ocurrió un error");
                    console.log(error);
                });
            this.cartLoading = false;
        },
        async removeItem(rowId) {
            this.cartLoading = true;

            let data = {
                rowId,
            };
            let resp = await fetch("/cart", {
                method: "DELETE",
                cache: "no-cache",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                referrerPolicy: "no-referrer",
                body: JSON.stringify(data),
            });

            resp.json().then((cart) => {
                this.updateCart(cart);
            });

            this.cartLoading = false;
        },
        updateCart(cart) {
            console.log(cart);
            let qty = 0;
            let subtotal = 0.0;
            this.cart = [];
            for (const key in cart) {
                if (Object.hasOwnProperty.call(cart, key)) {
                    const element = cart[key];
                    this.cart.push(element);
                    qty += element.qty;
                    subtotal += element.qty * element.price;
                }
            }
            this.qty = qty;
            this.subtotal = subtotal;
        },
        get selectedPlace() {
            let a = this.destinations.find((element) => {
                return element.id == this.place;
            });
            if (a == undefined) {
                return {
                    name: "...",
                    tariff: 0,
                };
            }
            return a;
        },
        get total() {
            if (this.delivery == 1) {
                return (this.subtotal + this.selectedPlace.tariff).toFixed(2);
            }
            return this.subtotal.toFixed(2);
        },
        // processPayment(){
        //     document.getElementById(paymentForm).submit();
        // },
        async sendOrder() {
            let data = {
                name: this.name,
                phone: this.phone,
                address: this.address,
                reference: this.reference,
                email: this.email,
                detail: this.detail,
                delivery: this.delivery,
                place: this.place,
                transactionAmount: this.total,
            };
            console.log(data);
            if (this.payMethod == "deposit") {
                let shippingDataIsValid = this.validateShippingData();
                if (shippingDataIsValid == "ok") {
                    let resp = await fetch("/deposit", {
                        method: "POST",
                        cache: "no-cache",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        referrerPolicy: "no-referrer",
                        body: JSON.stringify(data),
                    });
                    resp.json()
                        .then((response) => {
                            if(response.msg=='ok'){
                                location.href = "/pedido-aceptado";
                                return;
                                swal("Hemos recibido tu pedido!", "Te contactaremos a la brevedad", "success");
                            }else{
                                alert(response.msg);
                            }
                        })
                        .catch((error) => {
                            alert("Ocurrió un errorx");
                            console.log(error);
                        });
                } else {
                    alert(shippingDataIsValid);

                }
            } else {
                document.getElementById("paymentForm").submit();
            }
        },
        validateShippingData() {
            if (this.name == "") {
                return "Ingrese su nombre";
            }
            if (this.phone == "") {
                return "Ingrese su teléfono";
            }
            if (this.address == "") {
                return "Ingrese su dirección";
            }
            if (this.address == "") {
                return "Ingrese su dirección";
            }
            if (this.email == "") {
                return "Ingrese su correo electrónico";
            }
            return "ok";
        },
    };
}
