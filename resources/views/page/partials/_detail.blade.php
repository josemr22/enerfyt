<div class="col-md-6 col-lg-7 p-b-30">
    <div class="p-l-25 p-r-30 p-lr-0-lg">
        <div class="wrap-slick3 flex-sb flex-w">
            <div class="wrap-slick3-dots"></div>
            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

            <div class="slick3 gallery-lb">
                @forelse($product->images as $image)
                    <div class="item-slick3" data-thumb="/img/products/{{$image->name}}">
                        <div class="wrap-pic-w pos-relative">
                            <img src="/img/products/{{$image->name}}" alt="IMG-PRODUCT">

                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="/img/products/{{$image->name}}">
                                <i class="fa fa-expand"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="item-slick3" data-thumb="/img/products/without-image.jpg">
                        <div class="wrap-pic-w pos-relative">
                            <img src="/img//products/without-image.jpg" alt="IMG-PRODUCT">

                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="/img/products/without-image.jpg">
                                <i class="fa fa-expand"></i>
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="col-md-6 col-lg-5 p-b-30">
    <div class="p-r-50 p-t-5 p-lr-0-lg">
        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
            {{ $product->name }}
        </h4>

        <span class="mtext-106 cl2">
			S/ {{ number_format($product->price,2) }}
        </span>

        <p class="stext-102 cl3 p-t-23">
            {{$product->description}}
        </p>

        <!--  -->
        <div class="p-t-33">
            <div class="flex-w flex-r-m p-b-10">
                <div class="size-204 flex-w flex-m respon6-next">
                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                            <i class="fs-16 zmdi zmdi-minus"></i>
                        </div>

                        <input class="mtext-104 cl3 txt-center num-product" id="quantity{{$product->id}}" type="number" value="1">

                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                            <i class="fs-16 zmdi zmdi-plus"></i>
                        </div>
                    </div>

                    <button :disabled="cartLoading" type="button" @click="addItem({{$product->id}})" class="btnAdd flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                        Agregar al Carrito
                    </button>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div>
                    <a href="https://api.whatsapp.com/send?phone=51935911306&text=Estoy interesado en este producto: {{$product->name}}" target="_blank" class="btnAdd flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                        Pedir a través de whatsapp
                    </a>
                </div>
            </div>
        </div>

        <!--  -->
        <div class="flex-w flex-m p-l-100 p-t-40 respon7">
            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
                <i class="fa fa-facebook"></i>
            </a>

            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
                <i class="fa fa-twitter"></i>
            </a>

            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
                <i class="fa fa-google-plus"></i>
            </a>
        </div>
    </div>
</div>
