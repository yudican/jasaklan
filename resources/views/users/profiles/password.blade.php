<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ubah Password') }}
        </h2>
    </x-slot>

    <div>
        <x-auth-card>
            <x-slot name="logo">

            </x-slot>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')"/>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors"/>

            <form method="POST" action="{{ route('user.password', $user->id) }}">
                @csrf
                @method('PUT')
                <!-- Password Lama -->
                <div>
                    <x-label for="old_password" :value="__('Password Lama')"/>

                    <x-input id="old_password" class="block mt-1 w-full" type="password" name="old_password" required/>
                </div>

                <!-- Password Baru -->
                <div class="mt-4">
                    <x-label for="new_password" :value="__('Password Baru')"/>

                    <x-input id="new_password" class="block mt-1 w-full" type="password" name="password" required/>
                </div>

                <div class="mt-4">
                    <x-button class="w-full text-center">
                        {{ __('Ubah Password') }}
                    </x-button>
                </div>
            </form>
        </x-auth-card>
    </div>
</x-app-layout>
