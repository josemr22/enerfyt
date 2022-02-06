@extends('layouts.admin')
@push('css')
    @livewireStyles
@endpush
@section('content')
<!-- Title page -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-end">
        <h5 class="m-0 font-weight-bold text-primary">Mi Galería</h5>
    </div>
    @livewire('gallery') 
</div>
<!-- Content page -->
@endsection
@push('scripts')
    @livewireScripts
@endpush