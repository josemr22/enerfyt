@extends('layouts.admin')

@section('content')
    @component("components.tableOne")
        @slot("title","Citas")
        @slot("btnAttr")
            style="display: none;"
        @endslot
        @slot("btnName","")
        @slot("tableAttr")
            id="tableAppointments"
        @endslot
        @slot("tableHeaders")
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Mensaje</th>
                <th>Fecha de Envío</th>
                <th>Fecha de cita deseada</th>
            </tr>
        @endslot
    @endcomponent
@endsection
@push('scripts')
    <script>
        let appointmentTable = tableOne(
            "tableAppointments",
            "{{route('appointments.table')}}",
            [
                {data: 'id'},
                {data: 'name'},
                {data: 'email'},
                {data: 'phone'},
                {data: 'message'},
                {data: 'created_at'},
                {data: 'appointment_date'},
            ],
            [ 5, 'desc' ]
        );
    </script>
@endpush
