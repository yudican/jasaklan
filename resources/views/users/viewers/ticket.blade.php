<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tiket Saya') }}
            </h2>
        </div>
    </x-slot>

    <div class="mx-12 mt-12">
        <div class="overflow-x-auto relative">
            <livewire:table.user.user-ticket-table />
        </div>
    </div>

</x-app-layout>