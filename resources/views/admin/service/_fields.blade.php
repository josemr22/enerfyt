<div class="form-group">
    <label for="name">Título:</label>
    <input required type="text" class="form-control" name="title" id="title" value="{{ old('title', $service->title) }}">
</div>
<input type="hidden" class="form-control" name="content" id="body">
<div class="form-group">
    <label>Contenido:</label>
    <div id="wContent">
        {!!$service->content!!}
    </div> 
</div>
<div class="form-group">
    <label for="image">Imagen (400x290)</label>
    <input class="form-control" type="file" name="image" id="image">
</div>
@push('css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush
@push('scripts')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        var quill = new Quill('#wContent', {
            theme: 'snow'
        });
    </script>
    <script>
        function sendForm(formId){
            document.getElementById("body").value=quill.container.firstChild.innerHTML;
            $("#"+formId).submit();
        }
    </script>
@endpush