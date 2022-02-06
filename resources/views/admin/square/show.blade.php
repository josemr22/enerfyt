<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <strong>{{$type==="in" ? 'Ingreso' : 'Salida'}}</strong>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Producto</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <th scope="row">
                                {{ $product->pivot->quantity }}
                            </th>
                            <td>{{$product->name}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
