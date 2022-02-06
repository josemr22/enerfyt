<div class="card m-md-5">
    <div class="card-body">
        <form id="formSliderStore" method="POST" action="{{ route('sliders.store') }}" enctype="multipart/form-data">
            @include('admin.slider._fields')
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Crear Slider</button>
            </div>
        </form>
    </div>
</div>