<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Referral') }}
        </h2>
    </x-slot>

    <div class="md:mx-12 mx-2 md:mt-12 mt-2">
        <x-referral-table :referrals="$user->myReferrals()->get()" />
    </div>
</x-app-layout>
