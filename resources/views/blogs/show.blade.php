<x-app-layout>
    <x-slot name="header">
        <div class="container d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $blog->title }}
                <br/>
                published at {{ $blog->created_at }}
            </h2>
            @role('admin')
            <a type="button" class="btn btn-outline-primary" href="{{ route('blogs.update', [$blog->id]) }}">Редактировать</a>
            @endrole
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Статья
                    </h2>
                    <hr>
                    <br/>
                    {{ $blog->body }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
