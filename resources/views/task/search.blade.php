<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $client->name }}
                </h2>
                <p>Email: {{ $client->email }}</p>
                <p>Phone: {{ $client->phone }}</p>
                <p>Country: {{ $client->country }}</p>
            </div>

            <a href="{{ route('task.create') }}" class="border border-emerald-500 px-3 py-1 rounded">Add New</a>
        </div>
    </x-slot>

    @include('layouts.message')


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="border">#</th>
                                <th class="border">Name</th>
                                <th class="border">Price</th>
                                <th class="border">Status</th>
                                <th class="border">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($client->tasks as $task)
                            <tr>
                                <td class="border py-2 text-center px-2">{{$task->id}}</td>
                                <td class="border py-2 text-left px-2">{{$task->name}}</td>
                                <td class="border py-2 text-center">{{$task->price}}</td>
                                <td class="border py-2 text-center capitalize">{{$task->status}}</td>

                                <td class="border py-2 text-center">
                                    <div class="flex justify-center">
                                        <a href="{{ route('task.edit', $task->id) }}" class="bg-emerald-800 text-white text-sm px-3 py-1 rounded mr-2">Edit</a>

                                        <a href="{{ route('task.show', $task->slug) }}" class="bg-blue-600 text-white text-sm px-3 py-1 rounded mr-2">View</a>

                                        <form action="{{ route('task.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Do you Really want to Delete?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="bg-red-800 text-white text-sm px-3 py-1 rounded ">Delete</button>

                                        </form>

                                    </div>
                                </td>
                            </tr>


                            @endforeach


                        </tbody>
                    </table>

                </div>


            </div>
        </div>
    </div>
</x-app-layout>