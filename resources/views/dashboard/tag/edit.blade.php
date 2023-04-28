@extends('dashboard.index')
@section('container')

<div class="container-fluid">
    <div class="mt-3 d-flex flex-wrap-reverse justify-content-between align-items-center">
        <h1>Formulario de edición</h1>
        <a href="{{ route('dashboard') }}" class="btn btn-primary"><i class="fa-solid fa-caret-left"></i> Volver</a>
    </div>
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <!-- Formulario de edición -->
    <form method="POST" action="{{ route('tags.update', $tag->id) }}">
        @csrf
        @method('PUT')
        @include('dashboard.fragments._errors-form')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $tag->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3 mb-3">Actualizar</button>
    </form>
</div>
@endsection