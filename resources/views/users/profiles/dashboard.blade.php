<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Selamat datang, ' . $user->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto m-5 sm:px-6 lg:px-8">
            <div role="alert m-3">
                <div class="bg-blue-500  text-white font-bold rounded-t px-4 py-2">
                    {{$alert->title}}
                </div>
                <div class="border border-t-0 border-blue-400 rounded-b bg-blue-400 px-4 py-3 text-white">
                  <p>{{$alert->body}}.</p>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 md:grid-cols-4 gap-2">
                <div class="p-6 md:col-span-1 my-auto">
                    <span class="font-medium text-lg">
                        Link Referral
                    </span>
                </div>
                <div class="p-6 md:col-span-2">
                    <input class="w-full rounded-lg" type="text" value="{{ $user->getReferralUrl() }}" readonly>
                </div>
                <div class="p-6 md:col-span-1 my-auto">
                    <a href="{{ $user->getShareOnWa() }}" class="rounded-lg bg-blue-600 p-2 mx-0.5">
                        <i class="fa-brands fa-whatsapp text-white pl-1"></i>
                    </a>
                    <a href="{{ $user->getShareOnFb() }}" class="rounded-lg bg-blue-600 p-2 mx-0.5">
                        <i class="fa-brands fa-facebook text-white pl-1"></i>
                    </a>
                    <a href="{{ $user->getShareOnTwitter() }}" class="rounded-lg bg-blue-600 p-2 mx-0.5">
                        <i class="fa-brands fa-twitter text-white pl-1"></i>
                    </a>
                    <a href="{{ $user->getShareOnLinkedIn() }}" class="rounded-lg bg-blue-600 p-2 mx-0.5">
                        <i class="fa-brands fa-linkedin text-white pl-1"></i>
                    </a>
                    <a href="{{ $user->getShareOnEmail() }}" class="rounded-lg bg-blue-600 p-2 mx-0.5">
                        <i class="fa-regular fa-envelope text-white px-1"></i>
                    </a>
                </div>
            </div>
            <div class="mx-12 mt-4">
                <p>Promosikan link refferal diatas pada di blog/website Anda. Anda akan mendapatkan bonus komisi 5% dari setiap member yang melakukan deposit dan terdaftar melalui link refferal Anda.</p>
            </div>
        </div>
    </div>
</x-app-layout>
