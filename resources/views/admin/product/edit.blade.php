<div class="card m-md-5">
    <div class="card-body">
        @include('shared._errors')
        <form id="formProductUpdate" method="POST" action="{{ route('products.update', $product) }}">
            {{ method_field('PUT') }}

            @include('admin.product._fields')

            <div class="form-group mt-4">
                <button type="button" onclick="update('Product')" class="btn btn-primary">Actualizar producto</button>
            </div>
        </form>
    </div>
</div>

