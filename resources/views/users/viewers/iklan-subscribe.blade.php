<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Iklan Subscribe') }}
            </h2>
        </div>
    </x-slot>
    <div class=" mx-2 block p-6 my-4  bg-white rounded-xl border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <h5 class=" text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Keterangan</h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">1. Setiap views member akan di bayar sesuai dengan yang tertera di bawah</p>
        <p class="font-normal text-gray-700 dark:text-gray-400">2. Dana akan masuk ke menu penghasilan setelah Advertiser melakukan pengecekan maksimal 7 hari.</p>
    </div>
    <div class="text-[10px] px-2 py-2 rounded">
        <div class=" text-[10px] py-4 rounded">
            @foreach($subscribers as $ads)
            <!-- component -->
            @livewire('ads.views.get-ticket', ['ads' => $ads])
            @endforeach
            @if (count($subscribers) == 0)
            <div class="mx-auto max-w-lg p-6 flex justify-center items-center">
                <div class="text-center">
                    <img src="{{asset('assets/img/empty.svg')}}" alt="" style="height:200">
                    <span class="mt-2">Belum Ada Iklan Disini</span>
                </div>
            </div>
            @endif
        </div>

        {{ $subscribers->links() }}

    </div>

    @include('users.viewers.footer.content', ['title' => 'Subscribe'])
    @include('users.viewers.modals.subscribe', ['content' => session('content')])

</x-app-layout>