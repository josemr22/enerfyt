<button type="button" onclick="modal('{{route('orders.show', $id)}}','Detalle de Pedido')" 
    class="btn btn-outline-secondary btn-sm"><span class="oi oi-eye"></span></button>

@if($state === 'delivered')
    <button title="Remover" onclick="reject({{$id}})" type="button" class="ml-1 btn btn-outline-danger btn-sm"><span class="oi oi-trash"></span></button>
@else
    @php($label = $state === 'in_process' ? 'aceptado' : 'entregado')
    <button title="Cambiar a {{$label}}" onclick="changeState({{$id}},'{{$label}}')" type="button" class="btn btn-outline-success btn-sm"><span class="oi oi-arrow-circle-right"></span></button>
    <button title="Rechazar" onclick="reject({{$id}})" type="button" class="btn btn-outline-danger btn-sm"><span class="oi oi-circle-x"></span></button>
@endif