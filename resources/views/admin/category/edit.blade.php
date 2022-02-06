<div class="card m-md-5">
    <div class="card-body">
        @include('shared._errors')
        <form method="POST" action="{{ route('categories.update', $category) }}" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            @include('admin.category._fields')

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Actualizar categoría</button>
            </div>
        </form>
    </div>
</div>