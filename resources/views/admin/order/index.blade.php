@extends('layouts.admin')
@section('content')
    @component("components.tableOne")
        @slot("title","Pedidos")
        @slot("btnAttr")
            style="display: none;"
        @endslot
        @slot("btnName","Nuevo Pedido")
        @slot("tableAttr")
            id="tableOrders"
        @endslot
        @slot("tableHeaders")
        <tr>
            <th>Cliente</th>
            <th>Delivery</th>
            <th>Total Cobrado</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        @endslot
    @endcomponent
@endsection
@push('scripts')
    <script>
        let orderTable = tableOne(
            "tableOrders",
            "{{route('orders.table')}}",
            [
                {data: 'name'},
                {data: 'delivery',render: function(delivery){
                        return delivery ? 'Si' : 'No';
                }},
                {data: 'total',render: function(total){
                        return `S/ ${parseFloat(total).toFixed(2)}`;
                }},
                {data: 'created_at'},
                {data: 'state',render: function(state){
                        let label = state=='in_process' ? 'En espera' : (state=='accepted' ? 'Aceptado' : 'Entregado'); 
                        let color = state=='in_process' ? 'warning' : (state=='acepted' ? 'primary' : 'success'); 
                        return `<span class="badge badge-${color} p-2">${label}</span>`;
                }},
                {data: 'actions', class: 'text-center'},
            ],
            [ 3, 'desc' ]
        );
    </script>

    <script>
        function changeState(id,label){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : '/admin/pedidos/change-state/'+id,
                type: 'PUT',
                contentType: false,
                processData: false
            }).done(function(response) {
                console.log(response);
                swal('',"Estado actualizado","success");
                orderTable.ajax.reload(null, false);
            }).fail(function(fail) {
                alert("Ocurrió un error");
            }).always(function() {
            });
        }

        function reject(id){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : '/admin/pedidos/rechazar/'+id,
                type: 'PUT',
                contentType: false,
                processData: false
            }).done(function(response) {
                console.log(response);
                swal('',"Pedido Rechazado","success");
                orderTable.ajax.reload(null, false);
            }).fail(function(fail) {
                alert("Ocurrió un error");
            }).always(function() {
            });
        }
    </script>
@endpush

