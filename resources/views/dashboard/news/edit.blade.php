@extends('dashboard.index')
@section('container')

<div class="container-fluid">
    <div class="mt-3 d-flex flex-wrap-reverse justify-content-between align-items-center">
        <h1>Formulario de edición</h1>
        <a href="{{ route('news.index') }}" class="btn btn-primary"><i class="fa-solid fa-caret-left"></i> Volver</a>
    </div>
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <!-- Formulario de edición -->
    <form method="POST" action="{{ route('news.update', $news->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('dashboard.fragments._errors-form')
        <div class="mb-3">
            <label for="title" class="form-label">Titulo</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $news->title }}" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Contenido</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ $news->content }}</textarea>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="visible">Visibilidad</label>
            <select class="form-select" id="visible" name="visible">
                <option value="1" {{ $news->visible == 1 ? 'selected' : '' }}>Visible</option>
                <option value="0" {{ $news->visible == 0 ? 'selected' : '' }}>No visible</option>
            </select>
        </div>
        <!-- Agregar las imágenes existentes del proyecto -->
        <div class="mb-3">
            <h3>Imágenes del proyecto</h3>
            <div class="d-flex align-items-center flex-row">
                @foreach($news->images as $image)
                <div class="d-flex justify-content-center align-items-center flex-column p-3">
                    <div class="d-flex justify-content-center flex-row">
                        <img src="{{ asset('/images/news/' . $image->filename) }}" alt="{{ $news->name }}" class="img-fluid img-thumbnail" style="max-width: 200px;">
                    </div>
                    <div>
                        <input type="checkbox" id="deleted_images_{{$image->id}}" name="deleted_images[]" value="{{ $image->id }}">
                        <label for="deleted_images_{{$image->id}}" class="form-label">Eliminar</label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Agregar la posibilidad de subir nuevas imágenes -->
        <div class="mb-3">
            <label for="images">Imágenes</label>
            <input type="file" class="form-control" name="images[]" multiple accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary mt-3 mb-3">Guardar</button>
    </form>
</div>
@endsection