<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Iklan Follow') }}
            </h2>
        </div>
    </x-slot>
    <div class="md:mx-8 mt-12 md:px-4 md:text-base text-[10px] mx-2 px-2 py-2 rounded border border-gray-500">
        <p class="text-2xl font-bold">Keterangan</p>
        <ul class="list-decimal px-8 mt-4 text-justify">
            <li>Setiap 1 komentar member akan di bayar {{ \App\Models\Ads::COMMENT_COM }}</li>
            <li>Dana akan masuk ke menu penghasilan setelah Advertiser melakukan pengecekan maksimal 7 hari.</li>
            <li>Member dilarang keras Uncomment. Bila hal ini dilakukan maka akun akan dibanned dan tidak diperbolehkan
                mengikuti program ini selamanya.
            </li>
        </ul>
    </div>
    <div class="md:mx-8 md:px-4 md:text-base text-[10px] mx-2 px-2 py-2 rounded">

        @forelse($comments as $comment)
            <!-- component -->
            <div
                class="bg-white rounded-lg border border-gray-200 px-4 py-2 border-b my-2 rounded-t-lg flex justify-between">
                <div class="py-2">
                    <a aria-current="true"
                       class="cursor-pointer font-medium text-blue-500 hover:text-blue-700">
                        {{ $comment->title }}
                    </a>
                    <div href="#" aria-current="true">
                        <img class="inline-block w-2.5 md:w-7"
                             src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAAA70lEQVRIie3UP04CQRTH8c8KMR7AE1AaO29gwwU8Ar2lPZi4NJacgNgbjoDQWtuaLKEkxNZg4RI2O8ufZdfC6C/Z5s2b3/ftezPDv0poglVN33htGmUAq5oLjvKBNb1bwbSb8Qm0dQGn6GOGBHEaK+WzCxAL+xxXBUxshpUUAJKCvMDnZEsVOys5Mq90ix7K+uwbcuy7LZWHXOWY9vKAH79o2SG/1Gg+3p/ym9VCB0+YC4/nGwa4wXlmX9PmQl4cCotwiVs8Y5GDfeIVj3hPYzMFL+mhauAKdxhhKfzD4bHmRTrDNe4xxQfadQL+gL4ASwtvvtpZqD4AAAAASUVORK5CYII=">
                        <div class="inline-block">{{ $comment->getCommissionFee() }}</div>
                    </div>
                </div>
                <div>
                    <div class="flex gap-4 py-4">
                        <div>
                        <span
                            class="bg-red-100 text-red-800 text-xs md:text-sm font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $comment->getSocialMedia() }}</span>
                            <div>
                                <span class="text-xs">Sisa Tiket: {{ $comment->getTicket() }}</span>
                            </div>
                        </div>
                        <div class="my-auto">
                            @if($comment->alreadyGetTicket($comment->id))
                                <a
                                    class="text-white px-3 py-2 bg-blue-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                    Sudah Diambil
                                </a>
                            @else
                                <a
                                    href="{{ route('viewers.ticket.session', $comment->id) }}"
                                    class="text-white px-3 py-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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

        {{ $comments->links() }}

    </div>

    @include('users.viewers.footer.content', ['title' => 'Komentar'])
    @include('users.viewers.modals.komentar', ['content' => session('content')])

</x-app-layout>
