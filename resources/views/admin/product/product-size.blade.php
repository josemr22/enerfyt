@extends('layouts.admin')
@section('content')
    <div class="card m-md-5">
        <h4 class="card-header">Tallas del Producto {{$product->id}}: {{$product->name}}</h4>
        <div class="card-body">
            <div class="table-responsive-lg">
                <table class="table table-sm">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="sort-desc">Talla <span class="oi oi-caret-bottom"></span><span class="oi oi-caret-top"></span></th>
                        <th scope="col" class="sort-desc">Medida del ancho (cm) <span class="oi oi-caret-bottom"></span><span class="oi oi-caret-top"></span></th>
                        <th scope="col" class="sort-desc">Talla de pantalón ideal<span class="oi oi-caret-bottom"></span><span class="oi oi-caret-top"></span></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($product->sizes as $size)
                        <tr>
                            <td>{{ $size->name }}</td>
                            <td>
                                <a href="#"
                                   id="width_{{$size->pivot->id}}"
                                   onclick="openWidthModal({{$size->pivot->id}},'{{$size->pivot->width ? $size->pivot->width : ""}}');return false;">
                                    {{$size->pivot->width ?: 'No Asignado' }}
                                </a>
                            </td>
                            <td>
                                <a href="#"
                                   id="for_pants_{{$size->pivot->id}}"
                                   onclick="openPantsModal({{$size->pivot->id}},'{{$size->pivot->for_pants ? $size->pivot->for_pants : ""}}');return false;">
                                    {{$size->pivot->for_pants ?: 'No Asignado' }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal" id="modalWidth" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Ancho:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="number" class="form-control" id="registerWidth">
                    <input type="hidden" class="form-control" id="auxWidth">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="updateWidth();return false;">Guardar Cambios</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modalPants" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Talla de Pantalón Ideal:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="registerPants">
                    <input type="hidden" class="form-control" id="auxPants">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="updatePants();return false;">Guardar Cambios</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container p-5">
        <a href="{{ route('products.index') }}" class="btn btn-link">Regresar al listado de Productos</a>
    </div>
@endsection
@push('scripts')
    <script>
        function openWidthModal(id,width){
            $("#auxWidth").val(id);
            $("#registerWidth").val(width);
            $('#modalWidth').modal();
        }
        function openPantsModal(id,pantSize){
            $("#auxPants").val(id);
            $("#registerPants").val(pantSize);
            $('#modalPants').modal();
        }

        function updateWidth(){
            let id = $("#auxWidth").val();
            let description = $("#registerWidth").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "PUT",
                url: '/admin/update-product-size',
                data:{
                    'column':'width',
                    'id':id,
                    'description':description
                },
                success: function(respuesta) {
                    let data = JSON.parse(respuesta);
                    let element = "#width_"+id;
                    if(data.new==null){
                        $(element).html('No Asignado');
                    }else{
                        $(element).html(data.new);
                    }
                    $('#modalWidth').modal('hide')
                },
                error: function() {
                    alert("Ocurrió un error");
                }
            });
        }

        function updatePants(){
            let id = $("#auxPants").val();
            let description = $("#registerPants").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "PUT",
                url: '/admin/update-product-size',
                data:{
                    'column':'for_pants',
                    'id':id,
                    'description':description
                },
                success: function(respuesta) {
                    let data = JSON.parse(respuesta);
                    let element = "#for_pants_"+id;
                    //console.log(data.new);
                    if(data.new==null){
                        $(element).html('No Asignado');
                    }else{
                        $(element).html(data.new);
                    }
                    $('#modalPants').modal('hide')
                },
                error: function() {
                    alert("Ocurrió un error");
                }
            });
        }
    </script>
@endpush
