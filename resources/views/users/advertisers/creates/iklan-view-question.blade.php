<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Iklan View Questions') }}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto">
        <div class="grid grid-cols-3">
            <div class="col-span-3 mt-2 bg-green-200 flex p-4 mx-2 rounded">
                <p>Saldo Saat ini : <span class="font-semibold">3000000</span></p>
                <p class="ml-4 text-blue-600"><a href="">+ Isi Saldo</a></p>
            </div>
            <div class="col-span-3 mt-2 bg-red-200  p-4 mx-2 rounded">
                <p class="font-bold">Penting !</p>
                <div class="ml-2 text-sm">
                    <p class="text-sm">Advertiser akan memberikan pertanyaan kepada viewers. Dimana jawabannya harus
                        berada di dalam video. viewers akan menonton video Anda guna menemukan jawaban atas pertanyaan
                        yang diajukan sehingga akan menjadi view dan jam tayang.</p>
                    <p class="text-sm">Siapkan pertanyaan yang sedikit sulit sehingga viewer akan menonton video Anda
                        dengan durasi yang lama. Misal : Berapa kali pembicara berdiri dari tempat duduknya? Berapa
                        jumlah pemain yang diganti?</p>
                </div>
            </div>
            <form action="" class="w-full  mt-2 col-span-3">
                @csrf
                <div class="w-full px-3 mt-2 max-w-sm">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-password">
                        *Sosial Media
                    </label>
                    <select name="pilih_paket" onchange="getPaket()" id="paket_view" class="w-full border rounded p-2">
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
                </div>
                <div class="w-full px-3 mt-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-password">
                        *Judul
                    </label>
                    <input name="judul"
                           class="appearance-none block w-full bg-white text-gray-700 border border-black rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                           id="grid-password" type="text" placeholder="">
                </div>
                <x-text-area name="pertanyaan" message="isi pertanyaan yanga akan di jawab oleh viewer"
                             label="Pertanyaan"/>
                <div class="w-full px-3 mt-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-password">
                        *Opsi jawaban
                    </label>
                    <div class="flex">
                        <p class="mr-2">A.</p><input name="jawaban_a"
                                                     class="appearance-none block w-full bg-white text-gray-700 border border-black rounded py-1 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                     id="grid-password" type="text" placeholder="jawaban A">
                    </div>
                    <div class="flex">
                        <p class="mr-2">B.</p><input name="jawaban_b"
                                                     class="appearance-none block w-full bg-white text-gray-700 border border-black rounded py-1 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                     id="grid-password" type="text" placeholder="jawaban B">
                    </div>
                    <div class="flex">
                        <p class="mr-2">C.</p><input name="jawaban_c"
                                                     class="appearance-none block w-full bg-white text-gray-700 border border-black rounded py-1 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                     id="grid-password" type="text" placeholder="jawaban C">
                    </div>
                    <div class="flex">
                        <p class="mr-2">D.</p><input name="jawaban_d"
                                                     class="appearance-none block w-full bg-white text-gray-700 border border-black rounded py-1 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                     id="grid-password" type="text" placeholder="jawaban D">
                    </div>
                    <div class="flex">
                        <p class="mr-2">E.</p><input name="jawaban_e"
                                                     class="appearance-none block w-full bg-white text-gray-700 border border-black rounded py-1 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                     id="grid-password" type="text" placeholder="jawaban E">
                    </div>
                </div>
                <div class="w-full px-3 mt-2 max-w-sm">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-password">
                        *Jawaban Benar
                    </label>
                    <select name="jawaban_benar" id="paket_view" class="w-full border rounded p-2">
                        <option value="">Pilih</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                    </select>
                </div>
                <div class="w-full px-3 mt-2 max-w-sm">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-password">
                        *Pilih Paket
                    </label>
                    <select name="paket" id="paket_view" class="w-full border rounded p-2">
                        <option value="">Paket View</option>
                        <option value="30000">Rp. 30,000 - 50 View Question</option>
                        <option value="60000">Rp. 60,000 - 100 View Question</option>
                        <option value="150000">Rp. 150,000 - 250 View Question</option>
                        <option value="300000">Rp. 300,000 - 500 View Question</option>
                        <option value="600000">Rp. 600,000 - 1000 View Question</option>
                        <option value="1500000">Rp. 1,500,000 - 2,500 View Question</option>
                        <option value="3000000">Rp. 3,000,000 - 5,000 View Question</option>
                        <option value="6000000">Rp. 6,000,000 - 10.000 View Question</option>
                    </select>
                </div>
                <div class="w-full px-3 mt-2 mb-2">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
