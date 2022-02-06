<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <input type="text" class="form-control my-3" placeholder="Buscar Producto" wire:model.debounce.400ms="search">
                <div class="table-responsive">
                    @if ($search!=null && $search!='')
                    <table class="table table-sm table-bordered" width="100%" cellspacing="0">
                        <thead class="">
                        <tr>
                            <th>Nombre</th>
                            <th class="text-center th-actions">Agregar</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>
                                        {{ $product->name }}
                                    </td>
                                    <td class="text-center">
                                        <form>
                                            <button 
                                                wire:click="up({{$product->id}})"
                                                type="button" 
                                                class="btn btn-outline-success btn-sm">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="2">Sin resultados</td>
                            @endforelse
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-end">
                <h5 class="m-0 font-weight-bold text-primary">Novedades</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th class="text-center th-actions">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($novelties as $novelty)
                            <tr>
                                <td>
                                    {{ $novelty->code }}
                                </td>
                                <td>
                                    {{ $novelty->name }}
                                </td>
                                <td class="text-center">
                                    <form>
                                        <button 
                                            type="button" 
                                            wire:click="down({{$novelty->id}})"
                                            class="btn btn-outline-danger btn-sm">
                                            <span class="oi oi-trash"></span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="lead">No hay novedades</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
