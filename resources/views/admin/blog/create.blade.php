@extends('layouts.admin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-end">
        <h5 class="m-0 font-weight-bold text-primary">Crear Post</h5>
    </div>
    <div class="card-body">
        <div class="card m-md-5">
            <div class="card-body">
                @include('shared._errors')
                <form id="formStorePost" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
        
                    @include('admin.blog._fields')
        
                    <div class="form-group mt-4">
                        <button type="button" onclick="sendForm('formStorePost')" class="btn btn-primary">Registrar Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection