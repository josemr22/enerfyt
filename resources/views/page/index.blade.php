@extends('layouts.page')
@push('css')
<style>
    .titulo-servicio{
        font-weight: 600 !important;
        color: #7d2f02cc  !important;
    }

    @media screen and (max-width: 1680px) {
        .card-columns {
            column-count: 4;
        }
    }  
    @media screen and (max-width: 1250px) {
        .card-columns {
            column-count: 3;
        }
    }        
    @media screen and (max-width: 900px) {
        .card-columns {
            column-count: 1;
        }
    }
    .card-img-top {
    width: 100%;
    /* border-top-left-radius: calc(.25rem - 1px); */
    /* border-top-right-radius: calc(.25rem - 1px); */
    padding: 1rem !important;
    /* margin: .5 */
    border-radius: 2.2rem !important;
    /* background-color: #e3851f !important; */
    }

    .card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #e3851f !important;
    background-clip: border-box !important;
    border: 1px solid rgb(0 0 0 / 0%) !important;
    border-radius: 1.2rem !important;
    color: white !important;
    }

    @media (min-width: 576px) {
        .card-columns .card {
        display: inline-block;
        width: 100%;
        border-radius: 1.2rem;
        background-color: #e3851f;
        color: white;
        border: 1px solid rgb(0 0 0 / 0%);
        }
    }
    .slick-list{
        border-radius: 1rem !important;
    }
    .div-imagen {
  display:inline-block;
  position:relative;
}

.div-imagen .divfade {
    display: none;
    position: absolute;
    bottom: 1rem;
    left: 1rem;
    z-index: 10;
    background: rgba(0, 0, 0, 0.5);
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#50000000,endColorstr=#50000000);
    width: 80%;
    color: #FFF;
    padding: 10px;
    border-radius: 0rem .5rem 0rem .5rem;
}
.div-imagen:hover .divfade {
display: block;
}

.desvanecer:hover {
  opacity: 0.37;
  -webkit-transition: opacity 500ms;
  -moz-transition: opacity 500ms;
  -o-transition: opacity 500ms;
  -ms-transition: opacity 500ms;
  transition: opacity 500ms;
}
</style>
@livewireStyles
@endpush
@section('content')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v8.0" nonce="kKuMexwK"></script>

    <!-- Slider -->
    @if(count($sliders)>=1)
    <section class="section-slide">
        <div class="wrap-slick1 rs1-slick1">
            <div class="slick1">
                @foreach ($sliders as $slider)
                <div class="item-slick1" style="background-image: url(img/sliders/{{$slider->image}}); z-index:100 !important">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30">
                            <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-202 cl2 respon2">
									{{$slider->header}}
								</span>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                                <h2 class="ltext-104 cl2 p-t-19 p-b-43 respon1">
                                    {{$slider->title}}
                                </h2>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                                <a href="{{$slider->button_url}}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                    {{$slider->button_title}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <section class="bg0 p-t-104 " style="z-index: 1000 !important; margin-top:-12rem !important;">
		<div class="container">
            
			<div class="flex-w flex-tr style="z-index: 1000 !important"">
                <div class=" size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md" style="z-index: 1000 !important;background-color:orange !important;">
					<div class="flex-w w-full p-b-42" style="z-index: 1000 !important">
						<span class="fs-18 cl0 txt-center size-211">
							<span><i class="fas fa-map-marker"></i></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl0">
								Dirección
							</span>

							<p class="stext-115 cl0 size-213 p-t-18">
                                Calle Juan Cuglievan 310, <br>
                                Cercado de Chiclayo – Chiclayo – Lambayeque.
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42" style="z-index: 1000 !important">
						<span class="fs-18 cl0 txt-center size-211">
							<span><i class="fas fa-phone-alt"></i></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl0">
								Llámanos
							</span>

							<p class="stext-115 cl0 size-213 p-t-18">
                                940 522 696
							</p>
						</div>
					</div>

					{{-- <div class="flex-w w-full p-b-42" style="z-index: 1000 !important">
						<span class="fs-18 cl0 txt-center size-211">
							<span><i class="fas fa-envelope"></i></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl0">
								Soporte de Ventas
							</span>

							<p class="stext-115 cl0 size-213 p-t-18">
                                consultas@enerfytsalud.com
                            </p>
						</div>
					</div> --}}
                    <div class="flex-w w-full p-b-42" style="z-index: 1000 !important">
						<span class="fs-18 cl0 txt-center size-211">
							<span><i class="fas fa-clock"></i></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl0">
								Horario de atención
							</span>

							<p class="stext-115 cl0 size-213 p-t-18">
                                Lunes a Viernes de 9am A 9pm <br>
                                Sábado de 9am a 2pm
                            </p>
						</div>
					</div>
				</div>

				@livewire('contact',['type'=>$typeMessage])

			</div>
		</div>
	</section>

    <section class="bg0 p-t-100 p-b-40 p-r-20 p-l-20">
        <div class="container-fluid row" style="margin: 0 !important">
            <div class="col-12 col-lg-3" style="display: flex;flex-direction: column;flex-wrap: wrap;align-content: space-around;align-items: center;justify-content: space-evenly;">
                <img class="d-none d-sm-none d-md-block" src="{{ asset('page-img/icons/favicon.png') }}"  alt="">
            </div>
            <div class="col-12 col-lg-9" style="display: flex;flex-direction: column;flex-wrap: nowrap;align-content: space-between;justify-content: space-between;">
                <h3 class="mtext-111 cl2 p-b-16">
                    Nuestros Servicios
                </h3>
                <div class="center-2" style="border-radius:5rem !important;">
                    
                    @foreach ($services as $service)
                        <div class="div-imagen" style="background-color: #e3851f; ">
                            <div class="divfade">
                                {{$service->title}}
                            </div>
                            <a href="{{ route('services') }}">                                
                                <img class="desvanecer" src="{{asset('/img/services/'.$service->image)}}" style="width: 100%; padding: 1rem;border-radius:1.5rem;">                                
                                    {{-- <h5 class="d-none d-sm-none d-md-block" style="padding: 1rem !important; color: white !important;">{{$service->title}}</h5>                                 --}}
                            </a>
                        </div>
                    @endforeach
                                
                </div>
            </div>
        </div>
        
    </section>

    <!-- Banner -->
    {{-- @include('page.partials._banner',['view'=>'index']) --}}


    <!-- Product -->
    {{-- <section class="sec-product bg0 p-t-100 p-b-50">
        <div class="container">
            <div class="p-b-32">
                <h3 class="ltext-105 cl5 txt-center respon1">
                    Productos Destacados
                </h3>
            </div>

            @include('page.partials._card-slider',['products' => $destacated, 'showModal'=>'showModalFeatured','modal'=>true])
        </div>
    </section> --}}
    {{-- Galería --}}
    <section class="bg0 p-t-100 p-b-40 p-r-20 p-l-20">
        <div class="container">
            <h3 class="mtext-111 cl2 p-b-16">
                Nuestra Galería
            </h3>
        </div>
        <div class="container center">
            
            @foreach ($galleries as $item)
            <div>
                <a href="/img/gallery/{{$item->image}}" data-lightbox="mygallery">
                <img src="/img/gallery/{{$item->image}}" style="width: 100%; padding: 1rem;" class="card-img-top"></a>
            </div>
            @endforeach
                        
        </div>
    </section>

    


