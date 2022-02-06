<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <strong>Detalles de Pedido:</strong>
            </div>
            <div class="card-body">
                <div class="card-text">
                    <p><strong>Fecha</strong>: {{ $order->created_at }}</p>
                    <p><strong>Cliente</strong>: {{ $order->name }}</p>
                    <p><strong>Teléfono</strong>: {{ $order->phone }}</p>
                    <p><strong>Correo</strong>: {{ $order->email }}</p>
                    <p><strong>Dirección</strong>: {{ $order->address }}</p>
                    <p><strong>Referencia</strong>: {{ $order->reference ?: '---' }}</p>
                    <p><strong>Detalle</strong>: {{ $order->detail ?: '---' }}</p>
                    <p><strong>Delivery</strong>: {{ $order->delivery ? 'Sí' : 'Recojo en Tienda' }}</p>
                    @if ($order->delivery)
                        <p><strong>Ciudad</strong>: {{ $order->destination->name }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-sm-3">
        <div class="card">
            <div class="card-header bg-warning">
                <strong class="text-white">En Espera</strong>
            </div>
            <div class="card-body">
                <div class="card-text">
                    <p>{{ $order->created_at }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card">
            <div class="card-header bg-primary">
                <strong class="text-white">Aceptado</strong>
            </div>
            <div class="card-body">
                <div class="card-text">
                    <p>{{ $order->accepted_at ?: '--' }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card">
            <div class="card-header bg-success">
                <strong class="text-white">Entregado</strong>
            </div>
            <div class="card-body">
                <div class="card-text">
                    <p>{{ $order->delivered_at ?: '--' }}</p>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-sm-3">
        <div class="card">
            <div class="card-header bg-danger">
                <strong class="text-white">Rechazado</strong>
            </div>
            <div class="card-body">
                <div class="card-text">
                    <p>{{ $order->rejected_at ?: '--' }}</p>
                </div>
            </div>
        </div>
    </div> --}}
</div>

<div class="row mt-3">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <strong>Items:</strong>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Precio de Venta</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <th scope="row">{{ $item->pivot->quantity }}</th>
                            <td>{{\App\Models\Product::find($item->pivot->product_id)->name}}</td>
                            <td>{{ number_format($item->pivot->saleprice,2) }}</td>
                            <td>{{ number_format($item->pivot->saleprice*$item->pivot->quantity,2) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-center"><strong>Costo de Envío Cobrado</strong></td>
                        <td>{{number_format($order->tariff,2)}}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center"><strong>Total</strong></td>
                        <td>S/ {{number_format($order->total,2)}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
