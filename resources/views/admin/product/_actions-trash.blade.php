<form id="formDestroyProduct{{$id}}" action="{{ route('products.destroy', $id) }}" method="POST">
    @csrf
    @method('DELETE')
    <a href="{{route('products.restore', $id)}}" type="button" class="btn btn-outline-success btn-sm"><span class="fas fa-trash-restore"></span></a>
    <button
        title="Eliminar"
        onclick="deleteRegister('formDestroyProduct{{$id}}','Product','¿Está seguro de eliminar el producto? No podrá ser recuperado más tarde')"
        type="button"
        class="btn btn-outline-danger btn-sm"><span class="oi oi-circle-x"></span>
    </button>
</form>
