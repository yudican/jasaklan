@if(! blank($content))
    <div id="konfirmasi" tabindex="-1" aria-hidden="true" class="fixed justify-center top-0 left-0 right-0 z-50 hidden w-full overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="relative w-full h-full max-w-md p-4 md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <button type="button" class="absolute top-3 right-2.5 text-black-400 bg-transparent hover:bg-black-200 hover:text-black-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-black-800 dark:hover:text-black" onclick="hideModalConfirmation()">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-black-900 dark:text-black">Ambil Tiket Views</h3>
                    <p class="mb-4 text-xs text-justify font-medium text-black-900 dark:text-black">Silahkan kunjungi halaman iklan dan lakukan Views kemudian screenshot sebagai bukti Anda sudah Views. Pastikan button Views dan nama akun Anda terlihat dengan jelas pada screenshot.</p>
                    <form enctype="multipart/form-data" class="space-y-6" action="{{ route('viewers.ticket.create') }}" method="post">
                        @csrf
                        <div>
                            <label for="text" class="block mb-2 text-sm font-medium text-black-900">URL Iklan</label>
                            <a href="{{ $content->url }}" aria-current="true" class="cursor-pointer text-sm text-blue-500 hover:text-blue-700">
                                {{ $content->url }}
                            </a>
                        </div>
                        <div>
                            <label for="text" class="block mb-2 text-sm font-medium text-black-900">Bonus Komisi</label>
                            <span aria-current="true" class="text-sm">
                            {{ $content->getCommissionFee() }}
                        </span>
                        </div>
                        <div>
                            <label for="text" class="block mb-2 text-sm font-medium text-black-900 dark:text-black-300">Nama akun Anda</label>
                            <input type="text" name="account_name" id="text" placeholder="Nama akun Anda" class="bg-black-50 border border-black-300 text-black-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-black-600 dark:border-black-500 dark:placeholder-black-400 dark:text-black" required>
                        </div>

                        <div>
                            <label for="file" class="block mb-2 text-sm font-medium text-black-900 dark:text-black-300">@if($content->commission >= 30) Screenshot Awal Video @else Screenshot @endif</label>
                            <input type="file" name="screenshot" id="file" class="bg-black-50 border border-black-300 text-black-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-black-600 dark:border-black-500 dark:placeholder-black-400 dark:text-black" required>
                        </div>
                        @if($content->commission >= 30)
                        <div>
                            <label for="file" class="block mb-2 text-sm font-medium text-black-900 dark:text-black-300">Screenshot Awal Video</label>
                            <input type="file" name="screenshot_akhir" id="file" class="bg-black-50 border border-black-300 text-black-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-black-600 dark:border-black-500 dark:placeholder-black-400 dark:text-black" required>
                        </div>
                        @endif
                        <div>
                            <label for="file" class="block mb-2 text-sm font-medium text-black-900 dark:text-black-300">Catatan Advertiser</label>
                            <p class="cursor-pointer text-sm ">
                                {{ $content->notes }}
                            </p>
                        </div>
                        <div class="flex justify-items-end">
                            <input type="hidden" name="ads_id" value="{{ $content->id }}">
                            <button type="submit" class="w-auto mr-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Konfirmasi</button>
                            <button type="button" onclick="hideModalConfirmation()" class="w-auto text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-blue-800">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
