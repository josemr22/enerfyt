@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-end">
        <h5 class="m-0 font-weight-bold text-primary">Categorías</h5>
        <button onclick="modal('{{route('categories.create')}}','Nueva Categoría',800)" class="btn btn-primary">Nueva Categoría</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="">
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Imagen</th>
                    <th scope="col" class="text-center th-actions">Acciones</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td class="text-center">{{ $category->id }}</td>
                            <th scope="row" class="text-center">
                                {{ $category->name }}
                            </th>
                            <td class="text-center"><img src="/img/categories/{{$category->image}}" alt="imagen-categoria" width="150px" class="border"></td>
                            <td class="text-center">
                                <form id="formDeleteCategory{{$category->id}}" action="{{ route('categories.destroy', $category) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a onclick="modal('{{route('categories.edit', $category)}}','Editar Categoría',800)" href="#!" class="btn btn-outline-secondary btn-sm"><span class="oi oi-pencil"></span></a>
                                    <button
                                    type="button"
                                    onclick="sendDelete('formDeleteCategory{{$category->id}}')"
                                    class="btn btn-outline-danger btn-sm">
                                    <span class="oi oi-trash"></span>
                                </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
