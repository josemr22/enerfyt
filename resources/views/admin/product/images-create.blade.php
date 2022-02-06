@extends('layouts.admin')
@push('css')
<link href="{{ asset('css/dropzone.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="card m-md-5">
    <h4 class="card-header">Cargar Nuevas Imágenes</h4>
        <div class="card-body">
            @include('shared._errors')
                <form action="{{ route('images.store', $product) }}"
                method="POST"
                class="dropzone"
                id="my-awesome-dropzone">
            </form>
        </div>
    </div>

    <div class="card m-md-5">
        <h4 class="card-header">Lista de imágenes del Producto {{$product->id}} : {{$product->name}}</h4>
        <div class="card-body" id="gallery">
            <div class="row" id="galleryProduct">
                @foreach ($product->images as $image)
                    <div id="image_{{$image->id}}" class="col-6 col-sm-4 col-lg-3 mb-3">
                        <a href="#" onclick="imageDelete({{$image->id}});return false;" class="btn btn-block btn-sm btn-outline-danger"><span class="oi oi-trash"></span>&nbsp;&nbsp;Eliminar</a>
                    <img src="{{asset("img/products/$image->name")}}" class="border border-bottom-dark" alt="imagen-producto" width="100%">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <a href="{{ route('products.index') }}" class="btn btn-dark  ml-5 mt-3">Regresar al listado de Productos</a>
    @endsection

@push('scripts')
<script src="{{ asset('js/dropzone.min.js') }}"></script>
<script>
       Dropzone.options.myAwesomeDropzone = {
           addRemoveLinks: true,
           acceptedFiles: 'image/*',
           dictInvalidFileType: 'Configurado solo para imágenes',
           headers:{
               'X-CSRF-TOKEN' : "{{csrf_token()}}"
           },
           dictDefaultMessage: "Arrastre una imagen al recuadro",
           success: function(file, response){
                let images = JSON.parse(response);//console.log(images);return;
                let template ='';
                for (image of images) {
                template += `<div id="image_${image.id}" class="col-6 col-sm-4 col-lg-3 mb-3">
                        <a href="#" onclick="imageDelete(${image.id});return false;" class="btn btn-block btn-sm btn-outline-danger"><span class="oi oi-trash"></span>&nbsp;&nbsp;Eliminar</a>
                            <img src="/img/products/${image.name}" alt="imagen-producto" width="100%">
                           </div>`;
                }
                $("#galleryProduct").html(template);
            },
            // error: function(err1,err2){
            //     console.log(err1,err2);
            // }
       }

       function imageDelete(id){
           $.ajax({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               method: "DELETE",
               url: '/admin/images',
               data:{
                   'id':id,
               },
               success: function(respuesta) {
                   let images = JSON.parse(respuesta);
                   if(images.msg=='ok'){
                       $("#image_"+id).fadeOut();
                   }
               },
               error: function() {
                   alert("Ocurrió un error");
               }
           });
       };
</script>
@endpush
