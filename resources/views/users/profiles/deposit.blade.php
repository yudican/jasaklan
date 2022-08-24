<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dompet') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @error('amount')
            <x-alert>{{ $message }}</x-alert>
            @enderror
            <p class="my-4">Masukkan nominal deposit Anda. Minimal deposit adalah Rp. {{number_format(getSetting('MINIMUM_DEPOSIT'))}}.</p>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-2 gap-2 p-4">
                <x-main-box title="Total Saldo" value="{{ (new \App\Models\Transaction())->getFormattedPrice($user->balance) }}" class="bg-blue-500" />
                <div>
                    <form action="{{ route('deposit.create') }}" method="post">
                        @csrf
                        <!-- Amount -->
                        <div>
                            <x-label for="amount" :value="__('Jumlah Deposit')" />

                            <x-input id="amount" class="block mt-1 w-full" type="text" name="amount" :value="old('amount')" required autofocus autocomplete="off" placeholder="100000" />
                        </div>
                        <div class="mt-4">
                            <x-button type="submit" id="pay-button" class="w-full">Deposit</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script type="text/javascript">
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay("{{ session('snapToken')}}", {
              onSuccess: function(result){
                /* You may add your own implementation here */
                alert("payment success!"); console.log(result);
                window.location.href = "{{ route('user.wallet') }}";
              },
              onPending: function(result){
                /* You may add your own implementation here */
                alert("wating your payment!"); console.log(result);
                window.location.href = "{{ route('user.wallet') }}";
              },
              onError: function(result){
                /* You may add your own implementation here */
                alert("payment failed!"); console.log(result);
              },
              onClose: function(){
                /* You may add your own implementation here */
                alert('you closed the popup without finishing the payment');
              }
            })
    </script>
    @endpush
</x-app-layout>