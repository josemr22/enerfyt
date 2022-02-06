@extends('layouts.page')
@section('content')
<!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url({{asset('/page-img/bg-02.jpg')}});">
        <h2 class="ltext-105 cl0 txt-center mt-5">
            Catálogo
        </h2>
    </section>
	@include('page.partials._banner',['view'=>''])
@endsection
