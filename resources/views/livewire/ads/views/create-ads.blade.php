<div class="my-4">
    @if (auth()->user()->balance < $amount_to_pay) <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
        <span class="font-medium">Saldo Tidak Mencukupi</span> Silahkan Top Up Saldo Anda <a href="{{ route('advertiser.deposit') }}">di sini</a>
</div>
@endif
<div class="flex flex-row justify-between items-center mx-auto block p-6 max-w-lg my-4  bg-white rounded-xl border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mb-4">
    <h5 class="pb-0 text-lg font-bold tracking-tight text-gray-900 dark:text-white px-3">
        <span>Saldo</span> <br>
        <span class="text-sm font-normal">Rp. {{number_format(auth()->user()->balance)}}</span>
    </h5>
    <a href="{{ route('advertiser.deposit') }}">
        <x-button>Isi Saldo</x-button>
    </a>

</div>
<div class=" mx-auto block p-6 max-w-lg my-4  bg-white rounded-xl border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white px-3 mb-4">Buat Iklan</h5>
    <div class="w-full px-3  pb-4">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            *Jenis Iklan
        </label>
        <select wire:model="ads_type_id" id="paket_view" class="w-full border rounded p-2">
            <option value="">Pilih Jenis Iklan</option>
            @foreach($ads_types as $ads_type)
            <option value="{{ $ads_type->id }}">{{ $ads_type->type_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="w-full px-3  pb-4">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            *Platform Social Media
        </label>
        <select wire:model="social_media_id" id="paket_view" class="w-full border rounded p-2">
            <option value="">Pilih Platform Social Media</option>
            @foreach($social_medias as $social_media)
            <option value="{{ $social_media->id }}">{{ $social_media->social_media_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="w-full px-3  pb-4">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            *Jenis Paket
        </label>
        <select wire:model="ads_package_id" id="paket_view" class="w-full border rounded p-2">
            <option value="">Pilih Jenis Paket</option>
            @foreach($packages as $package)
            <option value="{{ $package->id }}">{{ $package->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="w-full px-3 pb-4">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            *Title
        </label>
        <input wire:model="ads_title" class="w-full border rounded p-2" id="grid-password" type="text" placeholder="">
        <p class="text-gray-600 text-xs italic">Masukkan judul Iklan</p>
    </div>
    <div class="w-full px-3 pb-4">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            *Url Iklan
        </label>
        <input wire:model="ads_url" class="w-full border rounded p-2" id="grid-password" type="text" placeholder="https://www.youtube.com/embed/mjwXC8WGY8w">
        <p class="text-gray-600 text-xs italic">Masukkan link video youtube atau url website Anda.</p>
    </div>
    <div class="w-full px-3 pb-4">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            *Jumlah Tayang
        </label>
        <input wire:model="number_of_views" class="w-full border rounded p-2" id="grid-password" type="text" placeholder="">
    </div>
    <div class="w-full px-3 pb-4">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            *Jumlah Bayar
        </label>
        <input wire:model="amount_to_pay" class="w-full border rounded p-2" id="grid-password" type="text" placeholder="" disabled>
    </div>
    <div class="w-full px-3 pb-4">
        @if (auth()->user()->balance < $amount_to_pay) <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" disabled>
            Buat Iklan
            </button>
            @else
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:click="saveAds">
                Buat Iklan
            </button>
            @endif

    </div>
</div>
</div>