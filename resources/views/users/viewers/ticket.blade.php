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
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Nama Tiket
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Komisi
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Sosial Media
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Status
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($tickets as $ticket)
                <tr class="bg-white border-b">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                        {{ $ticket->name }}
                    </th>
                    <td class="py-4 px-6">
                        {{ $ticket->getCommission() }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $ticket->getAd['social_media'] }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $ticket->status }}
                    </td>
                </tr>
                @empty
                    <div>
                        <h1 class="text-center">Data masih kosong</h1>
                    </div>
                @endforelse
                </tbody>
            </table>
            {{ $tickets->links() }}
        </div>
    </div>

</x-app-layout>
