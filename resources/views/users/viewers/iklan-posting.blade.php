<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Iklan Posting') }}
            </h2>
        </div>
    </x-slot>
    <div class="md:mx-8 mt-12 md:px-4 md:text-base text-[10px] mx-2 px-2 py-2 rounded border border-gray-500">
        <p class="text-2xl font-bold">Keterangan</p>
        <ul class="list-decimal px-8 mt-4 text-justify">
            <li>Setiap 1 posting member akan di bayar {{ \App\Models\Ads::POST_COM }}</li>
            <li>Dana akan masuk ke menu penghasilan setelah Advertiser melakukan pengecekan maksimal 7 hari.</li>
            <li>Member dilarang keras delete post. Bila hal ini dilakukan maka akun akan dibanned dan tidak diperbolehkan
                mengikuti program ini selamanya.
            </li>
        </ul>
    </div>
    <div class="md:mx-8 md:px-4 md:text-base text-[10px] mx-2 px-2 py-2 rounded">

        @forelse($posts as $post)
        <!-- component -->
        <div class="bg-white rounded-lg border border-gray-200 px-4 py-2 border-b my-2 rounded-t-lg flex justify-between">
            <div class="py-2">
                <a aria-current="true" class="cursor-pointer font-medium text-blue-500 hover:text-blue-700">
                    {{ $post->title }}
                </a>
                <div href="#" aria-current="true">
                    <img class="inline-block w-2.5 md:w-7" src="https://img.icons8.com/fluency-systems-regular/48/000000/money.png">
                    <div class="inline-block">{{ $post->getCommissionFee() }}</div>
                </div>
            </div>
            <div>
                <div class="flex gap-4 py-4">
                    <div>
                        <span class="bg-red-100 text-red-800 text-xs md:text-sm font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $post->getSocialMedia() }}</span>
                        <div>
                            <span class="text-xs">Sisa Tiket: {{ $post->getTicket() }}</span>
                        </div>
                    </div>
                    <div class="my-auto">
                        @if($post->alreadyGetTicket($post->id))
                        <a class="text-white px-3 py-2 bg-blue-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                            Sudah Diambil
                        </a>
                        @else
                        <a href="{{ route('viewers.ticket.session', $post->id) }}" class="text-white px-3 py-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Ambil Tiket
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div>Kosong</div>
        @endforelse

        {{ $posts->links() }}

    </div>

    @include('users.viewers.footer.content', ['title' => 'Posting'])
    @include('users.viewers.modals.posting', ['content' => session('content')])

</x-app-layout>