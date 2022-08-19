<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Dompet') }}
                </h2>
            </div>
            <div class="flex gap-2">
                <x-button>
                    <a href="{{ route('advertiser.deposit') }}">
                        {{ __('Deposit') }}
                    </a>
                </x-button>
                <x-button>
                    <a href="{{ route('user.withdraw') }}">
                        {{ __('Penarikan') }}
                    </a>
                </x-button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 md:grid-cols-3 gap-2 p-4">
                <x-main-box title="Dana Masuk" value="{{ $income }}" class="bg-green-500" />
                <x-main-box title="Dana Keluar" value="{{ $expenses }}" class="bg-red-500" />
                <x-main-box title="Total Saldo" value="{{ (new \App\Models\Transaction())->getFormattedPrice($user->balance) }}" class="bg-blue-500" />
            </div>
            <div class="mt-8 bg-white p-4">
                <h1 class="text-xl">Riwayat Transaksi</h1>
                <div class="mt-4">
                    <x-riwayat-transaksi-table :transactions="$transactions" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
