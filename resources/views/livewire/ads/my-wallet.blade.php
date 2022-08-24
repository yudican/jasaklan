<div>
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
                <x-main-box title="Dana Keluar" value="{{ $expense }}" class="bg-red-500" />
                <x-main-box title="Total Saldo" value="{{ $balance }}" class="bg-blue-500" />
            </div>
            <div class="mt-8 bg-white p-4">
                <h1 class="text-xl">Riwayat Transaksi</h1>
                <div class="mt-4">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        ID Transaksi
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Jenis Transaksi
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Jumlah
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Waktu
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Keterangan
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $transaction->id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $transaction->category }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($transaction->amount < 0) -Rp {{ str_replace('-','',number_format($transaction->amount)) }}
                                            @else
                                            Rp {{ number_format($transaction->amount) }}
                                            @endif

                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $transaction->created_at->format('F j, Y h:i a') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{preg_replace('/\d+/', '', $transaction->description)}}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($transaction->status == 1)
                                        <span>Selesai</span>
                                        @elseif ($transaction->status == 2)
                                        <span>Pending</span>
                                        @else
                                        <span>Belum Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>