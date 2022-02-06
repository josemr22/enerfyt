@extends('layouts.admin')

@section('content')
<div class="d-flex align-items-end mb-3">
    @if ($view == 'index')
        <a href="{{ route('products.trashed') }}" class="btn btn-outline-dark">Ver papelera</a>
    @else
        <a href="{{ route('products.index') }}" class="btn btn-outline-dark">Regresar al listado de productos</a>
    @endif
</div>
@component("components.tableOne")
    @slot("title","Listado de Productos")
    @slot("btnAttr")
        onclick="modal('{{route('products.create')}}','Registrar Nuevo Producto',1000)"
    @endslot
    @slot("btnName","Nuevo Producto")
    @slot("tableAttr")
        id="productsTable"
    @endslot
    @slot("tableHeaders")
        <tr>
            <th>#</th>
            <th>Código</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Categoría</th>
            <th>Stock</th>
            <th>Acciones</th>
        </tr>
    @endslot
@endcomponent
@endsection
@push('scripts')
    <script>
        let productTable = tableOne(
            "productsTable",
            @if($view=='index')
                "{{route('products.table')}}",
            @else
                "{{route('products.trashedTable')}}",
            @endif
            [
                {data: 'id'},
                {data: 'code'},
                {data: 'name'},
                {data: 'price',class:"text-right",render: function(price){
                        return "S/ "+parseFloat(price).toFixed(2);
                    }},
                {data: 'categoryName',name:'category.name'},
                {data: 'stock'},
                {data: 'actions',orderable:false},
            ],
            [ 0, 'desc' ],
        );
    </script>
@endpush
