<div class="col-md-4 col-lg-3 p-b-80">
    <div class="side-menu">
        @if (!$single)
        <div class="bor17 of-hidden pos-relative">
            <input autocomplete="off" wire:model="search" class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="search" placeholder="Search">

            <button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04">
                <img wire:loading wire:target="search" src="/page-img/icons/load.gif" alt="load" width="60%">
            </button>
        </div>
        @endif


        <div class="p-t-55">
            <h4 class="mtext-112 cl2 p-b-33">
                Categorías
            </h4>

            <ul>
                @foreach($categoryPosts as $categoryPost)
                    <li class="bor18">
                        @if ($single)
                            <a href="{{ route('blog').'?category='.$categoryPost->id }}" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
                                {{$categoryPost->name}}
                            </a>
                        @else
                            <button wire:click="filter({{$categoryPost->id}})" class="{{$category==$categoryPost->id ? 'text-primary' : ''}} dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
                                {{$categoryPost->name}}<img wire:loading wire:target="filter({{$categoryPost->id}})" src="/page-img/icons/load.gif" alt="load" width="25px">
                            </button>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>


        {{-- <div class="p-t-65">
            <h4 class="mtext-112 cl2 p-b-33">
                Productos Destacados
            </h4>

            <ul>
                @foreach($products as $product)
                    <li class="flex-w flex-t p-b-30">
                        <a href="{{route('product-detail',$product)}}" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
                            <img src="{{asset(count($product->images)>0 ? 'img/products/'.$product->images->first()->name : 'img/products/without-image.jpg')}}" width="100%" alt="PRODUCT">
                        </a>

                        <div class="size-215 flex-col-t p-t-8">
                            <a href="{{route('product-detail',$product)}}" class="stext-116 cl8 hov-cl1 trans-04">
                                {{$product->name}}
                            </a>

                            <span class="stext-116 cl6 p-t-20">
											S/ {{number_format($product->price,2)}}
										</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div> --}}

        {{--                    <div class="p-t-55">--}}
        {{--                        <h4 class="mtext-112 cl2 p-b-20">--}}
        {{--                            Archive--}}
        {{--                        </h4>--}}

        {{--                        <ul>--}}
        {{--                            <li class="p-b-7">--}}
        {{--                                <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">--}}
        {{--										<span>--}}
        {{--											July 2018--}}
        {{--										</span>--}}

        {{--                                    <span>--}}
        {{--											(9)--}}
        {{--										</span>--}}
        {{--                                </a>--}}
        {{--                            </li>--}}

        {{--                            <li class="p-b-7">--}}
        {{--                                <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">--}}
        {{--										<span>--}}
        {{--											June 2018--}}
        {{--										</span>--}}

        {{--                                    <span>--}}
        {{--											(39)--}}
        {{--										</span>--}}
        {{--                                </a>--}}
        {{--                            </li>--}}

        {{--                            <li class="p-b-7">--}}
        {{--                                <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">--}}
        {{--										<span>--}}
        {{--											May 2018--}}
        {{--										</span>--}}

        {{--                                    <span>--}}
        {{--											(29)--}}
        {{--										</span>--}}
        {{--                                </a>--}}
        {{--                            </li>--}}

        {{--                            <li class="p-b-7">--}}
        {{--                                <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">--}}
        {{--										<span>--}}
        {{--											April  2018--}}
        {{--										</span>--}}

        {{--                                    <span>--}}
        {{--											(35)--}}
        {{--										</span>--}}
        {{--                                </a>--}}
        {{--                            </li>--}}

        {{--                            <li class="p-b-7">--}}
        {{--                                <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">--}}
        {{--										<span>--}}
        {{--											March 2018--}}
        {{--										</span>--}}

        {{--                                    <span>--}}
        {{--											(22)--}}
        {{--										</span>--}}
        {{--                                </a>--}}
        {{--                            </li>--}}

        {{--                            <li class="p-b-7">--}}
        {{--                                <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">--}}
        {{--										<span>--}}
        {{--											February 2018--}}
        {{--										</span>--}}

        {{--                                    <span>--}}
        {{--											(32)--}}
        {{--										</span>--}}
        {{--                                </a>--}}
        {{--                            </li>--}}

        {{--                            <li class="p-b-7">--}}
        {{--                                <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">--}}
        {{--										<span>--}}
        {{--											January 2018--}}
        {{--										</span>--}}

        {{--                                    <span>--}}
        {{--											(21)--}}
        {{--										</span>--}}
        {{--                                </a>--}}
        {{--                            </li>--}}

        {{--                            <li class="p-b-7">--}}
        {{--                                <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">--}}
        {{--										<span>--}}
        {{--											December 2017--}}
        {{--										</span>--}}

        {{--                                    <span>--}}
        {{--											(26)--}}
        {{--										</span>--}}
        {{--                                </a>--}}
        {{--                            </li>--}}
        {{--                        </ul>--}}
        {{--                    </div>--}}

        {{--                    <div class="p-t-50">--}}
        {{--                        <h4 class="mtext-112 cl2 p-b-27">--}}
        {{--                            Tags--}}
        {{--                        </h4>--}}

        {{--                        <div class="flex-w m-r--5">--}}
        {{--                            <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">--}}
        {{--                                Fashion--}}
        {{--                            </a>--}}

        {{--                            <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">--}}
        {{--                                Lifestyle--}}
        {{--                            </a>--}}

        {{--                            <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">--}}
        {{--                                Denim--}}
        {{--                            </a>--}}

        {{--                            <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">--}}
        {{--                                Streetstyle--}}
        {{--                            </a>--}}

        {{--                            <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">--}}
        {{--                                Crafts--}}
        {{--                            </a>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
    </div>
</div>