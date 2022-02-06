@extends('layouts.page')
@section('meta')
    <meta property="og:url"           content="{{url()->current()}}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{$post->title}}" />
    <meta property="og:description"   content="{{Str::limit($post->body, 150)}}" />
    <meta property="og:image"         content="{{env('APP_URL').'/img/posts/'.$post->image}}" />
@endsection
@php
$months=[
    'enero',
    'febrero',
    'marzo',
    'abril',
    'mayo',
    'junio',
    'julio',
    'agosto',
    'septiembre',
    'octubre',
    'noviembre',
    'diciembre',
];
@endphp
@section('content')
    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{route('index')}}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{route('blog')}}" class="stext-109 cl8 hov-cl1 trans-04">
                Blog
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
				{{$post->title}}
			</span>
        </div>
    </div>


    <!-- Content page -->
    <section class="bg0 p-t-52 p-b-20">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="p-r-45 p-r-0-lg">
                        <!--  -->
                        <div class="wrap-pic-w how-pos5-parent">
                            <img src="{{asset('img/posts/'.$post->image)}}" alt="IMG-BLOG">

                            <div class="flex-col-c-m size-123 bg9 how-pos5">
								<span class="ltext-107 cl2 txt-center">
									{{$post->created_at->format('d')}}
								</span>

                                <span class="stext-109 cl3 txt-center">
									{{$months[intval($post->created_at->format('m'))-1]}} {{$post->created_at->format('Y')}}
								</span>
                            </div>
                        </div>

                        <div class="p-t-32">
{{--							<span class="flex-w flex-m stext-111 cl2 p-b-19">--}}
{{--								<span>--}}
{{--									<span class="cl4">By</span> Admin--}}
{{--									<span class="cl12 m-l-4 m-r-6">|</span>--}}
{{--								</span>--}}

{{--								<span>--}}
{{--									22 Jan, 2018--}}
{{--									<span class="cl12 m-l-4 m-r-6">|</span>--}}
{{--								</span>--}}

{{--								<span>--}}
{{--									StreetStyle, Fashion, Couple--}}
{{--									<span class="cl12 m-l-4 m-r-6">|</span>--}}
{{--								</span>--}}

{{--								<span>--}}
{{--									8 Comments--}}
{{--								</span>--}}
{{--							</span>--}}

                            <!-- Your share button code -->
                            <div class="d-flex">
                                <div class="fb-share-button"
                                     data-size="large"
                                     data-href="{{url()->current()}}"
                                     data-layout="button_count">
                                </div>
                            </div>

                            <h4 class="ltext-109 cl2 p-b-28">
                                {{$post->title}}
                            </h4>

                            <p class="stext-117 cl6 p-b-26">
                                {{$post->body}}
                            </p>
                        </div>

{{--                        <div class="flex-w flex-t p-t-16">--}}
{{--							<span class="size-216 stext-116 cl8 p-t-4">--}}
{{--								Tags--}}
{{--							</span>--}}

{{--                            <div class="flex-w size-217">--}}
{{--                                <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">--}}
{{--                                    Streetstyle--}}
{{--                                </a>--}}

{{--                                <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">--}}
{{--                                    Crafts--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <!--  -->
                        <div class="p-t-40">
                            <h5 class="mtext-113 cl2 p-b-12">
                                Deja un comentario
                            </h5>

                            {{--DISQUS--}}

                            <div id="disqus_thread"></div>

{{--                            <p class="stext-107 cl6 p-b-40">--}}
{{--                                Your email address will not be published. Required fields are marked *--}}
{{--                            </p>--}}

{{--                            <form>--}}
{{--                                <div class="bor19 m-b-20">--}}
{{--                                    <textarea class="stext-111 cl2 plh3 size-124 p-lr-18 p-tb-15" name="cmt" placeholder="Comment..."></textarea>--}}
{{--                                </div>--}}

{{--                                <div class="bor19 size-218 m-b-20">--}}
{{--                                    <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="name" placeholder="Name *">--}}
{{--                                </div>--}}

{{--                                <div class="bor19 size-218 m-b-20">--}}
{{--                                    <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="email" placeholder="Email *">--}}
{{--                                </div>--}}

{{--                                <div class="bor19 size-218 m-b-30">--}}
{{--                                    <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="web" placeholder="Website">--}}
{{--                                </div>--}}

{{--                                <button class="flex-c-m stext-101 cl0 size-125 bg3 bor2 hov-btn3 p-lr-15 trans-04">--}}
{{--                                    Post Comment--}}
{{--                                </button>--}}
{{--                            </form>--}}
                        </div>
                    </div>
                </div>

                @include('page.partials._side-blog',["single"=>true])
            </div>
        </div>
    </section>

    <script>
        /**
         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
        var disqus_config = function () {
            //this.page.url = 'http://127.0.0.1:8000/5';  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = 'blog-single' +{{$post->id}}; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://algarabia-1.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
@endsection
@push('scripts')
    <script id="dsq-count-scr" src="//algarabia-1.disqus.com/count.js" async></script>
    {{-- <script>
        document.getElementById("blogli").setAttribute("class", "active");
    </script> --}}
@endpush