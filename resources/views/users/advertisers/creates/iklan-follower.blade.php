<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Iklan Follower') }}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto">
        <div class="grid grid-cols-3">
            <div class="col-span-3">
                <div class="col-span-3 mt-2 bg-green-200 flex p-4 mx-2 rounded">
                    <p>Saldo Saat ini : <span class="font-semibold">{{ $user->getBalance() }}</span></p>
                    <p class="ml-4 text-blue-600"><a href="{{ route('advertiser.deposit') }}">+ Isi Saldo</a></p>
                </div>
                <div class="col-span-3 mt-2 bg-red-200  p-4 mx-2 rounded">
                    <p class="font-bold">Penting !</p>
                    <div class="ml-2 text-sm">
                        Layanan Follow/ikuti ini merupakan layanan real human (100 % tanpa BOT). yang melakukan Follow semuanya adalah member yang terdaftar di jasaklan.com. Saat ini member kami mencapai kurang lebih 600ribu member dan akan terus bertambah.
                    </div>
                </div>
            </div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form action="{{ route('follow.create') }}" class="w-full  mt-2 col-span-3" method="post">
                @csrf
                <div class="w-full px-3 mt-2 max-w-sm">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                        *Sosial Media
                    </label>
                    <select name="social_media" onchange="getPaket()" id="sosial_media" {{ old('social_media') }} class="w-full border rounded p-2">
                        <option value="">Pilih</option>
                        <option value="instagram">Instagram</option>
                        <option value="shopee">shopee</option>
                        <option value="tokopedia">tokopedia</option>
                        <option value="tiktok">tiktok</option>
                        <option value="twitter">twitter</option>
                    </select>
                </div>
                <div class="w-full px-3 mt-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                        *Url Iklan
                    </label>
                    <input name="url" class="appearance-none block w-full bg-white text-gray-700 border border-black rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="" value="{{ old('url') }}">
                    <p class="text-gray-600 text-xs italic" id="url_name"></p>
                </div>
                <div class="w-full px-3 mt-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                        *Nama Akun
                    </label>
                    <input name="account_name" class="appearance-none block w-full bg-white text-gray-700 border border-black rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="account_name" type="text" placeholder="" value="{{ old('account_name') }}">
                </div>
                <x-text-area name="notes" message="isi catatan untuk follower baru anda" label="Catatan">
                    {{ old('notes') }}
                </x-text-area>
                <div class="w-full px-3 mt-2 max-w-sm">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                        *Pilih Paket
                    </label>
                    <select name="package_id" id="paket_view" class="w-full border rounded p-2" value="{{ old('package_id') }}">
                        <option value="">Paket Follower</option>
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
        function getPaket(){
            let sosialmedia = document.getElementById('sosial_media').value;
            document.getElementById('url_name').innerHTML = "Masukan link url" + " " + sosialmedia;
        }
    </script>
</x-app-layout>>