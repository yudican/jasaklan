<div class="py-12">
    <div class=" mx-auto block p-6 max-w-4xl my-4  bg-white rounded-xl border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900  ">Keterangan</h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">1. Silahkan Masukkan nominal deposit dan pilih channel pembayarannya</p>
        <p class="font-normal text-gray-700 dark:text-gray-400">2. Lakukan transfer ke bank atau channel pembayaran yang dipilih sesuai nominal yang dimasukkan</p>
        <p class="font-normal text-gray-700 dark:text-gray-400">3. Jika sudah melakukan transfer silahkan lakukan konfirmasi pembayaran, supaya dapat segera di proses oleh admin</p>
        <p class="font-normal text-gray-700 dark:text-gray-400">4. Kami tidak menerima transfer pulsa, bila sudah terlanjur maka tidak ada refund.</p>
        <p class="font-normal text-gray-700 dark:text-gray-400">5. Minimal deposit adalah Rp. {{number_format(getSetting('MINIMUM_DEPOSIT'))}}.</p>
    </div>
    @if ($showConfirm)
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center">
            <ul class="w-1/2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600   pr-4">
                <li class="py-2 px-4 w-full rounded-t-lg border-b border-gray-200 dark:border-gray-600 flex justify-between align-items-center">
                    <span>Nominal</span>
                    <span>Rp {{$deposit_amount}}</span>
                </li>
                <li class="py-2 px-4 w-full border-b border-gray-200 dark:border-gray-600 flex justify-between align-items-center">
                    <span>Bank Pembayaran</span>
                    <span>{{$pembayaran}}</span>
                </li>
                <li class="py-2 px-4 w-full border-b border-gray-200 dark:border-gray-600 flex justify-between align-items-center">
                    <img src="{{asset('assets/img/'.$pembayaran.'.jpeg')}}" alt="" style="height: 250px;">
                </li>
            </ul>
            <div class="w-1/2 pl-4">
                <div>
                    <label for="" class="block font-medium text-sm text-gray-700 mb-2">Bank Asal</label>
                    <input type="text" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model="bank_asal" placeholder="Masukkan Bank Asal">
                    <small id="helpId" class="text-danger">{{ $errors->has('bank_asal') ? $errors->first('bank_asal') : '' }}</small>
                </div>
                <div>
                    <label for="" class="block font-medium text-sm text-gray-700 mb-2">Bank Tujuan</label>
                    <input type="text" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model="bank_tujuan" placeholder="Masukkan Bank Tujuan">
                    <small id="helpId" class="text-danger">{{ $errors->has('bank_tujuan') ? $errors->first('bank_tujuan') : '' }}</small>
                </div>
                <div>
                    <label for="" class="block font-medium text-sm text-gray-700 mb-2">Nama Rekening Bank</label>
                    <input type="text" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model="bank_nama_rekening" placeholder="Masukkan Nama Rekening">
                    <small id="helpId" class="text-danger">{{ $errors->has('bank_nama_rekening') ? $errors->first('bank_nama_rekening') : '' }}</small>
                </div>
                <div>
                    <label for="file" class="block mb-2 text-sm font-medium text-black-900 dark:text-black-300">Bukti Transfer</label>
                    <input type="file" wire:model="bank_bukti_transfer" id="file"
                        class="bg-black-50 border border-black-300 text-black-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-black-600 dark:border-black-500 dark:placeholder-black-400 dark:text-black" required>
                    <small id="helpId" class="text-danger">{{ $errors->has('bank_bukti_transfer') ? $errors->first('bank_bukti_transfer') : '' }}</small>
                </div>
                <div class="mt-4">
                    <button type="button" id="pay-button"
                        class="w-full items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                        wire:click="uploadBukti">Upload Bukti</button>
                </div>
            </div>
        </div>
        <div>
        </div>
    </div>
    @else
    <div class="max-w-4xl mx-auto ">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-2 gap-2 p-4">
            <x-main-box title="Total Saldo" value="Rp {{ number_format(auth()->user()->balance) }}" class="bg-blue-500" />
            <div>
                <div>
                    <label for="" class="block font-medium text-sm text-gray-700 mb-2">Input Deposit</label>
                    <input type="text" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model="deposit_amount" placeholder="{{ getSetting('MINIMUM_DEPOSIT') }}">
                    <small id="helpId" class="text-danger">{{ $errors->has('deposit_amount') ? $errors->first('deposit_amount') : '' }}</small>
                </div>
                <div class="mt-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                        Metode Pembayaran
                    </label>
                    <select wire:model="pembayaran" id="paket_view" class="w-full border rounded p-2">
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="bri">Bank Bri</option>
                        <option value="bca">Bank Bca</option>
                        <option value="dana">Dana</option>
                        <option value="ovo">Dana</option>
                        <option value="paypal">Paypal</option>
                    </select>
                    <small id="helpId" class="text-danger">{{ $errors->has('pembayaran') ? $errors->first('pembayaran') : '' }}</small>
                </div>
                <div class="mt-4">
                    <button type="button" id="pay-button"
                        class="w-full items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                        wire:click="deposit">Deposit</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>