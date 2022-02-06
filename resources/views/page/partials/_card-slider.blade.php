<!-- Related Products -->
        <!-- Slide2 -->
        <div class="wrap-slick2">
            <div class="slick2">
                @foreach($products as $product)
                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
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
                                    <a href="{{route('product-detail',$product)}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        {{$product->name}}
                                    </a>

                                    <span class="stext-105 cl3">
										S/ {{number_format($product->price,2)}}
									</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


@foreach($products as $product)
    <!-- Product Modal -->
    <div class="wrap-modal1 js-modal1 p-t-60 p-b-20" id="{{$showModal}}{{$product->id}}">
        <div class="overlay-modal1 js-hide-modal1"></div>
        <div class="container">
            <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                    <img src="/page-img/icons/icon-close.png" alt="CLOSE">
                </button>

                <div class="row">
                    @include('page.partials._detail',['product'=>$product,'modal'=>$modal])
                </div>
            </div>
        </div>
    </div>
@endforeach
