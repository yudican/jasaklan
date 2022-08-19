<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Iklan Views') }}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto">
        <div class="grid grid-cols-3">
            <div class="col-span-3 mt-2 bg-green-200 flex p-4 mx-2 rounded">
                <p>Saldo Saat ini : <span class="font-semibold">{{ $user->getBalance() }}</span></p>
                <p class="ml-4 text-blue-600"><a href="{{ route('advertiser.deposit') }}">+ Isi Saldo</a></p>
            </div>
            <form action="{{ route('views.create') }}" method="post" class="w-full  mt-2 col-span-3">
                @csrf
                <div class="w-full px-3 my-2 max-w-sm">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-password">
                        *Paket View
                    </label>
                    <select onchange="setUrl()" name="social_media" id="social_media" class="w-full border rounded p-2"
                            value="{{ old('social_media', request()->get('social_media')) }}">
                        <option value="">Sosial Media</option>
                        <option value="youtube" @if(request()->get('social_media') == 'youtube') selected @endif>Youtube</option>
                        <option value="website" @if(request()->get('social_media') == 'website') selected @endif>Blog/Website</option>
                        <option value="tokopedia" @if(request()->get('social_media') == 'tokopedia') selected @endif>Tokopedia</option>
                        <option value="lazada" @if(request()->get('social_media') == 'lazada') selected @endif>Lazada</option>
                        <option value="shopee" @if(request()->get('social_media') == 'shopee') selected @endif>Shopee</option>
                        <option value="snack" @if(request()->get('social_media') == 'snack') selected @endif>Snack Video</option>
                        <option value="bigo" @if(request()->get('social_media') == 'bigo') selected @endif>Bigo Live</option>
                        <option value="tiktok" @if(request()->get('social_media') == 'tiktok') selected @endif>Tiktok</option>
                    </select>
                </div>
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-password">
                        *Url Iklan
                    </label>
                    <input
                        name="url"
                        class="appearance-none block w-full bg-white text-gray-700 border border-black rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-password" type="text" placeholder="">
                    <p class="text-gray-600 text-xs italic">Masukkan link video youtube atau url website Anda.</p>
                </div>
                <div class="w-full px-3 my-2 max-w-sm">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-password">
                        *Paket View
                    </label>
                    <select name="package_id" id="paket_view" class="w-full border rounded p-2"
                            value="{{ old('package_id') }}">
                        <option value="">Paket View</option>
                        @foreach($packages->slice(0, request()->get('slice') ?? 5) as $package)
                            <option data-price="{{ $package->price }}" value="{{ $package->id }}">{{ $package->getPackageName() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full px-3 mt-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-password">
                        *Jumlah Tayang
                    </label>
                    <input type="number" onchange="getTayang()" name="views" id="tayang" class="border rounded">
                    <p class="text-gray-600 text-xs italic">Jumlah tayang iklan minimal 500x</p>
                </div>
                <div class="w-full px-3 mt-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-password">
                        *Jumlah Bayar
                    </label>
                    <input type="text" disabled name="bayar" id="bayar" class="border rounded" value="0">
                </div>
                <div class="w-full px-3 mt-2 mb-2">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Kirim
                    </button>
                </div>


            </form>

        </div>
    </div>

    <script>

        let tayang = document.getElementById('tayang');
        let paket_view = document.getElementById('paket_view');
        let social_media = document.getElementById('social_media');

        paket_view.addEventListener("change", () => {
            solve();
        });

        function getTayang() {

            if (tayang.value < 500) {
                alert("Jumalah Tayang Minimal 500");

                return;
            }

            solve();
        }

        const solve = () => {
            const selected = paket_view.options[paket_view.selectedIndex];
            const packagePrice = selected.getAttribute('data-price');

            document.getElementById('bayar').value = packagePrice * tayang.value;
        }

        social_media.addEventListener("change", () => {
            let slice = 5;
            if(social_media.value == "youtube") {
                slice = 20;
            } else if(social_media.value == "bigo") {
                slice = 20;
            } else if(social_media.value == "youtube") {
                slice = 20;
            } else if(social_media.value == "snack") {
                slice = 20;
            }

            window.location.href = window.location.pathname + "?slice=" + slice + "&social_media=" + social_media.value;
        });


    </script>

</x-app-layout>
