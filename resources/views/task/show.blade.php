<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Tasks') }}
            </h2>

            <a href="{{ route('task.create') }}" class="border border-emerald-500 px-3 py-1 rounded">Add New</a>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="">
                        <h2>Name: {{ $task->name }}</h2>
                        <h2>Price: ${{ $task->price }}</h2>
                        <h2>Client: {{ $task->client->name }}</h2>

                        <div class="flex justify-between items-center">
                            <div class="bg-blue-400 text-white px-3 py-1 capitalize inline-block rounded-md mt-3">
                                <p>{{ $task->status }}</p>
                            </div>

                            @if ($task->status == 'pending')
                                <div class="">
                                    <form action="{{ route('markAsComplete', $task) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <button type="submit"
                                            class="bg-blue-400 text-white px-3 py-1 capitalize inline-block rounded-md mt-3">Mark
                                            as Complete</button>
                                    </form>
                                </div>
                            @endif


                        </div>


                        <h2 class="font-bold my-3">Task Details</h2>

                        <div class="border my-4 p-5 prose max-w-none">
                            {!! $task->description !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
