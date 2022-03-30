<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="">
        <div class="container mx-auto py-10">
            <div class="grid grid-cols-4 gap-5">

                <x-card text="Clients" :route="route('client.index')" :count="count($user->clients)"
                    class="bg-gradient-to-tr from-cyan-300 to-white rounded-md" />



                <x-card text="Pending Tasks" route="{{ route('task.index') }}??status=pending"
                    :count="count($pending_task)" class="bg-gradient-to-tl from-cyan-300 to-white rounded-md" />

                <x-card text="Completed Tasks" route="{{ route('task.index') }}??status=pending"
                    :count=" count($user->tasks) - count($pending_task)"
                    class="bg-gradient-to-bl from-cyan-300 to-white rounded-md" />


                <x-card text="Due Invoice" route="{{ route('invoice.index') }}??status=pending"
                    :count="count($unpaid_invoices)" class="bg-gradient-to-br from-cyan-300 to-white rounded-md" />

            </div>
        </div>
    </div>

    <div class="">
        <div class="container mx-auto ">
            <div class="flex space-x-10 pb-20">
                <div class="max-w-none ">
                    <h3 class="text-white font-bold text-2xl pb-5">Todo:</h3>

                    <ul class="bg-cyan-600 px-10 py-4 inline-block">
                        @forelse ($pending_task->slice(0, 15) as $task)
                            @php
                                $startdate = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Carbon\Carbon::now())->setTimeZone('Asia/Dhaka');
                                $enddate = $task->end_date;

                                // Time left Calculation
                                if ($enddate > $startdate) {
                                    $days = $startdate->diffInDays($enddate);
                                    $hours = $startdate
                                        ->copy()
                                        ->addDays($days)
                                        ->diffInHours($enddate);
                                    $minutes = $startdate
                                        ->copy()
                                        ->addDays($days)
                                        ->addHours($hours)
                                        ->diffInMinutes($enddate);
                                } else {
                                    $days = 0;
                                    $hours = 0;
                                    $minutes = 0;
                                }

                                // Bar Color And percent
                                if ($enddate > $startdate && $task->status == 'pending') {
                                    if ($days == 1) {
                                        $percent = 95;
                                        $color = 'bg-red-700';
                                    } elseif ($days < 3) {
                                        $percent = 75;
                                        $color = 'bg-red-400';
                                    } elseif ($days < 5) {
                                        $percent = 50;
                                        $color = 'bg-red-300';
                                    } else {
                                        $percent = 100;
                                        $color = 'bg-green-500';
                                    }
                                } else {
                                    $percent = 100;
                                    $color = 'bg-red-300';
                                }
                            @endphp

                            <li class=" flex justify-between items-center border-b">
                                <a class="text-white hover:text-black transition-all duration-300 w-8/12"
                                    href="{{ route('task.show', $task->slug) }}">{{ $task->name }}</a>
                                @if ($enddate > $startdate)
                                    <span
                                        class="text-white text-xs w-3/12 text-right">{{ $days != 0 ? $days . ' Days,' : '' }}
                                        {{ $hours != 0 ? $hours . ' Hours,' : '' }}
                                        {{ $minutes != 0 ? $minutes . ' Minutes,' : '' }} left</span>
                                @else
                                    <span class="text-white text-xs w-4/12 text-right">Time Over</span>
                                @endif
                            </li>
                        @empty
                            <li class="">No tasks found!</li>
                        @endforelse
                        <div class="text-center">
                            <a class="inline-block mt-5 px-5 py-1 text-black bg-white uppercase text-decoration-none"
                                href="{{ route('task.index') }}"> View More</a>
                        </div>
                    </ul>
                </div>
                <div class="max-w-none flex-1">
                    <h3 class="text-white font-bold text-2xl pb-5">Activity Log:</h3>
                    <ul class="bg-cyan-600 px-5 py-4">

                        @forelse ($activity_logs->slice(0, 10) as $activity )
                            <li class=" flex justify-between items-center border-b">
                            <a class="text-white w-8/12">{{ $activity->message }}</a>
                            <span class="text-white text-xs w-4/12 text-right">{{ $activity->created_at->diffForHumans() }}</span>
                        </li>
                        @empty
                            <li class=" flex justify-between items-center border-b">
                            <span class="text-white text-xs w-4/12 text-right">No Activity Found!</span>
                        </li>
                        @endforelse



                        {{-- @forelse ($paid_invoices->slice(0, 5) as $invoice)
                            <li class=" flex justify-between items-center border-b">
                                <a class="text-white hover:text-black transition-all duration-300 w-8/12"
                                    href="{{ route('task.show', $task->slug) }}">{{ $task->name }}</a>
                                @if ($enddate > $startdate)
                                    <span
                                        class="text-white text-xs w-3/12 text-right">{{ $days != 0 ? $days . ' Days,' : '' }}
                                        {{ $hours != 0 ? $hours . ' Hours,' : '' }}
                                        {{ $minutes != 0 ? $minutes . ' Minutes,' : '' }} left</span>
                                @else
                                    <span class="text-white text-xs w-4/12 text-right">Time Over</span>
                                @endif
                            </li>
                            @empty
                                <li class="text-white">No paid invoice found!</li>
                        @endforelse --}}
                    </ul>
                    <h3 class="text-white font-bold text-2xl pb-5 mt-5">Payment History:</h3>

                    <ul class="bg-cyan-600 px-5 py-4">
                        @forelse ($paid_invoices->slice(0, 5) as $invoice)
                            <li class="flex justify-between space-x-10 items-center"><span
                                    class="text-sm">{{ $invoice->updated_at->format('d M, Y') }}</span><span>{{ $invoice->client->name }}</span><span>$500</span>
                            </li>
                        @empty
                            <li class="text-white">No paid invoice found!</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
