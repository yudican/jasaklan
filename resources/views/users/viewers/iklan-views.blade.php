<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Iklan Views') }}
            </h2>
        </div>
    </x-slot>
    <div class="md:mx-8 mt-12 md:px-4 md:text-base text-[10px] mx-2 px-2 py-2 rounded border border-gray-500">
        <p class="text-2xl font-bold">Keterangan</p>
        <ul class="list-decimal px-8 mt-4 text-justify">
            <li>Setiap views member akan di bayar sesuai dengan yang tertera di bawah</li>
            <li>Dana akan masuk ke menu penghasilan setelah Advertiser melakukan pengecekan maksimal 7 hari.</li>
        </ul>
    </div>
    <div class="md:mx-8 md:px-4 md:text-base text-[10px] mx-2 px-2 py-2 rounded">

        <div class=" md:text-base text-[10px] px-2 py-2 text-center">
            @forelse($views as $view)
                <a href="{{ $view->url }}">
                    <div
                        class="inline-block md:w-[31%] w-[46.4%]  border border-gray-300 justify-center text-center overflow-hidden m-1 rounded hover:bg-gray-100 transition duration-150 ease-in-out">
                        <iframe width="560" height="315" src="{{ $view->url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <div class="truncate md:p-4 p-1">
                            {{ $view->url }}
                        </div>
                        <div class="md:p-2 p-1">
                            <div class="w-5/12 inline-block">
                                <svg class="inline-block w-2.5 md:w-7" xmlns="http://www.w3.org/2000/svg" x="0px"
                                     y="0px"
                                     viewBox="0 0 24 24"
                                     style=" fill:#000000;">
                                    <path
                                        d="M 12 2 C 6.4889971 2 2 6.4889971 2 12 C 2 17.511003 6.4889971 22 12 22 C 17.511003 22 22 17.511003 22 12 C 22 6.4889971 17.511003 2 12 2 z M 12 4 C 16.430123 4 20 7.5698774 20 12 C 20 16.430123 16.430123 20 12 20 C 7.5698774 20 4 16.430123 4 12 C 4 7.5698774 7.5698774 4 12 4 z M 11 6 L 11 12.414062 L 15.292969 16.707031 L 16.707031 15.292969 L 13 11.585938 L 13 6 L 11 6 z"></path>
                                </svg>
                                <div class="inline-block"> {{ $view->views }} Detik</div>
                            </div>
                            <div class="w-5/12 inline-block">
                                <img class="inline-block w-2.5 md:w-7"
                                     src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAAA70lEQVRIie3UP04CQRTH8c8KMR7AE1AaO29gwwU8Ar2lPZi4NJacgNgbjoDQWtuaLKEkxNZg4RI2O8ufZdfC6C/Z5s2b3/ftezPDv0poglVN33htGmUAq5oLjvKBNb1bwbSb8Qm0dQGn6GOGBHEaK+WzCxAL+xxXBUxshpUUAJKCvMDnZEsVOys5Mq90ix7K+uwbcuy7LZWHXOWY9vKAH79o2SG/1Gg+3p/ym9VCB0+YC4/nGwa4wXlmX9PmQl4cCotwiVs8Y5GDfeIVj3hPYzMFL+mhauAKdxhhKfzD4bHmRTrDNe4xxQfadQL+gL4ASwtvvtpZqD4AAAAASUVORK5CYII=">
                                <div class="inline-block">{{ $view->getCommissionFee() }}</div>
                            </div>

                        </div>
                    </div>
                </a>
            @empty
        </div>
        <div>Kosong</div>
        @endforelse

        {{ $views->links() }}

    </div>

    @include('users.viewers.footer.content', ['title' => 'Views'])
    @include('users.viewers.modals.views', ['content' => session('content')])

</x-app-layout>
