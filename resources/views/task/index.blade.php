<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tasks') }}
            </h2>

            <a href="{{ route('task.create') }}" class="border border-emerald-500 px-3 py-1 rounded">Add New</a>
        </div>
    </x-slot>



    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 bg-white py-10 rounded-md "
                {{ request('client_id') || request('status') || request('formDate') || request('endDate') || request('price')? '': 'hidden' }}
                id="task_filter">
                <h2 class="text-center mb-6 font-bold">Filter Tasks</h2>
                <form action="{{ route('task.index') }}" method="GET">
                    <div class="flex space-x-4 items-end justify-center">
                        <div class="">
                            @error('client_id')
                                <p class="text-red-700 text-sm">{{ $message }}</p>
                            @enderror

                            <label for="client_id" class="formLabel">Client</label>
                            <select name="client_id" id="client_id">
                                <option value="">Select Client</option>

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

                            <label for="status" class="formLabel">Status</label>
                            <select name="status" id="status">
                                <option value="">Select Status</option>
                                <option value="pending"
                                    {{ old('status') == 'pending' || request('status') == 'pending' ? 'selected' : '' }}>
                                    Pending</option>
                                <option value="complete"
                                    {{ old('status') == 'complete' || request('status') == 'complete' ? 'selected' : '' }}>
                                    Complete</option>
                            </select>
                        </div>


                        <div class="">
                            @error('formDate')
                                <p class="text-red-700 text-sm">{{ $message }}</p>
                            @enderror
                            <label for="formDate" class="formLabel">Start Date</label>
                            <input type="date" class="formInput" name="formDate" id="formDate"
                                max="{{ now()->format('Y-m-d') }}" value="{{ request('formDate') }}">
                        </div>


                        <div class="">
                            @error('endDate')
                                <p class="text-red-700 text-sm">{{ $message }}</p>
                            @enderror
                            <label for="endDate" class="formLabel">End Date</label>
                            <input type="date" class="formInput" name="endDate" id="endDate"
                                value="{{ request('endDate') != '' ? request('endDate') : now()->format('Y-m-d') }}"
                                max="{{ now()->format('Y-m-d') }}">
                        </div>

                        <div class="">
                            @error('price')
                                <p class="text-red-700 text-sm">{{ $message }}</p>
                            @enderror
                            <label for="price" class="formLabel">Price</label>
                            <input type="number" class="formInput" name="price" id="price"
                                value="{{ request('price') }}">
                        </div>



                        <div class="">
                            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-sm">Search</button>
                        </div>
                    </div>

                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white  border-gray-200">
                    <div class="text-right">
                        <button id="task_filter_btn" type="button"
                            class="bg-blue-500 border-2 text-white px-3 py-1 mb-6 rounded-sm hover:bg-transparent hover:text-black">{{ request('client_id') || request('status') || request('formDate') || request('endDate') || request('price')? 'Close Filter': 'Filter' }}</button>
                    </div>
                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="border">Name</th>
                                <th class="border w-20">Price</th>
                                <th class="border w-40">Status</th>
                                <th class="border">Client</th>
                                <th class="border">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($tasks as $task)
                                <tr>
                                    <td class="border py-2 text-left px-2 relative">
                                        <a class="font-bold   text-sm hover:text-purple-700"
                                            href="{{ route('task.show', $task->slug) }}">{{ $task->name }}</a>

                                        @php
                                            $days_left = Carbon\Carbon::parse($task->end_date)->diffInDays(Carbon\Carbon::now());

                                            if ($days_left == 1) {
                                                $percent = 95;
                                                $color = 'bg-red-700';
                                            } elseif ($days_left < 3) {
                                                $percent = 75;
                                                $color = 'bg-red-400';
                                            } elseif ($days_left < 5) {
                                                $percent = 50;
                                                $color = 'bg-red-300';
                                            } else {
                                                $percent = 100;
                                                $color = 'bg-green-500';
                                            }

                                        @endphp

                                        <span class="absolute bottom-2 right-1 text-xs ">{{ $days_left }} Days
                                            Left</span>
                                        @if ($task->status == 'complete')
                                            <div class="absolute h-1 w-full z-10 bg-green-600 left-0 bottom-0 "></div>
                                        @else
                                            <div class="absolute h-1 z-10 left-0 bottom-0"
                                                style="width:{{ $percent }}; background-color:{{ $color }}">
                                            </div>
                                        @endif

                                        <div class="absolute h-1 w-1/2 bg-slate-400 left-0 bottom-0 "></div>
                                    </td>
                                    <td class="border py-2 text-center text-sm">{{ $task->price }}</td>
                                    <td class="border py-2 text-center capitalize text-sm">{{ $task->status }}
                                        @if ($task->status == 'pending')
                                            <form action="{{ route('markAsComplete', $task) }}" method="POST"
                                                onsubmit="return confirm('Are You sure?');">
                                                @csrf
                                                @method('put')

                                                <button type="submit"
                                                    class="bg-teal-600 text-white text-sm px-3 py-0 border-2 rounded hover:bg-transparent hover:text-black duration-300 w-full">DONE</button>
                                            </form>
                                        @endif

                                    </td>
                                    <td class="border py-2 text-left px-3 text-sm">
                                        <a class="text-indigo-600 font-bold"
                                            href="{{ route('task.index') }}?client_id={{ $task->client->id }}">{{ $task->client->name }}</a>
                                    </td>

                                    <td class="border py-2 text-center">

                                        <div class="flex justify-center">

                                            <a href="{{ route('task.edit', $task->id) }}"
                                                class="bg-emerald-800 text-white border-2 text-sm px-3 py-1 rounded mr-2 hover:bg-transparent hover:text-black duration-300">Edit</a>

                                            <form action="{{ route('task.destroy', $task->id) }}" method="POST"
                                                onsubmit="return confirm('Do you Really want to Delete?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="bg-red-800 border-2 text-white text-sm px-3 py-1 rounded hover:bg-transparent hover:text-black ">Delete</button>

                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td class="border py-2 text-center" colspan="5">No Task Found!</td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>

                </div>

                <div class="mt-5 px-5">
                    {{ $tasks->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
