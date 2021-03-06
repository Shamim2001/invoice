<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Invoice') }}
            </h2>

            <a href="{{ route('invoice.index') }}" class="border border-emerald-500 px-3 py-1 rounded">back</a>
        </div>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('invoice.create') }}" method="GET">
                        @csrf

                        <div class="flex space-x-4 items-end justify-center">
                            <div class="">
                                @error('client_id')
                                    <p class="text-red-700 text-sm">{{ $message }}</p>
                                @enderror

                                <label for="client_id" class="formLabel">Select Client</label>
                                <select name="client_id" id="client_id">
                                    <option value="none">Select Client</option>

                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}"
                                            {{ $client->id == old('client_id') || $client->id == request('client_id') ? 'selected' : '' }}>
                                            {{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="">
                                @error('status')
                                    <p class="text-red-700 text-sm">{{ $message }}</p>
                                @enderror

                                <label for="status" class="formLabel">Select Status</label>
                                <select name="status" id="status">
                                    <option value="none">Select Status</option>
                                    <option value="pending"
                                        {{ old('status') == 'pending' || request('status') == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="complete"
                                        {{ old('status') == 'complete' || request('status') == 'complete' ? 'selected' : '' }}>
                                        Complete</option>
                                </select>


                            </div>

                            <div class="">
                                <label for="formDate" class="formLabel">Start Date</label>
                                <input type="date" class="formInput" name="formDate" id="formDate"
                                    max="{{ now()->format('Y-m-d') }}" value="{{ request('formDate') }}">
                            </div>
                            @error('formDate')
                                <p class="text-red-700 text-sm">{{ $message }}</p>
                            @enderror

                            <div class="">
                                <label for="endDate" class="formLabel">End Date</label>
                                <input type="date" class="formInput" name="endDate" id="endDate"
                                    value="{{ request('endDate') != '' ? request('endDate') : now()->format('Y-m-d') }}"
                                    max="{{ now()->format('Y-m-d') }}">
                            </div>
                            @error('endDate')
                                <p class="text-red-700 text-sm">{{ $message }}</p>
                            @enderror


                            <div class="">
                                <button type="submit"
                                    class="bg-purple-600 text-white px-4 py-2 rounded-sm border-2 hover:bg-transparent hover:text-black duration-300">Search</button>
                            </div>
                        </div>

                    </form>

                    @if ($tasks)

                        <div class="mt-10">
                            <form action="{{ route('invoice') }}" method="GET" id="tasksInvoiceForm">
                                @csrf
                                <table class="w-full border-collapse">
                                    <thead>
                                        <tr>
                                            <th class="border">Select</th>
                                            <th class="border">Name</th>
                                            <th class="border">Status</th>
                                            <th class="border">Price</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($tasks as $task)
                                            <tr>
                                                <td class="border py-2 text-center px-2">
                                                    <input type="checkbox" name="invoice_ids[]"
                                                        value="{{ $task->id }}" checked>
                                                </td>
                                                <td class="border py-2 text-left px-2">{{ $task->name }}</td>
                                                <td class="border py-2 text-center capitalize">{{ $task->status }}
                                                </td>
                                                <td class="border py-2 text-center capitalize">{{ $task->price }}
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="mt-10 flex justify-between">
                                    <div class="flex space-x-4">
                                        <div class="">
                                            <label for="discount">Discount</label>
                                            <input type="number" name="discount" id="discount"
                                                placeholder="Discount amount">
                                        </div>
                                        <div class="">
                                            {{-- <label for="discount_type">Discount type</label> --}}
                                            <select name="discount_type" id="discount_type">

                                                <option value="%" selected>%</option>
                                                <option value="$">$</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex justify-center mt-5 space-x-5">
                                        <button type="submit" name="preview" value="yes" form="tasksInvoiceForm"
                                            class="bg-purple-500 text-white px-3 py-2 rounded-sm border-2 hover:bg-transparent hover:text-black duration-300">Preview</button>

                                        <button type="submit" name="generate" value="yes" form="tasksInvoiceForm"
                                            class="bg-green-400 text-white px-3 py-2 rounded-sm border-2 hover:bg-transparent hover:text-black duration-300">Generate</button>
                                    </div>
                                </div>
                            </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>


</x-app-layout>
