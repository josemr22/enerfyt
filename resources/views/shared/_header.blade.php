<header class="header-v2">
    <!-- Header desktop -->
    <div class="container-menu-desktop trans-03">
        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop p-l-45">

                <!-- Logo desktop -->
                <a href="{{ route('index') }}" class="logo">
                    <img src="/page-img/icons/logo-01.png" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li>
                            <a href="{{ route('index') }}">Home</a>
                        </li>

                        <li>
                            <a href="{{ route('about') }}">Nosotros</a>
                        </li>

                        {{-- <li>
                            <a href="{{ route('allCatalog') }}">Catálogo</a>
                            <ul class="sub-menu">
                                @foreach($categories as $category)
                                    <li><a href="{{route('catalog',$category)}}">{{$category->name}}</a></li>
                                @endforeach
                            </ul>
                        </li> --}}
                        <li>
                            <a href="{{ route('services') }}">Servicios</a>
                        </li>
                        <li>
                            <a href="{{ route('blog') }}">Blog</a>
                        </li>

                        <li>
                            <a href="{{ route('contact') }}">Contacto</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m h-full">
                   

                    {{-- <div class="flex-c-m h-full p-l-18 p-r-25 bor5">
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" :data-notify="qty" id="quantityCart1">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>
                    </div> --}}

                    <div class="flex-c-m h-full p-lr-19">
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-sidebar">
                            <i class="zmdi zmdi-menu"></i>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="{{ route('index') }}"><img src="/page-img/icons/logo-01.png" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m h-full m-r-15">            

            {{-- <div class="flex-c-m h-full p-lr-10 bor5">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" :data-notify="qty" id="quantityCart2">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>
            </div> --}}
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="main-menu-m">
            <li>
                <a href="{{ route('index') }}">Home</a>
            </li>

            <li>
                <a href="{{ route('about') }}">Nosotros</a>
            </li>

            {{-- <li>
                <a href="{{ route('allCatalog') }}">Catálogo</a>
                <ul class="sub-menu-m" style="display: none;">
                    @foreach($categories as $category)
                        <li><a href="{{route('catalog',$category)}}">{{$category->name}}</a></li>
                    @endforeach
                </ul>
                <span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
            </li> --}}
            <li>
                <a href="{{ route('services') }}">Servicios</a>
            </li>
            <li>
                <a href="{{ route('blog') }}">Blog</a>
            </li>
            <li>
                <a href="{{ route('contact') }}">Contacto</a>
            </li>
        </ul>
    </div>
</header>
