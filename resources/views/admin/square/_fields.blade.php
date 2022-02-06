<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">Tipo</label>
            <select x-model="type" name="type" id="type" class="form-control form-control-sm">
                <option value="in">{{\App\Models\SquareType::getList()["in"]}}</option>
                <option value="out">{{\App\Models\SquareType::getList()["out"]}}</option>
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Producto</label>
            <input class="form-control" type="text" x-model="search">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Comentario</label>
            <input x-model="commentary" type="text" class="form-control" name="commentary">
        </div>
    </div>
    <div class="col-6">
        <table class="table table-sm table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Stock</th>
                </tr>
            </thead>
            <tbody>
                <template x-if="filteredProducts.length==0">
                    <tr>
                        <td colspan="3" class="text-center">---</td>
                    </tr>
                </template>
                <template x-for="item in filteredProducts" :key="item">
                    <tr style="cursor:pointer;" x-on:click="addToSelectedProducts(item.id)">
                        <td x-text="item.code"></td>
                        <td x-text="item.name"></td>
                        <td x-text="item.stock"></td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</div>
<hr>
<div class="row">
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">Cantidad</th>
                <th scope="col" class="text-center">Código</th>
                <th scope="col" class="text-center">Producto</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <template x-if="selectedProducts.length==0">
                <tr>
                    <td colspan="4" class="text-center">---</td>
                </tr>
            </template>
            <template x-for="product in selectedProducts" :key="product">
                <tr>
                    <td class="text-center">
                        <input x-bind:id="'foo'+product.id" type="number" class="form-control" x-model="product.stock">
                    </td>
                    <td class="text-center" x-text="product.code"></td>
                    <td class="text-center" x-text="product.name"></td>
                    <td class="text-center">
                        <button 
                            x-on:click="removeFromSelectedProducts(product.id)"
                            type="button" 
                            class="btn btn-outline-danger btn-sm">
                            <span class="oi oi-trash"></span>
                        </button>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>
</div>