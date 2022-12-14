<div class="my-4">
    @if (auth()->user()->balance < $amount_to_pay) <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
        <span class="font-medium">Saldo Tidak Mencukupi</span> Silahkan Top Up Saldo Anda <a href="{{ route('advertiser.deposit') }}">di sini</a>
</div>
@endif
@if($adsType->type_label == 'posting')
<div class=" mx-auto block p-6 max-w-4xl my-4  bg-white rounded-xl border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900  ">Penting</h5>
    <p class="font-normal text-gray-700 dark:text-gray-400">1. Gambar dan caption akan diposting oleh member/viewer diakun mereka.</p>
    <p class="font-normal text-gray-700 dark:text-gray-400">2. Dilarang menjatuhkan jasa/produk orang.</p>
</div>
@endif
<div class="flex flex-row justify-between items-center mx-auto block p-6 max-w-lg my-4  bg-white rounded-xl border border-gray-200 shadow-md hover:bg-gray-100 ">
    <h5 class="pb-0 text-lg font-bold tracking-tight text-gray-900 px-3">
        <span>Saldo</span> <br>
        <span class="text-sm font-normal">Rp. {{number_format(auth()->user()->balance)}}</span>
    </h5>
    <a href="{{ route('advertiser.deposit') }}">
        <x-button>Isi Saldo</x-button>
    </a>

</div>
<div class=" mx-auto block p-6 max-w-lg my-4  bg-white rounded-xl border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 px-3 mb-4">Buat Iklan {{$adsType->type_name}}</h5>
    {{-- @if($adsType->type_label == 'views')
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
    @endif --}}
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
    @if(in_array($adsType->type_label,['posting']))
    <div class="w-full px-3 pb-4">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            *Caption
        </label>
        <textarea wire:model="ads_notes" class="w-full border rounded p-2" id="grid-password" type="text" placeholder="Isi Caption yang diisi oleh publisher"></textarea>
    </div>
    @endif
    @if(in_array($adsType->type_label,['subscribe']))
    <div class="w-full px-3 pb-4">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            *Catatan
        </label>
        <textarea wire:model="ads_notes" class="w-full border rounded p-2" id="grid-password" type="text" placeholder="Isi Catatan Untuk Calon Subcriber anda"></textarea>
    </div>
    @endif
    @if($adsType->type_label == 'posting')
    <div class="px-3 mb-4">
        <label for="file" class="block mb-2 text-sm font-medium text-black-900 dark:text-black-300">Photo</label>
        <input type="file" wire:model="ads_photo" id="file" class="bg-black-50 border border-black-300 text-black-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-black-600 dark:border-black-500 dark:placeholder-black-400 dark:text-black" required>
    </div>
    @endif
    @if($adsType->type_label != 'posting')
    <div class="w-full px-3 pb-4">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            *Url Iklan
        </label>
        @if($adsType->type_label == 'views')
        <span>
            <input wire:model="ads_url" class="w-full border rounded p-2" id="grid-password" type="text" placeholder="https://www.youtube.com/watch?v=jfrOx3FbSGA">
            <p class="text-gray-600 text-xs italic">Masukkan link video youtube atau url website Anda.</p>
        </span>
        @elseif($adsType->type_label == 'follower')
        <input wire:model="ads_url" class="w-full border rounded p-2" id="grid-password" type="text" placeholder="Masukkan link profile social media">
        <p class="text-gray-600 text-xs italic">Masukkan link url profile Anda.</p>
        @else
        <input wire:model="ads_url" class="w-full border rounded p-2" id="grid-password" type="text" placeholder="masukkan link url iklan anda">
        @endif
    </div>
    @endif

    <div class="w-full px-3 pb-4">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            *Jumlah Tayang
        </label>
        @if($adsType->type_label == 'views')
        <input wire:model="number_of_views" class="w-full border rounded p-2" id="grid-password" type="text" placeholder="">
        @else
        <input value="{{$number_of_views}}" class="w-full border rounded p-2" id="grid-password" type="text" placeholder="" readonly>
        @endif

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