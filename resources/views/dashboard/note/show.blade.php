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
                            @if ($note)
                                <h1>Title: {{$note->title}}</h1>
                                <p>Description: {{$note->description}}</p>
                            @else
                                <p>No se encontró la nota solicitada.</p>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>