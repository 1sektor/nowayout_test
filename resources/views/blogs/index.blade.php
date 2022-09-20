<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Список блогов') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm  sm:rounded-lg">
                <div class="justify-between p-6 bg-white border-b border-gray-200">
                    <ul class="list-group">
                        @foreach($blogs as $blog)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a class="text-blue-500" href="{{route('blogs.show', ['blog' => $blog->id])}}">{{ $blog->id . ')' }} {{ $blog->title }}</a>
                            @role('admin')
                            <button type="button" class="btn btn-outline-danger" onClick="remove('{{ route('api.blogs.destroy', [$blog->id]) }}')">Удалить</button>
                            @endrole
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        function remove(url) {
            $.ajax({
                type: "DELETE",
                url: url,
                dataType: 'json',
                async: false,
                beforeSend: function (xhr) {
                    let btoa = localStorage['btoa'] || '';
                    xhr.setRequestHeader ("Authorization", "Basic " + btoa);
                },
                success: function (data){
                    window.location = "{{ route('blogs.index') }}";
                }
            });
        }
    </script>

</x-app-layout>
