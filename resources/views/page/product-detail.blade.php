@extends('layouts.page')
@section('content')
    <!-- Product Detail -->
<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container">
        <div class="row">
            @include('page.partials._detail',['modal'=>false])
        </div>
    </div>

    <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
        <span class="stext-107  p-lr-25">
            Categoría: {{ $product->category->name }}
        </span>
    </div>
</section>

    <!-- Related Products -->
    <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-45">
                <h3 class="ltext-106 cl5">
                    Productos Relacionados
                </h3>
            </div>

            <!-- Slide Novedades -->
            @include('page.partials._card-slider',['products' => $relatedProducts, 'showModal'=>'showModalRelated','modal'=>true])
        </div>
    </section>
@endsection
@push('scripts')
    {{--    <script src="{{asset('js/wow.min.js')}}"></script>--}}
    {{--    <script>--}}
    {{--        new WOW().init();--}}
    {{--    </script>--}}
    <script>
        function showModalRelated(id){
            let element = '#showModalRelated'+id;
            $(element).addClass('show-modal1');
        }
    </script>
@endpush

