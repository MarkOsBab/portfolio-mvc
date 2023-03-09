<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mt-4">
                        <h1>Create note</h1>
                        {{-- Llamamos la vista de errores --}}
                        @include('dashboard.note.fragments._errors-form')
                        {{-- Crear la ruta del formulario y el metodo --}}
                        <form action="{{ route('dashboard.note.store') }}" method="post">
                            @csrf
                            @include('dashboard.note.fragments._errors-form')
                            @isset($note)
                                <input type="hidden" name="id" value="{{ $note->id }}">
                            @endisset

                            <div class="p-6 flex flex-col">
                                <label for="title">Title</label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="title" value="{{old('title', $note->title ?? '')}}">
                            </div>

                            <div class="p-6 flex flex-col">
                                <label for="">Description</label>
                                <textarea name="description" cols="30" rows="10" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{old('description', $note->description ?? '')}}</textarea>
                            </div>

                            {{-- Enviamos el formulario --}}
                            <div>
                                <button class="bg-white text-gray-800 rounded p-4" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>