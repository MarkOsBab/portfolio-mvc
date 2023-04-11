@extends('dashboard.index')
@section('container')
<div class="container-fluid">
    <h1>Formulario de creación</h1>
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <!-- Formulario de creación -->
    <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data">
        @csrf
        @include('dashboard.project.fragments._errors-form')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="start_date">Fecha de inicio</label>
            <input type="date" class="form-control datepicker" id="start_date" name="start_date">
        </div>
        <div class="mb-3">
            <label for="end_date">Fecha de finalización</label>
            <input type="date" class="form-control" id="end_date" name="end_date">
        </div>
        <div class="mb-3">
            <label for="link">Enlace</label>
            <input type="text" class="form-control" id="link" name="link">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Imágenes</label>
            <input class="form-control" type="file" id="formFile" name="images[]" accept="image/*" multiple required>
          </div>
        <button type="submit" class="btn btn-primary mt-3 mb-3">Guardar</button>
    </form>
</div>
@endsection