	@extends('layouts.page')
    @section('content')
        <!-- Title page -->
        <section class="bg-img1 txt-center p-lr-15 p-tb-92 mb-2 mb-md-5" style="background-image: url({{asset('page-img/bg-02.jpg')}});">
            <h2 class="ltext-105 cl0 txt-center">
                Mi Carrito
            </h2>
        </section>
    <!-- Shoping Cart -->
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto" id="tableCart">

				</div>
		    </div>
        </div>
    @endsection
    @push('scripts')
        <script src="{{ asset('js/custom/shoping-cart.js') }}"></script>
    @endpush



