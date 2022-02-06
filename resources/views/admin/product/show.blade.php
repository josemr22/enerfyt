<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <strong>{{ $product->name }}</strong>
            </div>
            <div class="card-body">
                <h5 class="card-title">Código de Producto: {{ $product->code }}</h5>
                <div class="card-text">
                    <p><strong>Precio</strong>: S/{{ number_format($product->price,2) }}</p>
                    <p><strong>Categoría</strong>: {{ $product->category->name }}</p>
                    <p><strong>Tallas:</strong></p>
                    @forelse($product->sizes as $size)
                        <p class="ml-4">{{ $size->name }}</p>
                    @empty
                        <p>Sin Tallas Asignadas</p>
                    @endforelse
                    <p><strong>Colores:</strong></p>
                    @forelse($product->colors as $color)
                        <p class="ml-4">{{ $color->name }}</p>
                    @empty
                        <p>Sin Colores Asignados</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3 mt-sm-5">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    Imágenes:
                </div>
                <div class="row card-body">
                    @forelse ($product->images as $image)
                        <div class="col-md-2">
                            <img src="{{ asset("img/products/$image->name") }}" alt="Image-Product" width="100%">
                        </div>
                    @empty
                        <span>Este producto no tiene imágenes asignadas.</span>
                    @endforelse
                </div>
            </div>
        </div>
</div>