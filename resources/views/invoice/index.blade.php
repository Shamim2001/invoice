<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Invoices') }}
            </h2>

            <a href="{{ route('invoice.create') }}" class="border border-emerald-500 px-3 py-1 rounded">Add New</a>
        </div>
    </x-slot>

    @include('layouts.message')


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white  border-gray-200">

                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="border">#</th>
                                <th class="border">Client</th>
                                <th class="border">Status</th>
                                <th class="border">Email Sent</th>
                                <th class="border">Preview</th>
                                <th class="border">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($invoices as $invoice)
                            <tr>
                                <td class="border py-2 text-center px-2">{{ $invoice->invoice_id }}</td>
                                <td class="border py-2 text-left px-2">{{  $invoice->client->name }}</td>
                                <td class="border py-2 text-center capitalize">{{  $invoice->status }}</td>
                                <td class="border py-2 text-center capitalize">{{ $invoice->email_sent }}</td>
                                <td class="border py-2 text-center capitalize">
                                    <a target="_blank" href="{{ asset('storage/invoices/'. $invoice->download_url )  }}" class="bg-purple-600 text-white text-sm px-3 py-1 rounded mr-2 hover:bg-transparent hover:text-black transition-all duration-300">View</a>
                                </td>

                                <td class="border py-2 text-center">
                                    <div class="flex justify-center space-x-4">

                                        <a href="{{ route('invoice.sendEmail', $invoice) }}" class="bg-blue-800 text-white text-sm px-3 py-1 rounded hover:bg-transparent hover:text-black transition-all duration-300">Send Email</a>

                                        @if ($invoice->status == 'unpaid')

                                        <form action="{{ route('invoice.update', $invoice->id) }}" method="POST" onsubmit="return confirm('Did you get paid?');">
                                            @csrf
                                            @method('PUT')

                                            <button type="submit" class="bg-purple-800 text-white text-sm px-3 py-1 rounded hover:bg-transparent hover:text-black transition-all duration-300 ">Paid</button>

                                        </form>
                                         @endif

                                        <form action="{{ route('invoice.destroy', $invoice->id) }}" method="POST" onsubmit="return confirm('Do you Really want to Delete?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="bg-red-800 text-white text-sm px-3 py-1 rounded hover:bg-transparent hover:text-black transition-all duration-300">Delete</button>

                                        </form>

                                    </div>
                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td class="border py-2 text-center" colspan="5">No Invoice Found!</td>
                            </tr>


                            @endforelse


                        </tbody>
                    </table>

                </div>

                <div class="mt-5">
                    {{ $invoices->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
