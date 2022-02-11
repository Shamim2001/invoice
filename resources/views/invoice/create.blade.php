<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Invoice') }}
            </h2>

            <a href="{{ route('invoice.index') }}" class="border border-emerald-500 px-3 py-1 rounded">back</a>
        </div>
    </x-slot>

    @include('layouts.message')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('invoice.search') }}" method="GET">
                        @csrf

                        <div class="flex space-x-4 items-end justify-center">
                            <div class="">
                                @error('client_id')
                                    <p class="text-red-700 text-sm">{{$message}}</p>
                                @enderror

                                <label for="client_id" class="formLabel">Select Client</label>
                                <select name="client_id" id="client_id">
                                    <option value="none">Select Client</option>

                                    @foreach ($clients as $client)

                                    <option value="{{ $client->id }}" {{ $client->id == old('client_id') ? "selected" : "" }}>{{ $client->name }}</option>

                                    @endforeach
                                </select>
                            </div>

                            <div class="">
                                @error('status')
                                    <p class="text-red-700 text-sm">{{$message}}</p>
                                @enderror

                                <label for="status" class="formLabel">Select Status</label>
                                <select name="status" id="status">
                                    <option value="none">Select Status</option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="complete" {{ old('status') == 'complete' ? 'selected' : '' }}>Complete</option>
                                </select>


                            </div>

                            <div class="">
                                <label for="formDate" class="formLabel">Start Date</label>
                                <input type="date" class="formInput" name="formData" id="formData" max="{{ now()->format('Y-m-d') }}">
                            </div>
                             @error('formDate')
                                <p class="text-red-700 text-sm">{{$message}}</p>
                            @enderror

                            <div class="">
                                <label for="endDate" class="formLabel">End Date</label>
                                <input type="date" class="formInput" name="endData" id="endData" value="{{ now()->format('Y-m-d') }}" max="{{ now()->format('Y-m-d') }}" >
                            </div>
                             @error('endDate')
                                <p class="text-red-700 text-sm">{{$message}}</p>
                            @enderror


                            <div class="">
                                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-sm">Search</button>
                            </div>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>


</x-app-layout>
