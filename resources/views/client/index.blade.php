<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="border py-2 w-32 text-center">Thumbnail</th>
                                <th class="border">Name</th>
                                <th class="border">Username</th>
                                <th class="border">Email</th>
                                <th class="border">Phone</th>
                                <th class="border">Country</th>
                                <th class="border">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($clients as $client)
                            <tr>

                                <td class="border py-2 w-32 text-center">
                                    <img src="{{$client->thumbnail}}" width="50" alt="" class="mx-auto rounded-full">
                                </td>
                                <td class="border py-2 text-center">{{$client->name}}</td>
                                <td class="border py-2 text-center">{{$client->username}}</td>
                                <td class="border py-2 text-center">{{$client->email}}</td>
                                <td class="border py-2 text-center">{{$client->phone}}</td>
                                <td class="border py-2 text-center">{{$client->country}}</td>
                                <td class="border py-2 text-center">
                                    <a href="#" class="bg-emerald-800 text-white px-2 py-1">Edit</a>
                                    <a href="#" class="bg-red-800 text-white px-2 py-1">Delete</a>
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
