<div class="form-group">
    <label for="name">Nombre:</label>
    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $color->name) }}">
</div>
<div class="form-group">
    <label for="name">Código Hexadecimal del Color:</label>
    <input type="text" class="form-control" name="code" id="code" value="{{ old('code', $color->code) }}">
</div>

