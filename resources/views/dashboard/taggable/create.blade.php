@extends('dashboard.index')
@section('container')
<div class="container-fluid">
    <div class="mt-3 d-flex flex-wrap-reverse justify-content-between align-items-center">
        <h1>Seleccionar etiquetas</h1>
        <a href="{{ url('/dashboard/' . $taggableType) }}" class="btn btn-primary"><i class="fa-solid fa-caret-left"></i> Volver</a>
    </div>
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <!-- Formulario de selección de etiquetas -->
    <form method="POST" action="{{ route('taggable.store', ['taggableType' => $taggableType, 'taggableId' => $taggableId]) }}">
        @csrf
        @method('POST')
        @include('dashboard.fragments._errors-form')
        <div class="mb-3">
            <label for="tags" class="form-label">Etiquetas</label>
            <input type="hidden" name="taggableType" value="{{ $taggableType }}">
            <select class="form-select form-select-sm" id="tags" name="tags[]" multiple>
                @foreach($tags as $tag)
                    <option class="text-dark" value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3 mb-3">Agregar etiquetas</button>
    </form>
</div>
@endsection

@section('scripts')
    <script>
        var assignedTagIds = {!! json_encode($assignedTagIds) !!};
        $(document).ready(function() {
            $('#tags').val(assignedTagIds).select2({
                placeholder: 'Seleccionar etiquetas',
                allowClear: true,
                maximumSelectionLength: null,
            }).on('select2:unselecting', function() {
                $(this).data('unselecting', true);
            }).on('select2:opening', function(e) {
                if ($(this).data('unselecting')) {
                    $(this).removeData('unselecting');
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection
