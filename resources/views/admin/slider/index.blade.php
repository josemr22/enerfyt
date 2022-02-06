@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-end">
        <h5 class="m-0 font-weight-bold text-primary">Slider</h5>
        <button onclick="modal('{{route('sliders.create')}}','Registrar Nuevo',800)"
            class="btn btn-primary">Nuevo</button>
    </div>
    <div class="card-body">
        @if ($sliders->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="">
                    <tr>
                        <th>Header</th>
                        <th>Título</th>
                        <th>Nombre de Botón</th>
                        <th>Url</th>
                        <th>Imagen</th>
                        <th class="text-right th-actions">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sliders as $slider)
                    <tr>
                        <td>{{$slider->header}}</td>
                        <td>{{$slider->title}}</td>
                        <td>{{$slider->button_title}}</td>
                        <td>{{$slider->button_url}}</td>
                        <td><img src="{{asset('img/sliders/'.$slider->image)}}" width="200px" alt="slider-img"></td>
                        <td class="text-center">
                            <button onclick="modal('{{route('sliders.edit',$slider)}}','Editar Slider',800)"
                                class="btn btn-round-edge btn-outline-primary">
                                <i class="far fa-edit"></i>
                            </button>
                            <form id="slider{{$slider->id}}" method="post"
                                action="{{route('sliders.destroy',$slider)}}">
                                @csrf
                                @method("DELETE")
                            </form>
                            <button onclick="deleteSlider({{$slider->id}})" type="button"
                                class="btn btn-round-edge btn-outline-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p>No hay sliders registrados.</p>
        @endif
    </div>
</div>
@endsection
@push('scripts')
<script>
    function deleteSlider(id){
        bootbox.confirm({
            message: "¿Está seguro de eliminar el slider?",
            buttons: {
                cancel: {
                    label: "Cancelar",
                    className: "btn btn-warning  btn-sm",
                },
                confirm: {
                    label: "Eliminar",
                    className: "btn btn-danger btn-sm",
                },
            },
            callback: function (result) {
                if (result) {
                    $("#slider"+id).submit();
                }
            },
        });
    }
</script>
@endpush