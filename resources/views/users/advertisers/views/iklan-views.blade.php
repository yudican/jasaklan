<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Iklan Views') }}
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
                                URL IKLAN
                            </td>
                            <td tabindex="0"
                                class="focus:outline-none text-sm leading-none text-gray-600 dark:text-dark h-16 justify-center text-center">
                                Paket View
                            </td>
                            <td tabindex="0"
                                class="focus:outline-none text-sm leading-none text-gray-600 dark:text-dark h-16 justify-center text-center">
                                Jumlah Tayang
                            </td>
                            <td tabindex="0"
                                class="focus:outline-none text-sm leading-none text-gray-600 dark:text-dark h-16 justify-center text-center">
                                Jumlah Bayar
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($views as $view)
                        <tr tabindex="0"
                            class="focus:outline-none text-sm leading-none text-gray-600 dark:text-dark h-16">
                            <td class="w-1/2">
                                <div class="flex items-center">
                                    <div class="pl-2">
                                        <p class="text-sm font-medium leading-none text-gray-800 dark:text-dark ">
                                            {{ $view->url }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="pl-16">
                                <p>{{ $view->package->getPackageName() }}</p>
                            </td>
                            <td>
                                <p class="pl-16">{{ $view->views }}</p>
                            </td>
                            <td>
                                <p class="pl-16">{{ $view->getTotalPayment() }}</p>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
