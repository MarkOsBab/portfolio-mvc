{{-- Listar errores --}}
@if ($errors->any())
    @foreach ($errors->all() as $e)
        <div class="bg-danger text-white">
            {{ $e }}
        </div>
    @endforeach
@endif