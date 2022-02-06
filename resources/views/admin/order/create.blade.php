@extends('layouts.admin')

@section('content')
    <div class="card m-md-5">
        <h4 class="card-header">Registrar Color</h4>
        <div class="card-body">
            @include('shared._errors')
            <form method="POST" action="{{ route('colors.store') }}">
                {{ csrf_field() }}

                @include('admin.color._fields')

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">Crear Color</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-link">Regresar al listado de colores</a>
                </div>
            </form>
        </div>
    </div>

@endsection
