<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center w-1/3">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 text-gray-600" />
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('blog')" :active="request()->routeIs('blog')">
                        {{ __('Blog') }}
                    </x-nav-link>
                    <x-nav-link :href="route('tentang')" :active="request()->routeIs('tentang')">
                        {{ __('About Us') }}
                    </x-nav-link>
                    <x-nav-link :href="route('tos')" :active="request()->routeIs('tos')">
                        {{ __('Terms of Service') }}
                    </x-nav-link>
                </div>
            </div>

            <x-navbar-dropdown-content />

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link :href="route('dashboard')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('blog')" :active="request()->routeIs('blog')">
                {{ __('Blog') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('iklan')">
                {{ __('Panduan Pengiklan') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('viewer')">
                {{ __('Panduan Penonton Iklan') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('tos')">
                {{ __('Terms of Services') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('tentang')">
                {{ __('About Us') }}
            </x-responsive-nav-link>

            @guest
            <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                {{ __('Login') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                {{ __('Register') }}
            </x-responsive-nav-link>
            @endguest

            @auth
            <!-- Responsive Settings Options -->
            <div class="pb-1 border-t border-gray-200">
                {{-- <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div> --}}
                <div class="space-y-1">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>

            <div class="bg-gray-600 text-white relative">
                <div class="flex justify-center items-center py-4 responsive-auth-link">
                    <a href="#" class="text-white hover:text-white block text-center">
                        <span>
                            {{ Auth::user()->name }}
                        </span>
                    </a>
                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="responsive-nav-link h-0 transition-height overflow-hidden">
                    <x-responsive-nav-link :href="route('user.dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-black focus:text-black">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('user.profile')" class="text-white hover:text-black focus:text-black">
                        {{ __('Edit Profile') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('user.showPassword')" class="text-white hover:text-black focus:text-black">
                        {{ __('Ubah Password') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('user.referral')" class="text-white hover:text-black focus:text-black">
                        {{ __('Daftar Referral') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('user.bank')" class="text-white hover:text-black focus:text-black">
                        {{ __('Akun Bank') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('user.wallet')" class="text-white hover:text-black focus:text-black">
                        {{ __('Dompet') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('advertiser.deposit')" class="text-white hover:text-black focus:text-black">
                        {{ __('Deposit') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('advertisers.dashboard')" class="text-white hover:text-black focus:text-black">
                        {{ __('Buat Iklan') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('iklan.myads',['type'=>'views'])" class="text-white hover:text-black focus:text-black">
                        {{ __('Daftar Iklan View') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('iklan.myads',['type'=>'subscribe'])" class="text-white hover:text-black focus:text-black">
                        {{ __('Daftar Iklan Subscribe') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('iklan.myads',['type'=>'follower'])" class="text-white hover:text-black focus:text-black">
                        {{ __('Daftar Iklan Follow') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('iklan.myads',['type'=>'like'])" class="text-white hover:text-black focus:text-black">
                        {{ __('Daftar Iklan Like') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('iklan.myads',['type'=>'komentar'])" class="text-white hover:text-black focus:text-black">
                        {{ __('Daftar Iklan Komentar') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('iklan.myads',['type'=>'posting'])" class="text-white hover:text-black focus:text-black">
                        {{ __('Daftar Iklan Posting') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('iklan.myads',['type'=>'share'])" class="text-white hover:text-black focus:text-black">
                        {{ __('Daftar Iklan Share') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('viewers.ads.list',['type' => 'views'])" class="text-white hover:text-black focus:text-black">
                        {{ __('Lihat Iklan View') }}
                    </x-responsive-nav-link>

                    {{-- <x-responsive-nav-link :href="route('viewers.question')" class="text-white hover:text-black focus:text-black"> --}}
                        {{-- {{ __('Lihat Iklan View Questions') }} --}}
                        {{-- </x-responsive-nav-link> --}}

                    <x-responsive-nav-link :href="route('viewers.ads.list',['type' => 'subscribe'])" class="text-white hover:text-black focus:text-black">
                        {{ __('Lihat Iklan Subscribe') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('viewers.ads.list',['type' => 'follower'])" class="text-white hover:text-black focus:text-black">
                        {{ __('Lihat Iklan Follow') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('viewers.ads.list',['type' => 'like'])" class="text-white hover:text-black focus:text-black">
                        {{ __('Lihat Iklan Like') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('viewers.ads.list',['type' => 'comment'])" class="text-white hover:text-black focus:text-black">
                        {{ __('Lihat Iklan Komentar') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('viewers.ads.list',['type' => 'posting'])" class="text-white hover:text-black focus:text-black">
                        {{ __('Lihat Iklan Posting') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('viewers.ads.list',['type' => 'share'])" class="text-white hover:text-black focus:text-black">
                        {{ __('Lihat Iklan Posting') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('viewers.ticket.index')" class="text-white hover:text-black focus:text-black">
                        {{ __('Tiket Saya') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('viewers.revenue.index')" class="text-white hover:text-black focus:text-black">
                        {{ __('Penghasilan') }}
                    </x-responsive-nav-link>
                </div>
            </div>
            @endauth

        </div>
    </div>
    </div>
</nav>

@push('scripts')
<script>
    const authEl = document.querySelector('.responsive-auth-link')
        const resNavLink = document.querySelector('.responsive-nav-link')
        authEl.onclick = (e) => {
            e.preventDefault()
            resNavLink.classList.toggle('h-0')
        }
</script>
@endpush