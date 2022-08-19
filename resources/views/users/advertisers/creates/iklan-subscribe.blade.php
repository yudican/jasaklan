<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Iklan Subscribe') }}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto">
        <div class="grid grid-cols-3">
            <div class="col-span-3 mt-2 bg-green-200 flex p-4 mx-2 rounded">
                <p>Saldo Saat ini : <span class="font-semibold">{{ $user->getBalance() }}</span></p>
                <p class="ml-4 text-blue-600"><a href="{{ route('advertiser.deposit') }}">+ Isi Saldo</a></p>
            </div>
            <form action="{{ route('subscribe.create') }}" method="post" class="w-full  mt-2 col-span-3">
                @csrf
                <div class="w-full px-3 mt-2 max-w-sm">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-password">
                        *Sosial Media
                    </label>
                    <select name="social_media" id="paket_view" class="w-full border rounded p-2">
                        <option value="">Pilih</option>
                        <option value="youtube">Youtube</option>
                    </select>
                </div>
                <div class="w-full px-3 mt-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-password">
                        *Url Iklan
                    </label>
                    <input name="url"
                           class="appearance-none block w-full bg-white text-gray-700 border border-black rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                           id="grid-password" type="text" placeholder="">
                    <p class="text-gray-600 text-xs italic">Masukkan link video youtube atau url youtube.</p>
                </div>
                <div class="w-full px-3 mt-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-password">
                        *Judul
                    </label>
                    <input name="title"
                           class="appearance-none block w-full bg-white text-gray-700 border border-black rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                           id="grid-password" type="text" placeholder="">
                </div>
                <x-text-area name="notes" message="Caption untuk postingan anda" label="Caption">
                    {{ old('notes') }}
                </x-text-area>
                <div class="w-full px-3 mt-2 max-w-sm">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-password">
                        *Paket View
                    </label>
                    <select name="package_id" id="paket_view" class="w-full border rounded p-2" value="{{ old('package_id') }}">
                        <option value="">Paket Subscribe</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}">{{ $package->getPackageName() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full px-3 mt-2 mb-2 ">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Kirim
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>
