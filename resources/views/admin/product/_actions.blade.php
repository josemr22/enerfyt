<form id="formTrashProduct{{$id}}" action="{{ route('products.trash', $id) }}" method="POST">
    @csrf
    @method('PATCH')
    {{-- <button
        type="button"
        onclick="modal('{{route('products.show', $id)}}','Detalle de Producto',900)"
        class="btn btn-outline-secondary btn-sm">
        <span class="oi oi-eye"></span>
    </button> --}}
    <button
        type="button"
        onclick="modal('{{route('products.edit', $id)}}','Editar Producto',1000)"
        class="btn btn-outline-secondary btn-sm">
        <span class="oi oi-pencil"></span>
    </button>
    <button
        title="Eliminar"
        onclick="deleteRegister('formTrashProduct{{$id}}','Product','¿Está seguro de eliminar el producto? El producto será enviado a la papelera de reciclaje')"
        type="button"
        class="btn btn-outline-danger btn-sm"><span class="oi oi-trash"></span>
    </button>
    &nbsp;&nbsp;
    {{-- <a href="{{ route('products-sizes.index', $id) }}" class="btn btn-outline-secondary btn-sm"><span class="oi oi-list"></span></a> --}}
    <a href="{{ route('images.create', $id) }}" class="btn btn-outline-secondary btn-sm"><span class="oi oi-image"></span></a>
</form>
