<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
            <a href="{{ route('user.create') }}" class="border border-emerald-500 px-3 py-1 rounded">Add New</a>
        </div>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white  border-gray-200">
                    @php
                        function getImageUrl($image)
                        {
                            if (str_starts_with($image, 'http')) {
                                return $image;
                            }
                            return asset('storage/uploads') . '/' . $image;
                        }
                    @endphp
                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="border py-2 w-20">Image</th>
                                <th class="border py-2 w-20">Name</th>
                                <th class="border py-2 w-20">Email</th>
                                <th class="border py-2 w-32">Company</th>
                                <th class="border py-2 w-32">Phone</th>
                                <th class="border py-2 w-32">Country</th>
                                <th class="border py-2 w-32">Role</th>
                                <th class="border py-2 w-32">Verified</th>
                                <th class="border py-2 min-w-max px-3">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($users as $user)
                                <tr>
                                    <td class="border py-2 text-left px-2 relative">
                                        <img src="{{ getImageUrl($user->thumbnail) }}" width="50" alt="" class="mx-auto">
                                    </td>
                                    <td class="border py-2 text-center text-sm">{{ $user->name }}</td>
                                    <td class="border py-2 text-center text-sm">{{ $user->email }}</td>
                                    <td class="border py-2 text-center text-sm">{{ $user->company }}</td>
                                    <td class="border py-2 text-center text-sm">{{ $user->phone }}</td>
                                    <td class="border py-2 text-center text-sm">{{ $user->country }}</td>
                                    <td class="border py-2 text-center text-sm capitalize">{{ $user->role }}</td>
                                    <td class="border py-2 text-center text-sm capitalize">{{ $user->hasVerifiedEmail() ? 'Yes' : 'No' }}</td>

                                    <td class="border py-2 text-center px-3">
                                        <div class="flex justify-center">
                                            <a href="{{ route('user.edit', $user) }}"
                                                class="bg-purple-500 text-white border-2 text-sm px-3 py-1 rounded mr-2 hover:bg-transparent hover:text-black transition-all duration-300">Edit</a>

                                            <form action="{{ route('user.destroy', $user) }}" method="POST"
                                                onsubmit="return confirm('Do you Really want to Delete?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="bg-red-500 border-2 text-white text-sm px-3 py-1 rounded hover:bg-transparent hover:text-black transition-all">Delete</button>

                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td class="border py-2 text-center" colspan="5">No User Found!</td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>

                </div>

                <div class="mt-5 px-5">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
