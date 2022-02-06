@extends('layouts.page')
@push('css')
    @livewireStyles
@endpush
@section('content')
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url({{asset('page-img/bg-02.jpg')}});">
    <h2 class="ltext-105 cl0 txt-center">
        Blog
    </h2>
</section>
<!-- Content page -->
@livewire('blog')
@endsection
@push('scripts')
    @livewireScripts
@endpush