<!-- Viewers Dropdown -->
<div class="hidden sm:flex sm:items-center sm:ml-6">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                <div>{{ __('Panduan') }}</div>
                <div class="ml-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>

        <x-slot name="content">

            <x-dropdown-link :href="route('iklan')">
                {{ __('Panduan Pengiklan') }}
            </x-dropdown-link>

            <x-dropdown-link :href="route('viewer')">
                {{ __('Panduan Penonton Iklan') }}
            </x-dropdown-link>

        </x-slot>
    </x-dropdown>

    @auth
    <!-- Viewers Dropdown -->
    <div class="ml-4 hidden sm:flex sm:items-center sm:ml-6">
        <x-dropdown class="mx-2" align="right" width="48">
            <x-slot name="trigger">
                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                    <div>{{ __('Viewers') }}</div>
                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">

                <x-dropdown-link :href="route('viewers.ads.list',['type'=>'views'])">
                    {{ __('Lihat Iklan View') }}
                </x-dropdown-link>

                <x-dropdown-link :href="route('viewers.ads.list',['type'=>'subscribe'])">
                    {{ __('Lihat Iklan Subscribe') }}
                </x-dropdown-link>

                <x-dropdown-link :href="route('viewers.ads.list',['type'=>'follower'])">
                    {{ __('Lihat Iklan Follow') }}
                </x-dropdown-link>

                <x-dropdown-link :href="route('viewers.ads.list',['type'=>'like'])">
                    {{ __('Lihat Iklan Like') }}
                </x-dropdown-link>

                <x-dropdown-link :href="route('viewers.ads.list',['type'=>'comment'])">
                    {{ __('Lihat Iklan Komentar') }}
                </x-dropdown-link>

                <x-dropdown-link :href="route('viewers.ads.list',['type'=>'posting'])">
                    {{ __('Lihat Iklan Posting') }}
                </x-dropdown-link>

                <x-dropdown-link :href="route('viewers.ads.list',['type'=>'share'])">
                    {{ __('Lihat Iklan Share') }}
                </x-dropdown-link>

                <x-dropdown-link :href="route('viewers.ticket.index')">
                    {{ __('Tiket Saya') }}
                </x-dropdown-link>

                <x-dropdown-link :href="route('viewers.revenue.index')">
                    {{ __('Penghasilan') }}
                </x-dropdown-link>

                {{-- <x-dropdown-link :href="route('user.dashboard')"> --}}
                    {{-- {{ __('Banner Referral') }} --}}
                    {{-- </x-dropdown-link> --}}
            </x-slot>
        </x-dropdown>

        <!-- Advertiser Dropdown -->
        <div class="ml-4 hidden sm:flex sm:items-center sm:ml-6">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="mr-4 flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                        <div>{{ __('Advertiser') }}</div>
                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('ads.create')">
                        {{ __('Buat Iklan') }}
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('iklan.myads',['type'=>'views'])">
                        {{ __('Daftar Iklan View') }}
                    </x-dropdown-link>

                    {{-- <x-dropdown-link :href="route('iklan.myads',['type'=>'question'])"> --}}
                        {{-- {{ __('Daftar Iklan View Questions') }} --}}
                        {{-- </x-dropdown-link> --}}

                    <x-dropdown-link :href="route('iklan.myads',['type'=>'subscribe'])">
                        {{ __('Daftar Iklan Subscribe') }}
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('iklan.myads',['type'=>'follower'])">
                        {{ __('Daftar Iklan Follow') }}
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('iklan.myads',['type'=>'like'])">
                        {{ __('Daftar Iklan Like') }}
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('iklan.myads',['type'=>'komentar'])">
                        {{ __('Daftar Iklan Komentar') }}
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('iklan.myads',['type'=>'posting'])">
                        {{ __('Daftar Iklan Posting') }}
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('iklan.myads',['type'=>'share'])">
                        {{ __('Daftar Iklan Share') }}
                    </x-dropdown-link>

                </x-slot>
            </x-dropdown>

            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                        <div>{{ Auth::user()->name }}</div>

                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">

                    <x-dropdown-link :href="route('user.dashboard')">
                        {{ __('Dashboard') }}
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('user.profile')">
                        {{ __('Edit Profile') }}
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('user.showPassword')">
                        {{ __('Ubah Password') }}
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('user.referral')">
                        {{ __('Daftar Referral') }}
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('user.bank')">
                        {{ __('Akun Bank') }}
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('user.wallet')">
                        {{ __('Dompet') }}
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('advertiser.deposit')">
                        {{ __('Deposit') }}
                    </x-dropdown-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
    @else
    <x-button class="ml-4">
        <a href="{{ route('register') }}">Register</a>
    </x-button>
    <x-button class="ml-4">
        <a href="{{ route('login') }}">Login</a>
    </x-button>
    @endauth
</div>