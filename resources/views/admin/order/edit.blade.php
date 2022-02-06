@extends('layouts.admin')

@section('content')
    <div class="card m-md-5">
        <h4 class="card-header">Editar Color</h4>
        <div class="card-body">
            @include('shared._errors')
            <form method="POST" action="{{ route('colors.update', $color) }}">
                {{ method_field('PUT') }}
                {{ csrf_field() }}

                @include('admin.color._fields')

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-dark">Actualizar color</button>
                    <a href="{{ route('colors.index') }}" class="btn btn-link">Regresar al listado de colores</a>
                </div>
            </form>
        </div>
    </div>

@endsection
