<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Iklan Posting') }}
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
                        Foto
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Caption
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Paket
                    </th>
                    <th  class="px-6 py-3">
                        Sisa Tiket
                    </th>
                    <th  class="px-6 py-3">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody>
            @forelse($posts as $post)
                <tr class="bg-white border-b text-gray-900">
                    <th scope="row" class="px-6 py-4 font-medium   whitespace-nowrap">
                        <p class="px-4 bg-red-500  text-white font-bold py-2 rounded  text-center justify-center">
                            {{ $post->getSocialMedia() }}
                        </p>
                    </th>
                    <td class="px-6 py-4">
                       <div class="w-[2rem] h-[2rem]">
                           <img class="w-full h-full" src="{{ $post->getImageUrl() }}" alt="/">
                       </div>
                    </td>
                    <td class="px-6 py-4">
                        {{ $post->notes }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $post->package->getPackageName() }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $post->amount }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $post->status }}
                    </td>
                </tr>
            @empty
            <div class="text-center">Kosong</div>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>
