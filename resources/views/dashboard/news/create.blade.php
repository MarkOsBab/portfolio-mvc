@extends('dashboard.index')
@section('container')
<div class="container-fluid">
    <div class="mt-3 d-flex flex-wrap-reverse justify-content-between align-items-center">
        <h1>Formulario de creación</h1>
        <a href="{{ route('news.index') }}" class="btn btn-primary"><i class="fa-solid fa-caret-left"></i> Volver</a>
    </div>
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <!-- Formulario de creación -->
    <form method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
        @csrf
        @include('dashboard.fragments._errors-form')
        <div class="mb-3">
            <label for="title" class="form-label">Titulo</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Contenido</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="visible">Visibilidad</label>
            <select class="form-select" id="visible" name="visible">
              <option selected>Seleccionar...</option>
              <option value="1">Visible</option>
              <option value="0">No visible</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Imágenes</label>
            <input class="form-control" type="file" id="formFile" name="images[]" accept="image/*" multiple required>
        </div>
        <button type="submit" class="btn btn-primary mt-3 mb-3">Guardar</button>
    </form>
</div>
@endsection