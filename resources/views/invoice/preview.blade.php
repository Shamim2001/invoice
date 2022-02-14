<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('invoice  Preview') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white">
        @include('invoice.pdf')
    </div>
</x-app-layout>
