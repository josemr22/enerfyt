@extends('layouts.page')
@section('content')
    <div class="container mb-5">
        <div class="alert alert-danger mt-4">
            <b>Ocurrió un problema!</b>Tu pedido no pudo ser procesado.
            <br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <a href="{{route('index')}}" class="btn btn-dark btn-lg btn-block">Inicio</a>
    </div>
@endsection
