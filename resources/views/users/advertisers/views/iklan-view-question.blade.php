<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Iklan View Questions') }}
            </h2>
        </div>
    </x-slot>
    <div class="sm:mx-4 mt-2">
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
                            Opsi jawban
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jawaban Benar
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Paket
                        </th>
                        <th class="px-6 py-3 text-center" colspan="2">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b text-gray-900">
                        <th scope="row" class="px-6 py-4 font-medium   whitespace-nowrap">
                            <p class="px-4 bg-red-500  text-white font-bold py-2 rounded  text-center justify-center">
                                Youtube</p>
                        </th>
                        <td class="px-6 py-4">
                            <a class="text-blue-700" href="https://www. jasaklan.com/member/?p=buat-iklan&tipe=7">https://www. jasaklan.com/member/?p=buat-iklan&tipe=7</a>
                        </td>
                        <td class="px-6 py-4">
                            Buat website jasa iklan
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <p>A.belajar</p>
                                <p>B.belajar</p>
                                <p>C.belajar</p>
                                <p>D.belajar</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            A.belajar
                        </td>
                        <td class="px-6 py-4">
                            Rp. 60,000 - 100 View Question
                        </td>
                        <td class="">
                            <a href="">
                                <button class="px-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 rounded">
                                    Update
                                </button>
                            </a>
                        </td>
                        <td class="">
                            <a href="">
                                <button class="px-4 bg-red-500 hover:bg-blue-700 text-white font-bold py-2 rounded">
                                    Delete
                                </button>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>