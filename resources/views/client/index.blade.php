<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Clients') }}
            </h2>

            <a href="{{ route('client.create') }}" class="border border-emerald-500 px-3 py-1 rounded">Add New</a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="bg-emerald-200 text-emerald-700 py-4 text-center" id="message">
            <p>{{session('success')}}</p>
        </div>
    @endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="border py-2 w-32 text-center">Image</th>
                                <th class="border">Name</th>
                                <th class="border">Username</th>
                                <th class="border">Email</th>
                                <th class="border">Phone</th>
                                <th class="border">Country</th>
                                <th class="border">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @php
                                function getImageUrl($image) {
                                    if(str_starts_with($image, 'http')) {
                                        return $image;
                                    }
                                    return asset('storage/uploads') . '/' . $image;
                                }
                            @endphp

                            @foreach ($clients as $client)
                            <tr>
                                <td class="border py-2 w-32 text-center">
                                    <img src="{{ getImageUrl($client->thumbnail) }}" width="50" alt="" class="mx-auto rounded-full">
                                </td>
                                <td class="border py-2 text-center">{{$client->name}}</td>
                                <td class="border py-2 text-center">{{$client->username}}</td>
                                <td class="border py-2 text-center">{{$client->email}}</td>
                                <td class="border py-2 text-center">{{$client->phone}}</td>
                                <td class="border py-2 text-center">{{$client->country}}</td>
                                <td class="border py-2 text-center">
                                    <div class="flex justify-center">
                                        <a href="{{ route('client.edit', $client->id) }}" class="bg-emerald-800 text-white text-sm px-3 py-1 rounded mr-2">Edit</a>

                                        <form action="{{ route('client.destroy', $client->id) }}" method="POST" onsubmit="return confirm('Do you Really want to Delete?');">
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

                <div class="mt-5">
                    {{ $clients->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
