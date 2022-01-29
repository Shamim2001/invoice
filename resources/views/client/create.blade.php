<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Client') }}
            </h2>

            <a href="{{ route('client.index') }}" class="border border-emerald-500 px-3 py-1 rounded">back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mt-6 flex">
                            <div class="flex-1 mr-4">
                                <label for="name" class="formLabel">Name</label>
                                <input type="text" name="name" id="name" class="formInput">
                            </div>
                            <div class="flex-1 ml-4">
                                <label for="username" class="formLabel">Username</label>
                                <input type="text" name="username" id="username" class="formInput">
                            </div>
                        </div>


                        <div class="mt-6 flex">

                            <div class="flex-1 mr-4">
                                <label for="email" class="formLabel">Email</label>
                                <input type="text" name="email" id="email" class="formInput">
                            </div>
                            <div class="flex-1 ml-4">
                                <label for="phone" class="formLabel">Phone</label>
                                <input type="text" name="phone" id="phone" class="formInput">
                            </div>

                        </div>

                        <div class="mt-6 flex justify-between">

                            <div class="flex-1">
                                <label for="country" class="formLabel">Country</label>
                                <input type="text" name="country" id="country" class="formInput">
                            </div>
                            <div class="flex-1 mx-5">
                                <label for="thumbnail" class="formLabel">Thumbnail</label>
                                <input type="file" name="thumbnail" id="thumbnail" class="formInput">
                            </div>
                            <div class="flex-1">
                                <label for="status" class="formLabel">Status</label>
                                <select name="status" id="status" class="formInput">
                                    <option value="none">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>


                        <div class="mt-6">
                            <button type="submit" class="bg-emerald-800 px-4 py-2 text-white rounded-md text-xl uppercase">Create</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
