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

            <form method="POST" action="{{ route('bank.update', $user->id) }}">
                @csrf
                @method('PUT')
                <!-- Account ID -->
                <div>
                    <x-label for="account_id" :value="__('Nomor Rekening')"/>

                    <x-input id="account_id" class="block mt-1 w-full" type="text" name="account_id"
                             :value="old('account_id', $bank->account_id)" required autofocus/>
                </div>

                <!-- Bank Name -->
                <div class="mt-4">
                    <x-label for="bank_name" :value="__('Nama Bank')"/>

                    <x-input id="bank_name" class="block mt-1 w-full" type="text" name="bank_name"
                             :value="old('bank_name', $bank->bank_name)" required/>
                </div>

                <!-- Branch -->
                <div class="mt-4">
                    <x-label for="branch" :value="__('Cabang')"/>

                    <x-input id="branch" class="block mt-1 w-full" type="text" name="branch"
                             :value="old('branch', $bank->branch)" required/>
                </div>

                <!-- Account Name -->
                <div class="mt-4">
                    <x-label for="account_name" :value="__('Nama Pemilik')"/>

                    <x-input id="account_name" class="block mt-1 w-full" type="text" name="account_name"
                             :value="old('account_name', $bank->account_name)" required/>
                </div>

                <div class="mt-4">
                    <x-button class="w-full text-center">
                        {{ __('Update') }}
                    </x-button>
                </div>
            </form>
        </x-auth-card>
    </div>
</x-app-layout>
