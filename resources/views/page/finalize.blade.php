@extends('layouts.page')
@section('content')
    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92 mb-2 mb-md-5" style="background-image: url({{asset('page-img/bg-02.jpg')}});">
        <h2 class="ltext-105 cl0 txt-center">
            Finalizar Compra
        </h2>
    </section>

    {{--Payment Data--}}
    <section class="bg0 p-b-116">
        <div class="container">
            @include('shared._errors')
            <form action="{{route('orders.payment')}}" method="post" id="paymentForm">
            @csrf
            <div class="row">
                <div class="container col-12 col-md-6">
                    <div class="titulos">
                        <h5>Información del envío</h5>
                    </div>
                    <div class="container input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Nombre</label>
                        </div>
                        <input required type="text" name="name" x-model="name" class="form-control">
                    </div>
                    <div class="container input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Teléfono</label>
                        </div>
                        <input required type="number" pattern="[0-9]{9}" name="phone" class="form-control" x-model="phone">
                    </div>
{{--                    <div class="container input-group mb-3">--}}
{{--                        <div class="input-group-prepend">--}}
{{--                            <label class="input-group-text" for="dni">DNI</label>--}}
{{--                        </div>--}}
{{--                        <input type="number" id="dni" aria-label="First name" class="form-control">--}}
{{--                    </div>--}}
                    <div class="container input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" >Dirección</label>
                        </div>
                        <input required type="text" name="address" x-model="address" class="form-control">
                    </div>
                    <div class="container input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" >Referencia</label>
                        </div>
                        <input type="text" name="reference" class="form-control" x-model="reference">
                    </div>
                    <div class="container input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="email" >Correo</label>
                        </div>
                        <input required type="email" x-model="email" name="email" class="form-control">
                    </div>
                    <div class="container input-group mb-3">
                        <div class="input-group-prepend">
                        </div>
                        <textarea class="form-control input-sm" placeholder="Detalle o comentario del pedido" rows="3" name="detail" x-model="detail"></textarea>
                    </div>
                    <div class="titulos">
                        <h5>Método de envío y pago</h5>
                    </div>
                    <div class="container input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Envío</label>
                        </div>
                        <select required class="custom-select form-control" name="delivery" x-model="delivery"
                        >
                            <option value="1">Delivery</option>
                            <option value="0">Recojo en Tienda</option>
                        </select>
                    </div>
                    <div x-show.transition="delivery==1" class="container input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Ciudad</label>
                        </div>
                        <select name="place" x-model="place" class="custom-select form-control">
                            <template x-for="destination in destinations">
                                <option :selected="destination.id==place" :value="destination.id" x-text="destination.name"></option>
                            </template>
                        </select>
                        {{-- <span x-text="place"></span> --}}
                    </div>
                    <div class="container input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Pago</label>
                        </div>
                        <select x-model="payMethod" class="custom-select form-control" name="payMethod">
                            {{-- <option value="card">Tarjeta</option> --}}
                            <option value="deposit">Depósito</option>
                        </select>
                    </div>
                    
                    {{-- <div x-show.transition="payMethod=='card'">
                        @includeIf('page.partials._payment-card')
                    </div> --}}
                    <div x-show.transition="payMethod=='deposit'">
                        @includeIf('page.partials._deposit')
                    </div>
                </div>
                <div class="col-12 col-md-6 columna2">
                    <div class="container">
                        <div class="titulos">
                            <h5>Resumen del Pedido</h5>
                        </div>
                        <div>
                            <template x-for="item in cart" :key="item">
                                <div class="row pb-md-2">
                                    <div class="col-4 col-md-2 icon-header-noti" aria-hidden="true" :data-notify="item.qty">
                                        <img :src="'/img/products/'+item.options.image" class="icon-header-noti2" width="95%px" alt="product-image">
                                    </div>
                                    <div class="col-5 col-md-8 detalle-datos">
                                        <div class="row">&nbsp;&nbsp;</div>
                                        <div class="row"><span x-text="item.name" class="nombre"></span></div>
                                        <div class="row"><span class="precio" x-text="'Precio: S/'+parseFloat(item.price).toFixed(2)"></span></div>
                                    </div>
                                    <div class="col-3 col-md-2 detalle-datos">
                                        <div class="row">&nbsp;<br>&nbsp;</div>
                                        <div class="row"><span class="nombre" x-text="'S/. '+(parseFloat(item.price)*parseFloat(item.qty)).toFixed(2)"></span></div>
                                        <div class="row"><span class="precio">&nbsp;&nbsp;</span></div>
                                        <div class="row">&nbsp;</div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div class="row subtotal">
                            <div class="col-8 col-md-2 label">Sub-total</div>
                            <div class="col-md-8 d-none d-sm-none d-md-block"></div>
                            <div class="col-4 col-md-2 cantidad" x-text="'S/ '+subtotal.toFixed(2)"></div>
                        </div>
                        <div x-show="delivery==1" class="row envios">
                            <div class="col-8 col-md-2 label" x-text="'Costo de Envío ('+selectedPlace.name+')'"></div>
                            <div class="col-md-8 d-none d-md-block"></div>
                            <div class="col-4 col-md-2 cantidad" x-text="'S/ '+selectedPlace.tariff.toFixed(2)"></div>
                        </div>
                        <div x-show="delivery==0" class="row envios">
                            <div class="col-8 col-md-2 label">Costo de Envío (Recojo en Tienda)</div>
                            <div class="col-md-8 d-none d-md-block"></div>
                            <div class="col-4 col-md-2 cantidad">S/ 0.00</div>
                        </div>
                        <div class="row total">
                            <div class="col-8 col-md-2 label">Total</div>
                            <div class="col-md-8 d-none d-md-block"></div>
                            <div class="col-4 col-md-2 cantidad" x-text="'S/ '+total"></div>
                        </div>
                        <div class="container boton">
                            <template x-if="payMethod==='deposit'">
                                <button type="button" @click="sendOrder()" class="btn btn-primary btn-lg btn-block">
                                    <i class='fas fa-shopping-basket'></i>&nbsp;&nbsp;Realizar Pedido
                                </button>
                            </template>
                            {{-- <template x-if="payMethod==='card'">
                                <button type="submit" class="btn btn-primary btn-lg btn-block"><i class='fas fa-shopping-basket'></i>&nbsp;&nbsp;Realizar Pago</button>
                            </template> --}}
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom/finalize.css') }}">
@endpush
