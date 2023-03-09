{{-- Listar errores --}}
@if ($errors->any())
    @foreach ($errors->all() as $e)
        <div class="text-sm text-red-600">
            {{ $e }}
        </div>
    @endforeach
@endif