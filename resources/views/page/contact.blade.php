@extends('layouts.page')
@push('css')
    @livewireStyles
@endpush
@section('content')
    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url({{asset('page-img/bg-02.jpg')}});">
        <h2 class="ltext-105 cl0 txt-center">
            Contáctanos
        </h2>
    </section>
	<!-- Content page -->
	<section class="bg0 p-t-104 p-b-116">
		<div class="container">
			<div class="flex-w flex-tr">
				@livewire('contact',['type'=>$typeMessage])

				<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span><i class="fas fa-map-marker"></i></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Dirección
							</span>

							<p class="stext-115 cl5 size-213 p-t-18">
                                Calle Juan Cuglievan 310, <br>
                                Cercado de Chiclayo – Chiclayo – Lambayeque.
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span><i class="fas fa-phone-alt"></i></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Llámanos
							</span>

							<p class="stext-115 cl2 size-213 p-t-18">
                                940 522 696
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span><i class="fas fa-envelope"></i></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Soporte de Ventas
							</span>

							<p class="stext-115 cl2 size-213 p-t-18">
                                consultas@enerfytsalud.com
                            </p>
						</div>
					</div>
                    <div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span><i class="fas fa-clock"></i></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Horario de atención
							</span>

							<p class="stext-115 cl2 size-213 p-t-18">
                                Lunes a Viernes de 9am A 9pm <br>
                                Sábado de 9am a 2pm
                            </p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

    <!-- Map -->
    <!-- Política de Calidad -->
        <div class="container pt-5">
                <div class="p-b-45">
                    <h3 class="ltext-106 cl5">
                        Ubícanos en Google Maps.
                    </h3>
                </div>
        </div>
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.960467984864!2d-79.84295848470042!3d-6.774666268135442!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x904cef289dbcaad3%3A0x2ce50e54b964cd68!2sCalle%20Juan%20Cuglievan%20310%2C%20Chiclayo%2014001!5e0!3m2!1ses-419!2spe!4v1619829350646!5m2!1ses-419!2spe" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>    </div>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        Livewire.on('alertSuccess', (params) => {
            swal('Mensaje Enviado! ', "Nos contactaremos contigo a la brevedad", "success");
			const url = `https://api.whatsapp.com/send?phone=51940522696&text=${params.msg}`;
			window.open(url, '_blank');
        });
    </script>
@endpush



