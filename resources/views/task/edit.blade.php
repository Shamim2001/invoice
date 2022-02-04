<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Task') }}
            </h2>

            <a href="{{ route('task.index') }}" class="border border-emerald-500 px-3 py-1 rounded">back</a>
        </div>
    </x-slot>

    @include('layouts.message')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('task.update', $task->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")

                        <div class="mt-6 flex">
                            <div class="flex-1 ">
                                <label for="name" class="formLabel">Name</label>
                                <input type="text" name="name" id="name" class="formInput" value="{{ $task->name }}">

                                @error('name')
                                    <p class="text-red-700 text-sm">{{$message}}</p>
                                @enderror

                            </div>
                        </div>


                        <div class="mt-6 flex">

                            <div class="flex-1 mr-4">
                                <label for="price" class="formLabel">Price</label>
                                 <input type="number" name="price" id="price" class="formInput" value="{{ $task->price }}">

                                @error('price')
                                    <p class="text-red-700 text-sm">{{$message}}</p>
                                @enderror


                            </div>
                            <div class="flex-1 ">
                                <label for="client_id" class="formLabel">Client Name</label>

                                <select name="client_id" id="client_id" class="formInput">

                                    <option value="none">Select Client</option>

                                    @foreach ($clients as $client)
                                         <option value="{{ $client->id }}" {{  $client->id == $task->client_id ? 'selected' : '' }}>{{ $client->name }}</option>
                                    @endforeach

                                </select>

                                @error('client_id')
                                    <p class="text-red-700 text-sm">{{$message}}</p>
                                @enderror

                            </div>

                        </div>

                        <div class="mt-6 flex">
                            <div class="flex-1">
                                <label for="description" class="formLabel">Description</label>
                                <textarea name="description" id="description"  rows="10" class="formInput">
                                    {{ $task->description }}
                                </textarea>

                                @error('description')
                                    <p class="text-red-700 text-sm">{{$message}}</p>
                                @enderror

                            </div>
                        </div>


                        <div class="mt-6">
                            <button type="submit" class="bg-emerald-800 px-4 py-2 text-white rounded-md text-base uppercase">Update</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $('#description').summernote({
                tabsize: 2,
                height: 320,
                toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        </script>
    @endsection
</x-app-layout>
