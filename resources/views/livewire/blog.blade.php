<div>
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
    {{-- The best athlete wants his opponent at his best. --}}
    <section class="bg0 p-t-62 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="p-r-45 p-r-0-lg">
                        <!-- item blog -->
                        @forelse($posts as $post)
                            <div class="p-b-63">
                                <a href="{{route('blog-single',$post)}}" class="hov-img0 how-pos5-parent">
                                    <img src="{{asset('img/posts/'.$post->image)}}" alt="IMG-BLOG">

                                    <div class="flex-col-c-m size-123 bg9 how-pos5">
									<span class="ltext-107 cl2 txt-center">
										{{$post->created_at->format('d')}}
									</span>

                                        <span class="stext-109 cl3 txt-center">
                                        {{$months[intval($post->created_at->format('m'))-1]}} {{$post->created_at->format('Y')}}
									</span>
                                    </div>
                                </a>

                                <div class="p-t-32">
                                    <h4 class="p-b-15">
                                        <a href="{{route('blog-single',$post)}}" class="ltext-108 cl2 hov-cl1 trans-04">
                                            {{$post->title}}
                                        </a>
                                    </h4>

                                    <p class="stext-117 cl6">
                                        {!!Str::limit($post->body, 300)!!}
                                    </p>

                                    <div class="flex-w flex-sb-m p-t-18">
									<span class="flex-w flex-m stext-111 cl2 p-r-30 m-tb-10">
										<span>
											<span class="cl4">&nbsp;&nbsp;</span> &nbsp;&nbsp;
											<span class="cl12 m-l-4 m-r-6">&nbsp;</span>
										</span>

										<span>
											&nbsp;&nbsp;
											<span class="cl12 m-l-4 m-r-6">&nbsp;</span>
										</span>

										<span>
											&nbsp;&nbsp;
										</span>
									</span>

                                        <a href="{{route('blog-single',$post)}}" class="stext-101 cl2 hov-cl1 trans-04 m-tb-10">
                                            Continuar leyendo

                                            <i class="fa fa-long-arrow-right m-l-9"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                    @empty
                        <div class="d-flex flex-column">
                            <div class="d-flex justify-content-center">
                                <img src="/page-img/icons/lupa.png" width="100px" alt="search">
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <h4>Sin resultados para la búsqueda...</h4>
                            </div>
                        </div>
                    @endforelse

                    <!-- Pagination -->
{{--                        <div class="flex-l-m flex-w w-full p-t-10 m-lr--7">--}}
{{--                            <a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">--}}
{{--                                1--}}
{{--                            </a>--}}

{{--                            <a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7">--}}
{{--                                2--}}
{{--                            </a>--}}

{{--                            <a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7">--}}
{{--                                3--}}
{{--                            </a>--}}

{{--                            <a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7">--}}
{{--                                4--}}
{{--                            </a>--}}

{{--                            <a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7">--}}
{{--                                5--}}
{{--                            </a>--}}

{{--                            <a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7">--}}
{{--                                6--}}
{{--                            </a>--}}

{{--                            <a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7">--}}
{{--                                7--}}
{{--                            </a>--}}
{{--                        </div>--}}
                        <div class="d-flex justify-content-center">
                            {{$posts->links()}}
                        </div>
                    </div>
                </div>
                @include('page.partials._side-blog',["single"=>false])
            </div>
        </div>
    </section>
</div>
