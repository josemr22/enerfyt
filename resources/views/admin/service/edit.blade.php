@extends('layouts.admin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-end">
        <h5 class="m-0 font-weight-bold text-primary">Editar Servicio</h5>
    </div>
    <div class="card-body">
        <div class="card m-md-5">
            <div class="card-body">
                @include('shared._errors')
                <form id="formUpdateService" method="POST" action="{{ route('services.update', $service) }}" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
        
                    @include('admin.service._fields')
        
                    <div class="form-group mt-4">
                        <button type="button" onclick="sendForm('formUpdateService')" class="btn btn-primary">Actualizar Servicio</button>
                        <a href="{{ route('services.index')}}" class="btn btn-link">Regresar al Listado de Servicios</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection