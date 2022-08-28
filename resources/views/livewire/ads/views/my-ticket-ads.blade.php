<div class="mx-12 mt-12">
    <div class="overflow-x-auto relative">
        <livewire:table.ticket-table params="{{request()->route()->getName()}}" />
    </div>


    {{-- reject modal --}}
    <div id="reject-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full" wire:ignore.self>
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-xl font-medium text-capitalize text-gray-900   pl-3">
                        Konfirmasi Reject
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" wire:click="$emit('toggleModalReject')">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-3 space-y-6">
                    <div class="w-full px-3 pb-4">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                            Catatan Reject
                        </label>
                        <input wire:model="notes" class="w-full border rounded p-2" id="grid-password" type="text" placeholder="">
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex justify-between items-center p-3 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                    <button wire:click="$emit('toggleModalReject')" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Batal</button>
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        wire:click="saveReject">Reject</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function(value) {
            var targetElReject = document.getElementById('reject-modal');
            var modalReject = new Modal(targetElReject);
            window.livewire.on('toggleModalReject', (data) => {
                modalReject.toggle();
            });
        })
    </script>
    @endpush
</div>