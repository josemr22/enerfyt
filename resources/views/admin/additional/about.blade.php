@extends('layouts.admin')
@push('css')
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
@endpush
@section('content')
<!-- Title page -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-end">
        <h5 class="m-0 font-weight-bold text-primary">Nosotros</h5>
    </div>
    <div class="card-body">
        <div class="card m-md-5">
            <div class="card-body">
                @include('shared._errors')
                <form method="POST" action="{{ route('about.update',$row) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div>
                        <label for="name">Sobre Nosotros:</label>
                        <textarea name="about" id="about">{!!$row->about!!}</textarea>
                    </div>


                    <div class="form-group">
                        <label for="name">Misión:</label>
                        <textarea type="text" class="form-control" name="mision">{{$row->mision}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="name">Visión:</label>
                        <textarea type="text" class="form-control" name="vision">{{$row->vision}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="name">Imagen: (600*600)</label>
                        <input type="file" name="about_image">
                    </div>

                    <div>
                        <img src="{{asset('img/gallery/'.$row->about_image)}}" alt="img" width="200">
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Content page -->
@endsection
@push('scripts')
    <script>
        ClassicEditor
            .create( document.querySelector( '#about' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush