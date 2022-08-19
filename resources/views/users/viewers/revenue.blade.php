<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Penghasilan') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 md:grid-cols-2 gap-2 p-4">
                <x-main-box title="Penghasilan Hari Ini" value="{{ $revenue_today }}" class="bg-green-500"/>
                <x-main-box title="Penghasilan Total" value="{{ $revenue_total }}" class="bg-red-500"/>
            </div>
            <div class="mt-8 text-right">
                <form action="{{ route('viewers.revenue.transfer') }}" method="post">
                    @csrf
                    <x-button type="submit">Transfer ke Dompet</x-button>
                </form>
            </div>
            <div class="mt-8 bg-white p-4">
                <h1 class="text-xl">Riwayat Penghasilan</h1>
                <div class="mt-4">
                    <x-riwayat-penghasilan-table :revenues="$revenues"/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
