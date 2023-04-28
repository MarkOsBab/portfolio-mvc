{{-- Listar errores --}}
@if ($errors->any())
    @foreach ($errors->all() as $e)
        <div class="bg-danger text-white p-3">
            {{ $e }}
        </div>
    @endforeach
@endif