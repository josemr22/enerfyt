{{ csrf_field() }}

<div class="form-group">
    <label for="code">Código de Producto:</label>
    <input type="text" class="form-control" name="code" id="code" value="{{ old('code', $product->code) }}">
</div>

<div class="form-group">
    <label for="name">Nombre:</label>
    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $product->name) }}">
</div>

<div class="form-group">
    <label for="description">Descripción:</label>
    <textarea type="text" class="form-control" name="description" id="description" rows="3">{{ $product->description }}</textarea>
</div>

<div class="form-group">
    <label for="price">Precio (S/):</label>
    <input type="number" step=0.01 class="form-control" name="price" id="price" value="{{ number_format(old('price', $product->price),2) }}">
</div>

<div class="form-group">
    <label for="category_id">Categoría</label>
    <select name="category_id" id="category_id" class="form-control">
        <option value="">Selecciona una categoría</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}"{{ old('category_id', $product->category_id) == $category->id ? ' selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

