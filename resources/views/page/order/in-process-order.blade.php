@extends('layouts.page')
@section('content')
    <div class="container mb-4">
        <div class="alert alert-success mt-4">
            <b>Bien Hecho!</b> Hemos recibido tu pedido. Sin embargo, tu entidad financiera no ha completado el pago todavía. Se encuentra en proceso. Contáctanos para más información.
            <br>
            <span>Recibirá un correo electrónico con el detalle de su pedido.</span>
        </div>
        <a href="{{route('index')}}" class="btn btn-dark btn-lg btn-block">Inicio</a>
    </div>
@endsection