@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="/css/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/css/slick/slick-theme.css"/>
    <link rel="stylesheet" type="text/css" href="/css/ligthbox/lightbox.css"/>

    <script type="text/javascript" src="/js/slick/slick.js"></script>
    <script type="text/javascript" src="/js/slick/slick.min.js"></script>
    <script type="text/javascript" src="/js/ligthbox/lightbox.js"></script>

    <script type="text/javascript" src="/js/ligthbox/lightbox-plus-jquery.js"></script>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>    
@endpush
@push('scripts')
    <script>
        function showModalFeatured(id){
            let element = '#showModalFeatured'+id;
            $(element).addClass('show-modal1');
        }
    </script>
    <script>
        $('.center').slick({
            centerMode: true,
            autoplay: true,
            centerPadding: '60px',
            slidesToShow: 3,
            responsive: [
                {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
                },
                {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
                }
            ]
        });
     
    </script>
    <script>
        $('.center-2').slick({
            // centerMode: true,
            lazyLoad: 'ondemand',
            autoplay: true,
            
            // centerPadding: '80px',

            // fade: true,
            slidesToShow: 3,            
            arrows: false,
            // adaptiveHeight: true,
            // variableWidth: true,
            responsive: [
                {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
                },
                {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    vertical: true,
                    verticalSwiping: true,
                    centerMode: true,
                    centerPadding: '100px',
                    slidesToShow: 1
                }
                }
            ]
        });
     
    </script>
    <script>
        lightbox.option({
          'alwaysShowNavOnTouchDevices': true,
          'resizeDuration': 200,
          'wrapAround': true,
          'positionFromTop': 100
        });
    </script>
    @livewireScripts
    <script>
        Livewire.on('alertSuccess', (params) => {
            swal('Mensaje Enviado! ', "Nos contactaremos contigo a la brevedad", "success");
            const url = `https://api.whatsapp.com/send?phone=51935911306&text=${params.msg}`;
			window.open(url, '_blank');
        });
    </script>
@endpush




