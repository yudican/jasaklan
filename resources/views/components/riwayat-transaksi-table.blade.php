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
                    {{ $transaction->type }}
                </td>
                <td class="px-6 py-4">
                    {{ $transaction->getAmount() }}
                </td>
                <td class="px-6 py-4">
                    {{ $transaction->created_at->format('F j, Y h:i a') }}
                </td>
                <td class="px-6 py-4">
                    {{ $transaction->status }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
