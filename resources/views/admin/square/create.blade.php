<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
<div>
    <div class="card m-md-5">
        <div class="card-body" x-data="loadProducts()"
            x-init="fetch('{{route("products.get")}}').then(response => response.json()).then(json => {products = json})">

                @include('admin.square._fields')

                <div class="form-group mt-4">
                    <button type="button" x-bind:disabled="!dataIsValid" x-on:click="save" class="btn btn-primary">Registrar</button>
                </div>
        </div>
    </div>
</div>
<script>
    function loadProducts() {
       return {
        type: 'in',
        commentary: '',
        search: "",
        products: [],
        selectedProducts: [],

        addToSelectedProducts(id){
        let repeat = false;
        for (const key in this.selectedProducts) {
            if (Object.hasOwnProperty.call(this.selectedProducts, key)) {
                const element = this.selectedProducts[key];
                if(element.id==id){
                    repeat=true;
                }
            }
        }
        if(repeat){
            document.getElementById("foo"+id).focus();
            return;
        }
        let selectedProduct = this.products.find( product => product.id == id );
        this.selectedProducts.push({
            "id":selectedProduct.id,
            "code":selectedProduct.code,
            "name":selectedProduct.name,
            "stock" : 0,
        });
        console.log("Productos en la lista");
        console.log(this.selectedProducts);
        },

        removeFromSelectedProducts(id){
            this.selectedProducts.forEach(function(element, index, object) {
                if(element.id === id){
                object.splice(index, 1);
                }
            });
        },

        save(){
            this.selectedProducts.forEach(element => {
                element.stock=parseInt(element.stock);
            });
            ajax(
                '{{route("squares.store")}}',
                {
                    products : this.selectedProducts,
                    type : this.type,
                    commentary: this.commentary,
                }, 
                'POST')
            .done((response)=>{
                bootbox.hideAll();
                swal('', "Registro Completado", "success");
                eval("squareTable").ajax.reload(null, false);
            })
            .fail(fail => {
                if(fail.status==422){
                    showErrors(fail.responseJSON.errors);
                }else{
                    alert("Ocurrió un error");
                }
            })
            .always();
        },
        get filteredProducts() {
        if (this.search === "") {
            return [];
        }
        return this.products.filter((item) => {
            return item.name
            .toLowerCase()
            .includes(this.search.toLowerCase());
        }).slice(0, 6);
        },
        get dataIsValid() {
        if (this.type == null || this.type == "" || this.selectedProducts.length<=0) {
            return false;
        }
        for (const key in this.selectedProducts) {
            if (Object.hasOwnProperty.call(this.selectedProducts, key)) {
                const element = this.selectedProducts[key];
                if(element.stock<=0){
                    return false;
                }
            }
        }
        return true;
        },
       };
     }
</script>