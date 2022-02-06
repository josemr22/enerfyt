@extends('layouts.admin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-end">
        <h5 class="m-0 font-weight-bold text-primary">Editar Post</h5>
    </div>
    <div class="card-body">
        <div class="card m-md-5">
            <div class="card-body">
                @include('shared._errors')
                <form id="formUpdatePost" method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
        
                    @include('admin.blog._fields')
        
                    <div class="form-group mt-4">
                        <button type="button" onclick="sendForm('formUpdatePost')" class="btn btn-primary">Actualizar Post</button>
                        <a href="{{ route('posts.index')}}" class="btn btn-link">Regresar al Listado de Posts</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection