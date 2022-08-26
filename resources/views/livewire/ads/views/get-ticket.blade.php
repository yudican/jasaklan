<div>
    <div class="bg-white rounded-lg border border-gray-200 px-4 py-2 border-b my-2 rounded-t-lg flex justify-between items-center">
        <div class="py-2">
            <a aria-current="true" class="cursor-pointer font-medium text-blue-500 hover:text-blue-700">
                {{ $ads->title }}
            </a>
            <div class="py-2">
                <img class="inline-block w-[15px]" src="https://img.icons8.com/fluency-systems-regular/48/000000/money.png">
                <span class="text-xs">{{ $ads->getCommissionFee($type) }}</span>
            </div>
            <div>
                <img src="https://img.icons8.com/ios/50/000000/combi-ticket.png" class="inline-block w-[15px]" />
                <span class="text-xs">Sisa Tikets: {{ $ads->getTicket() }}</span>
            </div>
        </div>
        <div>
            <div class="flex flex-column justify-between py-4">
                <span class="px-3 py-2 bg-red-100  focus:ring-4 focus:outline-none focus:ring-gray-300 rounded text-center ">{{ $ads->social_media }}</span>
                <div class="mt-3">
                    @if($ads->alreadyGetTicket($ads->id))
                    <button class="text-white px-3 py-2 bg-blue-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        Sudah Diambil
                    </button>
                    @else
                    <button class="text-white px-3 py-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" wire:click="$emit('toggleModal')">
                        Ambil Tiket
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="ticket-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full" wire:ignore.self>
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-xl font-medium text-capitalize text-gray-900   pl-3">
                        Konfirmsi Ambil Tiket {{$ads->package->type}}
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" wire:click="$emit('toggleModal')">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-3 space-y-6">
                    <div class="shadow p-4 rounded-lg">
                        <p class="text-xs text-justify font-medium text-black-900 dark:text-black">Silahkan kunjungi halaman iklan dan lakukan {{$ads->package->type}} kemudian screenshot sebagai bukti Anda sudah {{$ads->package->type}}. Pastikan button {{$ads->package->type}} dan nama akun Anda
                            terlihat dengan jelas pada screenshot.</p>
                    </div>
                    <div class="shadow p-4 rounded-lg">
                        <div class="w-full pb-4">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                Judul Iklan
                            </label>
                            <a href="{{$ads->url}}" class="text-gray-600 text-xs">{{$ads->title}}</a>
                        </div>
                        <div class="w-full pb-4">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                Url Iklan
                            </label>
                            <a href="{{$ads->url}}" class="text-gray-600 text-xs">{{$ads->url}}</a>
                        </div>
                        <div class="w-full pb-4">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                Bonus Komisi Iklan
                            </label>
                            <p class="text-gray-600 text-xs">Rp {{number_format($ads->package->commission)}} / {{$ads->package->type}}</p>
                        </div>
                    </div>
                    <div class="shadow p-4 rounded-lg">
                        <div class="mb-4">
                            <label for="file" class="block mb-2 text-sm font-medium text-black-900 dark:text-black-300">Screenshot Awal</label>
                            <input type="file" wire:model="screenshot" id="file"
                                class="bg-black-50 border border-black-300 text-black-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-black-600 dark:border-black-500 dark:placeholder-black-400 dark:text-black" required>
                        </div>
                        <div>
                            <label for="file" class="block mb-2 text-sm font-medium text-black-900 dark:text-black-300">Screenshot Akhir</label>
                            <input type="file" wire:model="screenshot_akhir" id="file"
                                class="bg-black-50 border border-black-300 text-black-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-black-600 dark:border-black-500 dark:placeholder-black-400 dark:text-black" required>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex justify-between items-center p-3 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                    <button wire:click="$emit('toggleModal')" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Batal</button>
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" wire:click="applyTicket">Ambil
                        Tiket</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function(value) {
            var targetEl = document.getElementById('ticket-modal');
            var modal = new Modal(targetEl);
            window.livewire.on('toggleModal', (data) => {
                modal.toggle();
            });
        })
    </script>
    @endpush
</div>