@extends('layouts.page')
@section('content')

	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url({{asset('/page-img/bg-02.jpg')}});">
		<h2 class="ltext-105 cl0 txt-center">
			Nuestra Empresa
		</h2>
	</section>


    <!-- Content page -->
    <section class="bg0 p-t-75 p-b-120">
        <div class="container">
            {{-- <div class="row p-b-100">
                <div class="col-12 col-md-5 col-lg-4 m-lr-auto p-b-30">
                    <div class=" m-b-5 ">
                        <div class="hov-img1" style="text-align: center;">
                            <img src="/page-img/gavit.png" alt="IMG">
                        </div>                        
                    </div>
                    <div class="p-t-1  p-r-0-md" style="text-align: center; padding: 1rem;">
                        <h3 class="mtext-111 cl2 p-b-5">
                            Gavit
                        </h3>
                        <h5 class="mtext-104 cl2 p-b-10">
                            Socia fundadora - Directora creativa
                        </h5>
                        <p class="stext-113 cl6 p-b-1">
                            Apasionada por el diseño de eventos, siempre creando diseños frescos y con esencia. 
                        </p>

                        <p class="stext-113 cl6 p-b-1">
                            Encargada del proceso creativo y de liderar la ejecución de los proyectos a su equipo. 
                        </p>

                        <p class="stext-113 cl6 p-b-1">
                            Cree firmemente en volcar sus conocimientos a su equipo, ya que es feliz de verlos desarrollándose creando una cultura de armonía, respeto. 
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-5 col-lg-4 m-lr-auto">
                    <div class=" m-b-5">
                        <div class="hov-img1" style="text-align: center;">
                            <img src="/page-img/carlos.png" alt="IMG">
                        </div>
                    </div>
                    <div class="p-t-1  p-r-0-md" style="text-align: center; padding: 1rem;">
                        <h3 class="mtext-111 cl2 p-b-5">
                            Carlos
                        </h3>
                        <h5 class="mtext-104 cl2 p-b-10">
                            Socio fundador
                        </h5>
                        <p class="stext-113 cl6 p-b-1">
                            Apasionada por el diseño de eventos, siempre creando diseños frescos y con esencia. 
                        </p>

                        <p class="stext-113 cl6 p-b-1">
                            Encargada del proceso creativo y de liderar la ejecución de los proyectos a su equipo. 
                        </p>

                        <p class="stext-113 cl6 p-b-1">
                            Cree firmemente en volcar sus conocimientos a su equipo, ya que es feliz de verlos desarrollándose creando una cultura de armonía, respeto. 
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-5 col-lg-4 m-lr-auto">
                    <div class=" m-b-5 ">
                        <div class="hov-img1" style="text-align: center;">
                            <img src="/page-img/jessica.png" alt="IMG">
                        </div>
                    </div>
                    <div class="p-t-1  p-r-0-md" style="text-align: center; padding: 1rem;">
                        <h3 class="mtext-111 cl2 p-b-5">
                            Jessica
                        </h3>
                        <h5 class="mtext-104 cl2 p-b-10">
                            Ejecutora
                        </h5>
                        <p class="stext-113 cl6 p-b-1">
                            Encargada de manejar el equipo de trabajo para el desarrollo del diseño.
                        </p>

                        <p class="stext-113 cl6 p-b-1">
                            Encargada del proceso creativo y de liderar la ejecución de los proyectos a su equipo. 
                        </p>

                        <p class="stext-113 cl6 p-b-1">
                            Cree firmemente en volcar sus conocimientos a su equipo, ya que es feliz de verlos desarrollándose creando una cultura de armonía, respeto. 
                        </p>
                    </div>
                </div>
            </div> --}}
            <div class="row p-b-148">
                <div class="col-md-7 col-lg-8">
                    <div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
                        <h3 class="mtext-111 cl2 p-b-16">
                            Sobre Nosotros
                        </h3>
                        <div id="about">
                            {!!$about->about!!}
                        </div>
                    </div>
                    <div class="p-t-7 p-r-85 p-r-15-lg p-l-15-lg p-l-0-md">                        
                        <h3 class="mtext-111 cl2 p-b-10">
                            Misión 
                        </h5>
                        <p class="stext-118 cl6 p-b-26">
                            {{$about->mision}}
                        </p>
                        <h3 class="mtext-111 cl2 p-b-10">
                            Visión
                        </h3>
                        <p class="stext-118 cl6 p-b-26">
                            {{$about->vision}}
                        </p>                        
                    </div>
                </div>

                <div class="col-11 col-md-5 col-lg-4 m-lr-auto" style="align-items: center;
                display: flex;">
                    <div class="how-bor1 ">
                        <div class="hov-img0">
                            <img src="{{asset('img/gallery/'.$about->about_image)}}" alt="IMG">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script>
        const myElement = document.getElementById('about');
        for (let i = 0; i < myElement.children.length; i++) {
            myElement.children[i].classList.add("stext-118");
            myElement.children[i].classList.add("cl6");
            myElement.children[i].classList.add("p-b-26");
        }
    </script>
@endpush
