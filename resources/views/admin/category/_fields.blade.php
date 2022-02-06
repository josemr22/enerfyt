<div class="form-group">
    <label for="name">Nombre:</label>
    <input required type="text" class="form-control" name="name" id="name" value="{{ old('name', $category->name) }}">
</div>
<div class="form-group">
    <label for="file">Imagen</label>
    <input {{$category->image ? '' : 'required'}} type="file" name="file" id="file">
</div>
