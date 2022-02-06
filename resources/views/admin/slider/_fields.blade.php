{{ csrf_field() }}

<div class="form-group">
    <span>Header</span>
    <input required name="header" type="text" class="form-control" value="{{$slider->header}}">
</div>

<div class="form-group">
    <span>Título</span>
    <input required name="title" type="text" class="form-control" value="{{$slider->title}}">
</div>

<div class="form-group">
    <span>Botón</span>
    <input required name="button_title" type="text" class="form-control" value="{{$slider->button_title}}">
</div>

<div class="form-group">
    <span>Url</span>
    <input required name="button_url" type="text" class="form-control" value="{{$slider->button_url}}">
</div>

<div class="form-group">
    <span>Imagen (1920x1080)</span>
    <input {{$slider->image ? '' : 'required'}} name="image" type="file" class="form-control" value="{{$slider->image}}">
</div>

