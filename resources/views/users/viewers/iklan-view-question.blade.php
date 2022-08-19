<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Iklan View Question') }}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto p-2 bg-red-200 mt-2 rounded">
        <div class="font-semibold text-xl ">
            Keterangan
        </div>
        <ul class="ml-4">
            <li>1.Setiap 1 Subscribermember akan di bayar Rp. 450</li>
            <li>2.Dana akan masuk ke menu penghasilan setelah Advertiser melakukan pengecekan maksimal 7 hari.</li>
            <li>3.Member dilarang keras Unsub. Bila hal ini dilakukan maka akun akan dibanned dan tidak diperbolehkan
                mengikuti program ini selamanya.</li>
            <li>4.List member yang dibanned akibat unsub</li>
        </ul>
    </div>
    <div class="container p-2 mx-auto bg-slate-100 mt-2 rounded">
        <div class="grid sm:grid-cols-3 gap-2 grid-cols-1">
            <div class="col-span-2">
                <a class="text-blue-400 font-bold"
                    href="https://www.youtube.com/watch?v=YPb9VVRNCeU">https://www.youtube.com/watch?v=YPb9VVRNCeU</a>
                <div class="flex mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" viewBox="0 0 576 512">
                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path
                            d="M252 208C252 196.1 260.1 188 272 188H288C299 188 308 196.1 308 208V276H312C323 276 332 284.1 332 296C332 307 323 316 312 316H264C252.1 316 244 307 244 296C244 284.1 252.1 276 264 276H268V227.6C258.9 225.7 252 217.7 252 208zM512 64C547.3 64 576 92.65 576 128V384C576 419.3 547.3 448 512 448H64C28.65 448 0 419.3 0 384V128C0 92.65 28.65 64 64 64H512zM128 384C128 348.7 99.35 320 64 320V384H128zM64 192C99.35 192 128 163.3 128 128H64V192zM512 384V320C476.7 320 448 348.7 448 384H512zM512 128H448C448 163.3 476.7 192 512 192V128zM288 144C226.1 144 176 194.1 176 256C176 317.9 226.1 368 288 368C349.9 368 400 317.9 400 256C400 194.1 349.9 144 288 144z" />
                        </svg>
                    <div class="ml-2">Rp.450/ view</div>
                </div>
            </div>
            <div class="cols-span-1 flex">
                <div>
                    <div class="bg-red-400 w-[4rem] text-center rounded text-white text-sm">youtube</div>
                    <div class="text-slate-500 font-thin italic">Tiket Habis</div>
                </div>
                <div>
                    <button type="button" class="bg-green-400 p-2 py-auto text-white rounded sm:text-sm text-xs ml-2">
                        Ambil Tiket
                        Follow</button>
                </div>
                <div>
                    <button type="button" class="bg-blue-400 p-2 py-auto text-white rounded sm:text-sm text-xs ml-2"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">Konfirmasi tiket</button>
                </div>
            </div>
        </div>
        <hr class="bg-slate-800">
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi View Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="">
                    <div class="modal-body">

                        <div class="w-full px-3 mt-2">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-password">
                                Url Iklan
                            </label>
                            <input name="url" disabled
                                class="appearance-none block w-full bg-white text-gray-700 border  rounded py-1 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-password" type="text" placeholder="" value="test123">
                            <p class="text-gray-600 text-xs italic" id="url_name"></p>
                        </div>
                        <div class="w-full px-3 mt-2">
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Pertanyaan</label>
                            <textarea name="" id="message" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-600 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="" disabled >Lorem ipsum, </textarea>
                        </div>
                        <div class="w-full px-3 mt-2">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-password">
                                *Opsi jawaban
                            </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                  A.Default radio
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                  B.Default checked radio
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                  C.Default radio
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                  D.Default checked radio
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                  E.Default checked radio
                                </label>
                              </div>
                        </div>
                        <div class="w-full px-3 mt-2">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-password">
                                Bonus Komisi
                            </label>
                            <input name="url" disabled
                                class=" appearance-none block w-full bg-white text-gray-700 border  rounded py-1 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-password" type="text" placeholder="" value="Rp.450">
                            <p class="text-gray-600 text-xs italic" id="url_name"></p>
                        </div>
                        <span class="text-xs text-slate-400">Konfirmasi tiket ini sebelum 13 Jul 2022 13:05 atau otomatis dibatalkan.</span>
                            
                    </div>
                    <div class="modal-footer">
                        <div>
                            <button type="submit"
                                class="bg-blue-400 p-2 py-auto text-white rounded  ml-2">Konfirmasi</button>
                        </div>
                        <div>
                            <button type="button" class="bg-red-400 p-2 py-auto text-white rounded  ml-2"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

</x-app-layout>
