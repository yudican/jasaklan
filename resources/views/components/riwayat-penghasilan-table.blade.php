<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3">
                ID Penghasilan
            </th>
            <th scope="col" class="px-6 py-3">
                Tipe
            </th>
            <th scope="col" class="px-6 py-3">
                Jumlah
            </th>
            <th scope="col" class="px-6 py-3">
                Sudah ditransfer
            </th>
            <th scope="col" class="px-6 py-3">
                Waktu
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($revenues as $revenue)
            <tr class="bg-white border-b hover:bg-gray-50">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $revenue->id }}
                </th>
                <td class="px-6 py-4">
                    {{ $revenue->type }}
                </td>
                <td class="px-6 py-4">
                    {{ $revenue->getAmount() }}
                </td>
                <td class="px-6 py-4">
                    {{ $revenue->isTransfered() }}
                </td>
                <td class="px-6 py-4">
                    {{ $revenue->created_at->format('F j, Y h:i a') }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $revenues->links() }}
</div>
