@extends('layouts.admin')

@section('content')
    @component("components.tableOne")
        @slot("title","Mensajes")
        @slot("btnAttr")
            style="display: none;"
        @endslot
        @slot("btnName","Nuevo Color")
        @slot("tableAttr")
            id="tableMessages"
        @endslot
        @slot("tableHeaders")
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Mensaje</th>
                <th>Fecha</th>
            </tr>
        @endslot
    @endcomponent
@endsection
@push('scripts')
    <script>
        let messageTable = tableOne(
            "tableMessages",
            "{{route('messages.table')}}",
            [
                {data: 'id'},
                {data: 'name'},
                {data: 'email'},
                {data: 'phone'},
                {data: 'message'},
                {data: 'created_at'},
            ],
            [ 5, 'desc' ]
        );
    </script>
@endpush
