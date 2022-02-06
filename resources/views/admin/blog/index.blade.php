@extends('layouts.admin')
@section('content')
@component("components.tableThree")
@slot("title","Posts")
@slot("btnAttr")
href="{{route('posts.create')}}"
@endslot
@slot("btnName","Nuevo Post")
@slot("tableAttr")
id="postTable"
@endslot
@slot("tableHeaders")
<tr>
    <th>#</th>
    <th>Título</th>
    <th>Categoría</th>
    <th>Imagen</th>
    <th>Fecha de Publicación</th>
    <th>Acciones</th>
</tr>
@endslot
@slot("tableBody")
@foreach($posts as $post)
<tr>
    <td>{{$post->id}}</td>
    <td>{{$post->title}}</td>
    <td>{{$post->category->name}}</td>
    <td><img src="{{asset('img/posts/'.$post->image)}}" alt="blog-img" width="80px"></td>
    <td>{{$post->created_at}}</td>
    <td>
        <a href="{{route('posts.edit',$post)}}" class="btn btn-outline-secondary btn-sm">
            <span class="fa fa-edit"></span>
        </a>
        <form id="formDeletePost{{$post->id}}" action="{{ route('posts.destroy', $post->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="button"
            onclick="sendDelete('formDeletePost{{$post->id}}')" class="btn btn-outline-danger btn-sm">
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
@if ($message = Session::get('success'))
    <script>
        swal('', "{{$message}}", "success");
    </script>
@endif
<script>
    $("#postTable").DataTable({
        columns: [
            null,
            null,
            null,
            { orderable: false },
            null,
            { orderable: false },
        ],
        order: [ 4, 'desc' ],
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