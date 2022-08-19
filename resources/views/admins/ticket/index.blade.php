<x-guest-layout>
    <div class="flex gap-2">
        @include('admins.layouts.sidebar')
        <div class="m-12 w-full">
            <h1 class="font-semibold text-xl mb-12">Tiket</h1>
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
                        <th scope="col" class="py-3 px-6">
                            Aksi
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)
                        <tr class="bg-white border-b">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                {{ $ticket->name }}
                            </th>
                            <td class="py-4 px-6">
                                {{ $ticket->getCommission() }}
                            </td>
                            <td class="py-4 px-6">
                                <a class="text-blue-500" href="{{ route('admin.ticket.download', $ticket->id) }}">
                                    Download Screenshot
                                </a>
                            </td>
                            <td class="py-4 px-6">
                                {{ $ticket->getAd['social_media'] }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $ticket->status }}
                            </td>
                            <td class="py-4 px-6">
                                @if($ticket->status != \App\Models\Ticket::APPROVE)
                                    <form method="POST">
                                        @csrf
                                        @method('PUT')
                                        <x-button type="submit"
                                                  formaction="{{ route('admin.ticket.approve', $ticket->id) }}">Approve
                                        </x-button>
                                        <x-button type="submit"
                                                  formaction="{{ route('admin.ticket.decline', $ticket->id) }}">Decline
                                        </x-button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $tickets->links() }}
        </div>
    </div>
</x-guest-layout>
