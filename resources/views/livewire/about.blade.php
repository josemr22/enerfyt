<div>
    <div wire:model="asd" id="editor"></div>
    <div class="form-group">
        <label for="name">Misión:</label>
        <input type="text" class="form-control">
    </div>
    {{$asd}}
    <div class="form-group">
        <label for="name">Visión:</label>
        <input type="text" class="form-control">
    </div>
    <div class="form-group">
        <label for="name">Imagen:</label>
        <input type="file" class="form-control">
    </div>
</div>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
