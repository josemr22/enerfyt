<div class="card m-md-5">
    <h4 class="card-header">Editar Producto</h4>
    <div class="card-body">
        <form id="formSliderUpdate" method="POST" action="{{ route('sliders.update', $slider) }}" enctype="multipart/form-data">
            {{ method_field('PUT') }}

            @include('admin.slider._fields')

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Actualizar alider</button>
            </div>
        </form>
    </div>
</div>