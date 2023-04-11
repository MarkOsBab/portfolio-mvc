@extends('dashboard.index')
@section('container')

<div class="container-fluid">
    <div class="mt-3 d-flex flex-wrap-reverse justify-content-between align-items-center">
        <h1>Formulario de edición</h1>
        <a href="{{ route('projects.index') }}" class="btn btn-primary"><i class="fa-solid fa-caret-left"></i> Volver</a>
    </div>
    <!-- Formulario de edición -->
    <form method="POST" action="{{ route('projects.update', $project->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('dashboard.fragments._errors-form')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required value="{{ $project->name }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $project->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="start_date">Fecha de inicio</label>
            <input type="date" class="form-control datepicker" id="start_date" name="start_date" value="{{ $project->start_date }}">
        </div>
        <div class="mb-3">
            <label for="end_date">Fecha de finalización</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $project->end_date }}">
        </div>
        <div class="mb-3">
            <label for="link">Enlace</label>
            <input type="text" class="form-control" id="link" name="link" value="{{ $project->link }}">
        </div>

        <!-- Agregar las imágenes existentes del proyecto -->
            <div class="mb-3">
                <h3>Imágenes del proyecto</h3>
                <div class="d-flex align-items-center flex-row">
                    @foreach($project->images as $image)
                    <div class="d-flex justify-content-center align-items-center flex-column p-3">
                        <div class="d-flex justify-content-center flex-row">
                            <img src="{{ asset('/images/projects/' . $image->filename) }}" alt="{{ $project->name }}" class="img-fluid img-thumbnail" style="max-width: 200px;">
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

        <button type="submit" class="btn btn-primary mt-3 mb-3">Actualizar</button>
    </form>
</div>

@endsection