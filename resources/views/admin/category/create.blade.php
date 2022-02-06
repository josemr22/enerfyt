<div class="card m-md-5">
    <div class="card-body">
        @include('shared._errors')
        <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            @include('admin.category._fields')

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Registrar Categoría</button>
            </div>
        </form>
    </div>
</div>