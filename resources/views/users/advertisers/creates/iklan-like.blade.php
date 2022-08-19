<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Iklan Like') }}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto">
        <div class="grid grid-cols-3">
            <div class="col-span-3 mt-2 bg-green-200 flex p-4 mx-2 rounded">
                <p>Saldo Saat ini : <span class="font-semibold">{{ $user->getBalance() }}</span></p>
                <p class="ml-4 text-blue-600"><a href="{{ route('advertiser.deposit') }}">+ Isi Saldo</a></p>
            </div>
            <form action="{{ route('like.create') }}" method="post" class="w-full mt-2 col-span-3">
                @csrf
                <div class="w-full px-3 mt-2 max-w-sm">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-password">
                        *Sosial Media
                    </label>
                    <select name="social_media" value="{{ old('social_media') }}" onchange="getPaket()" id="sosial_media"
                            class="w-full border rounded p-2">
                        <option value="">Pilih</option>
                        <option value="instagram">Instagram</option>
                        <option value="facebook">facebook</option>
                        <option value="google map">google map</option>
                        <option value="tiktok">tiktok</option>
                        <option value="twitter">twitter</option>
                        <option value="youtube">youtube</option>
                    </select>
                </div>
                <div class="w-full px-3 mt-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-password">
                        *Url Iklan
                    </label>
                    <input name="url"
                           value="{{ old('url') }}"
                           class="appearance-none block w-full bg-white text-gray-700 border border-black rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                           id="grid-password" type="text" placeholder="">
                    <p class="text-gray-600 text-xs italic" id="url_name"></p>
                </div>
                <div class="w-full px-3 mt-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-password">
                        *Judul
                    </label>
                    <input name="title"
                           value="{{ old('title') }}"
                           class="appearance-none block w-full bg-white text-gray-700 border border-black rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                           id="grid-password" type="text" placeholder="">
                </div>

                <div class="w-full px-3 mt-2 max-w-sm">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-password">
                        *Pilih Paket
                    </label>
                    <select name="package_id" id="paket_view" class="w-full border rounded p-2" value="{{ old('package_id') }}">
                        <option value="">Paket Like</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}">{{ $package->getPackageName() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full px-3 mt-2 mb-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function getPaket() {
            let sosialmedia = document.getElementById('sosial_media').value;
            document.getElementById('url_name').innerHTML = "Masukan link url" + " " + sosialmedia;
        }
    </script>
</x-app-layout>
