@extends('layouts.admin')
@section('content')
@component("components.tableThree")
@slot("title","Servicios")
@slot("btnAttr")
href="{{route('services.create')}}"
@endslot
@slot("btnName","Nuevo Servicio")
@slot("tableAttr")
id="serviceTable"
@endslot
@slot("tableHeaders")
<tr>
    <th>#</th>
    <th>Título</th>
    <th>Contenido</th>
    <th>Imagen</th>
    <th>Acciones</th>
</tr>
@endslot
@slot("tableBody")
@foreach($services as $service)
<tr>
    <td>{{$service->id}}</td>
    <td>{{$service->title}}</td>
    <td>{!!$service->content!!}</td>
    <td><img src="{{asset('img/services/'.$service->image)}}" alt="service-img" width="80px"></td>
    <td>
        <a href="{{route('services.edit',$service)}}" class="btn btn-outline-secondary btn-sm">
            <span class="fa fa-edit"></span>
        </a>
        <form id="formDeleteService{{$service->id}}" action="{{ route('services.destroy', $service->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="button"
            onclick="sendDelete('formDeleteService{{$service->id}}')" class="btn btn-outline-danger btn-sm">
                <span class="fa fa-trash"></span>
        </button>
        </form>
    </td>
</tr>
@endforeach
@endslot
@endcomponent
@endsection
@push('scripts')
<script>
    $("#serviceTable").DataTable({
        columns: [
            null,
            null,
            null,
            { orderable: false },
            { orderable: false },
        ],
        language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });
</script>
@endpush