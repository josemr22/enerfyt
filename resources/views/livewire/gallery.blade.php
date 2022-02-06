<div class="card-body">
    <div>
        <div class="shadow mb-4 p-3">
            <div class="form-inline">
                <div class="form-row">
                    <input type="file" wire:model="file" class="form-control">
                </div>
                <button class="ml-3 btn btn-primary" wire:click="store" wire:target="file" wire:loading.attr="disabled">Crear</button>
            </div>
            @error('file') <span class="text-danger">{{$message}}</span> @enderror
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="text-center">Imagen</th>
                    <th class="text-center">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td class="text-center"><img src="{{asset('img/gallery/'.$item->image)}}" width="150px" alt="gallery">
                    </td>
                    <td class="text-center">
                        <button title="Eliminar" type="button" class="btn btn-outline-danger btn-sm"
                        wire:click="remove({{$item->id}})">
                            <span class="oi oi-trash"></span>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>