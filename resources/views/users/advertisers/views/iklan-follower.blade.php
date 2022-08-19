<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Iklan Follower') }}
            </h2>
        </div>
    </x-slot>
    <div class="sm:mx-4 mt-2">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')"/>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-white  dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Sosial Media
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Url iklan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Judul
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Catatan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Paket
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Sisa Tiket
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($advertises as $advertise)
                    <tr class="bg-white border-b text-gray-900">
                        <th scope="row" class="px-6 py-4 font-medium   whitespace-nowrap">
                            <p class="px-4 bg-red-500  text-white font-bold py-2 rounded  text-center justify-center">
                                {{ $advertise->getSocialMedia() }}
                            </p>
                        </th>
                        <td class="px-6 py-4">
                            <a class="text-blue-700" target="_blank"
                               href="{{ $advertise->url }}">{{ $advertise->url }}</a>
                        </td>
                        <td class="px-6 py-4">
                            {{ $advertise->account_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $advertise->notes }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $advertise->package->getPackageName() }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $advertise->amount }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $advertise->status }}
                        </td>
                    </tr>
                @empty
                    <div>Kosong</div>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
