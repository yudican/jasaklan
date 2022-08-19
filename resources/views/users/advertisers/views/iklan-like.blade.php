<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Iklan Like') }}
            </h2>
        </div>
    </x-slot>
    <div class="w-full flex bg-white">
        <div class="w-full">
            <div class="bg-white dark:bg-white px-4 md:px-10 pb-5">
                <div class="overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <thead>
                        <tr>
                            <td tabindex="0"
                                class="focus:outline-none text-sm leading-none text-gray-600 dark:text-dark h-16 justify-center text-center">
                                Social Media
                            </td>
                            <td tabindex="0"
                                class="focus:outline-none text-sm leading-none text-gray-600 dark:text-dark h-16 justify-center text-center">
                                URL IKLAN
                            </td>
                            <td tabindex="0"
                                class="focus:outline-none text-sm leading-none text-gray-600 dark:text-dark h-16 justify-center text-center">
                                Judul
                            </td>
                            <td tabindex="0"
                                class="focus:outline-none text-sm leading-none text-gray-600 dark:text-dark h-16 justify-center text-center">
                                Paket
                            </td>
                            <td tabindex="0"
                                class="focus:outline-none text-sm leading-none text-gray-600 dark:text-dark h-16 justify-center text-center">
                                Sisa Tiket
                            </td>
                            <td tabindex="0"
                                class="focus:outline-none text-sm leading-none text-gray-600 dark:text-dark h-16 justify-center text-center">
                                Status
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($likes as $like)
                        <tr tabindex="0"
                            class="focus:outline-none text-sm leading-none text-gray-600 dark:text-dark h-16">
                            <td>
                                <p class="px-4 bg-red-500 hover:bg-blue-700 text-white font-bold py-2 rounded  text-center justify-center">
                                    {{ $like->getSocialMedia() }}
                                </p>
                            </td>
                            <td class="w-1/2">
                                <div class="flex justify-center items-center">
                                    <div class="pl-2">
                                        <p class="text-sm font-medium leading-none text-gray-800 dark:text-dark  text-center justify-center px-8 w-96 break-all whitespace-normal">
                                            {{ $like->url }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 ">
                                <p>{{ $like->title }}</p>
                            </td>
                            <td>
                                <p class="px-8">{{ $like->package->getPackageName() }}</p>
                            </td>
                            <td class="px-6 py-4">
                                {{ $like->amount }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $like->status }}
                            </td>
                        </tr>
                        @empty
                            <div>Kosong</div>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
