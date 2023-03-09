{{-- Generar tóken para evitar ataques csfr --}}
@csrf
@isset($note)
    <input type="hidden" name="id" value="{{ $note->id }}">
@endisset
<label for="title">Title</label>
<input class="form-control" type="text" name="title" value="{{old('title', $note->title)}}">

<label for="">Description</label>
<textarea name="description" cols="30" rows="10" class="form-control">{{old('description', $note->description)}}</textarea>


{{-- Enviamos el formulario --}}
<button type="submit">Submit</button>