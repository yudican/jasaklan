<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Akun Bank') }}
        </h2>
    </x-slot>

    <div>
        <x-auth-card>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')"/>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors"/>

            @if(! blank($bank))
            <form method="POST" action="{{ route('withdraw.create') }}">
                @csrf

                <!-- Bank -->
                <div class="mt-4">
                    <x-label for="bank_id" :value="__('Pilih Bank')"/>

                    <x-select-input id="bank_id" class="block mt-1 w-full" type="text" name="bank_id"
                                   :value="old('bank_id', $bank->id)" required>
                        <option value="{{ $bank->id }}">{{ $bank->bank_name . ' - ' . $bank->account_name . ' (' . $bank->account_id . ')' }}</option>
                    </x-select-input>
                </div>

                <!-- Amount -->
                <div class="mt-4">
                    <x-label for="amount" :value="__('Jumlah')"/>

                    <x-input id="amount" class="block mt-1 w-full" type="text" name="amount"
                             :value="old('amount', $bank->amount)" required/>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')"/>

                    <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                             :value="old('password', $bank->password)" required/>
                </div>

                <div class="mt-4">
                    <x-button class="w-full text-center">
                        {{ __('Tarik') }}
                    </x-button>
                </div>
            </form>
            @endif
        </x-auth-card>
    </div>
</x-app-layout>
