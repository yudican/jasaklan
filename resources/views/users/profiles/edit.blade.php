<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profil') }}
        </h2>
    </x-slot>

    <div>
        <x-auth-card>
            {{-- <x-slot name="logo">
                @if(! $user->hasVerifiedEmail())
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                    <span class="font-medium">
                        Verifikasi Email!
                    </span>
                    Silakan
                    <a class="underline" href="{{ route('verification.send') }}" onclick="event.preventDefault();
                               document.getElementById('resend-email').submit();">klik disini</a>
                    untuk verifikasi email.
                </div>
                <form id="resend-email" method="POST" action="{{ route('verification.send') }}">
                    @csrf
                </form>
                @endif
            </x-slot> --}}

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('user.update', $user->id) }}">
                @csrf
                @method('PUT')
                <!-- Name -->
                <div>
                    <x-label for="name" :value="__('Nama Lengkap')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required />
                </div>

                <!-- Address -->
                <div class="mt-4">
                    <x-label for="address" :value="__('Alamat')" />

                    <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', $user->address)" />
                </div>

                <!-- City -->
                <div class="mt-4">
                    <x-label for="city" :value="__('Kota')" />

                    <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city', $user->city)" />
                </div>

                <!-- State -->
                <div class="mt-4">
                    <x-label for="state" :value="__('Provinsi')" />

                    <x-input id="state" class="block mt-1 w-full" type="text" name="state" :value="old('state', $user->state)" />
                </div>

                <!-- State -->
                <div class="mt-4">
                    <x-label for="postal_code" :value="__('Kode Pos')" />

                    <x-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" :value="old('postal_code', $user->postal_code)" />
                </div>

                <!-- State -->
                <div class="mt-4">
                    <x-label for="phone" :value="__('No. Telepon')" />

                    <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', $user->phone)" required />
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