<div class="row isotope-grid">
    @foreach($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
            <!-- Block2 -->
            <div class="block2">
                <div class="block2-pic hov-img0">
                    <img src="/img/products/{{count($product->images)>0 ? $product->images->first()->name : 'without-image.jpg'}}" alt="IMG-PRODUCT">

                    <a href="#" onclick="{{$showModal}}({{$product->id}});return false;" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                        Vista Rápida
                    </a>
                </div>

                <div class="block2-txt flex-w flex-t p-t-14">
                    <div class="block2-txt-child1 flex-col-l ">
                        <a href="{{ route('product-detail',$product) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                            {{ $product->name }}
                        </a>

                        <span class="stext-105 cl3">
                            S/ {{ number_format($product->price, 2) }}
                        </span>
                    </div>

                    {{-- <div class="block2-txt-child2 flex-r p-t-3">
                        <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                            <img class="icon-heart1 dis-block trans-04" src="/page-img/icons/icon-heart-01.png" alt="ICON">
                            <img class="icon-heart2 dis-block trans-04 ab-t-l" src="/page-img/icons/icon-heart-02.png" alt="ICON">
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="wrap-modal1 js-modal1 p-t-60 p-b-20" id="{{$showModal}}{{$product->id}}">
            <div class="overlay-modal1 js-hide-modal1"></div>
            <div class="container">
                <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                    <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                        <img src="{{asset('page-img/icons/icon-close.png')}}" alt="CLOSE">
                    </button>

                    <div class="row">
                        @include('page.partials._detail',['product'=>$product])
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
