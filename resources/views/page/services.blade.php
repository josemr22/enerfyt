
@extends('layouts.page')
@section('content')

	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url({{asset('/page-img/bg-02.jpg')}});">
		<h2 class="ltext-105 cl0 txt-center">
			Nuestros Servicios
		</h2>
	</section>


    <!-- Content page -->
    <section class="bg0 p-t-75  p-r-20 p-l-20">
        <div class="container">
            <div class="row p-b-20">            
                <div class="card-columns">
                    @foreach ($services as $service)
                    <div class="card">
                        <img src="{{asset('/img/services/'.$service->image)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title titulo-servicio">{{$service->title}}</h5>
                          <p class="card-text">
                              <b></b>
                              {!!$service->content!!}
                          </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
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
    border-top-left-radius: calc(.25rem - 1px);
    border-top-right-radius: calc(.25rem - 1px);
    padding: 0.4rem !important;
    border-radius: 1.2rem !important;
    background-color: #e3851f !important;
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
           
</style>
@endpush