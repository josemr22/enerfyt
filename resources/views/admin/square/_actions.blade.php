<form id="formDeleteSquare{{$id}}" action="{{ route('squares.destroy', $id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button 
    type="button"
    onclick="modal('{{route('squares.show', $id)}}','Detalle del Movimiento')" class="btn btn-outline-secondary btn-sm">
    <span class="oi oi-eye"></span>
    </button>
    {{-- <button 
    type="button" 
    onclick="deleteRegister('formDeleteSquare{{$id}}','Movimiento')" 
    class="btn btn-outline-danger btn-sm">
    <span class="oi oi-trash"></span>
    </button> --}}
</form>