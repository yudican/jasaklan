<div>
    <div class=" mx-auto block p-6 w-full my-4  bg-white rounded-xl border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Keterangan</h5>
        @if (in_array($type,['follower','comment','follower','like','posting','share','subscribe']))
        <p class="font-normal text-gray-700 dark:text-gray-400">1. Setiap 1 {{$type}} member akan di bayar 200</p>
        @elseif(in_array($type,['views']))
        <p class="font-normal text-gray-700 dark:text-gray-400">1. Setiap views member akan di bayar sesuai dengan yang tertera di bawah</p>
        @endif
        <p class="font-normal text-gray-700 dark:text-gray-400">2. Dana akan masuk ke menu penghasilan setelah Advertiser melakukan pengecekan maksimal 7 hari.</p>
        @if (in_array($type,['follower','comment','follower','like','posting','share','subscribe']))
        <p class="font-normal text-gray-700 dark:text-gray-400">3. Member dilarang keras Un{{$type}}. Bila hal ini dilakukan maka akun akan dibanned dan tidak diperbolehkan mengikuti program ini selamanya.</p>
        @endif
    </div>

    @if ($type == 'views')
    <div class=" text-[10px] py-2 rounded">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Iklan View</h5>
        <div class="grid space-x-1 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 xs:grid-cols-12 text-[10px] py-2 text-center">
            @foreach($views as $view)
            <a href="{{route('viewers.view.detail',['ads_id' => $view->id])}}">
                <div class="inline-block border border-gray-300 justify-center text-center overflow-hidden m-1 rounded hover:bg-gray-100 transition duration-150 ease-in-out cursor-pointer">
                    {{-- <iframe width="560" height="315" src="{{ $view->url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
                    <img src="http://img.youtube.com/vi/{{$view->youtube_id}}/hqdefault.jpg" alt="">
                    <div class="truncate md:p-4 p-1">
                        {{ $view->url }}
                    </div>
                    <div class="md:p-2 p-1">
                        <div class="w-5/12 inline-block">
                            <svg class="inline-block w-2.5 md:w-7" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 24 24" style=" fill:#000000;">
                                <path
                                    d="M 12 2 C 6.4889971 2 2 6.4889971 2 12 C 2 17.511003 6.4889971 22 12 22 C 17.511003 22 22 17.511003 22 12 C 22 6.4889971 17.511003 2 12 2 z M 12 4 C 16.430123 4 20 7.5698774 20 12 C 20 16.430123 16.430123 20 12 20 C 7.5698774 20 4 16.430123 4 12 C 4 7.5698774 7.5698774 4 12 4 z M 11 6 L 11 12.414062 L 15.292969 16.707031 L 16.707031 15.292969 L 13 11.585938 L 13 6 L 11 6 z">
                                </path>
                            </svg>
                            <div class="inline-block"> {{ $view->package->benefits }} Detik</div>
                        </div>
                        <div class="w-5/12 inline-block">
                            <img class="inline-block w-2.5 md:w-7" src="https://img.icons8.com/fluency-systems-regular/48/000000/money.png">
                            <div class="inline-block">{{ $view->getCommissionFee() }}</div>
                        </div>

                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @if (count($views) == 0)
        <div class="mx-auto max-w-lg p-6 flex justify-center items-center">
            <div class="text-center">
                <img src="{{asset('assets/img/empty.svg')}}" alt="" style="height:200">
                <span class="mt-2">Belum Ada Iklan Disini</span>
            </div>
        </div>
        @endif
        {{ $views->links() }}
    </div>
    @endif

    <div class=" text-[10px] py-4 rounded">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Iklan @isset($type) {{$type}} @endisset</h5>
        @foreach($view_tickets as $ads)
        <!-- component -->
        @livewire('ads.views.get-ticket', ['ads' => $ads,'type' => $type])
        @endforeach
        @if (count($view_tickets) == 0)
        <div class="mx-auto max-w-lg p-6 flex justify-center items-center">
            <div class="text-center">
                <img src="{{asset('assets/img/empty.svg')}}" alt="" style="height:200">
                <span class="mt-2">Belum Ada Iklan Disini</span>
            </div>
        </div>
        @endif
    </div>

    {{ $view_tickets->links() }}

</div>

{{-- @include('users.viewers.footer.content', ['title' => 'Views']) --}}
</div>