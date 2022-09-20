<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(Route::is('blogs.store')) {{ __('Создание блога') }} @else {{ __('Редактирование блога') }} @endif
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Validation Errors -->
                <div class="text-red-600">
                    <ul id="errors">
                    </ul>
                </div>

                <form id="blog">
                    <!-- Name -->
                    <div>
                        <x-input-label for="title" :value="__('Заголовок')" />

                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $blog->title ?? ''}}" required autofocus />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="body" :value="__('Тело')" />

                        <x-text-input id="body" class="block mt-1 w-full" type="text" name="body" value="{{ $blog->body ?? '' }}" required />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="button" class="btn btn-outline-primary" id="button">@if(Route::is('blogs.store')) Создать @else Редактировать @endif</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <script>
            function request(type, url) {
                let title = $("input#title").val();
                let body = $("input#body").val();

                $.ajax({
                    type: type,
                    url: url,
                    dataType: 'json',
                    async: false,
                    data: {
                        title: title,
                        body: body
                    },
                    beforeSend: function (xhr) {
                        let btoa = localStorage['btoa'] || '';
                        xhr.setRequestHeader ("Authorization", "Basic " + btoa);
                    },
                    error: function (xhr){
                        let errors = xhr.responseJSON.errors;
                        let text = '';
                        for (let key in errors) {
                            text += "<li>" + key + " : " + errors[key] + "</li>"
                        }
                        $("#errors").html(text);
                        console.warn(errors);
                    },
                    success: function (data){
                        window.location = "{{ route('blogs.index') }}";
                    }
                });
            }

            function create() {
                request('POST', "{{ route('api.blogs.store') }}");
            }

            $("#button").click(function(){
                @if(Route::is('blogs.store'))
                    create();
                @else
                    request('PUT', "{{ route('api.blogs.update', ['blog' => $blog->id]) }}");
                @endif
            });
        </script>
</x-app-layout>
