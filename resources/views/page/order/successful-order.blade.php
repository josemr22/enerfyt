@extends('layouts.page')
@section('content')
    <div class="container mb-4">
        <div class="alert alert-success mt-4">
            <b>Bien Hecho!</b> Tu pedido se ha realizado correctamente.
            <br>
            {{-- <span>Recibirá un correo electrónico con el detalle de su pedido.</span> --}}
        </div>
        <a href="{{route('index')}}" class="btn btn-dark btn-lg btn-block">Inicio</a>
    </div>
@endsection
