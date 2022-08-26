<footer class="bg-white mt-10">
    <div class="grid lg:grid-cols-3 sm:grid-cols-1 gap-4 lg:p-10 lg:m-10 lg:mb-0 p-5 max-w-7xl mx-auto">
        <div class="mb-6 md:mb-0">
            <a href="https://flowbite.com/" class="flex items-center">
                <img src="/image/f54e60db-fcc4-428c-b384-f6b0e5d69b11.png" class="mr-3 h-8" alt="FlowBite Logo" />
            </a>
            <p>Jasaklan.com Jasa terpercaya untuk kebutuhan Social Media Facebook, Instagram, YouTube, Blog/ Web,
                Tiktok, Twitter, TumBLr, Linkedin, Pinterest, Lazada, Shopee, Tokopedia, Google Maps, Dan Ads.</p>
        </div>
        <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-2">
            <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">Beranda</h2>
                <ul class="text-gray-600 dark:text-gray-400">
                    <li>
                        <a href="http://jasaklan.com/user" class="hover:underline">My Account</a>
                    </li>
                    <li>
                        <a href="http://jasaklan.com/tentang_kami" class="hover:underline">About Us</a>
                    </li>
                    <li>
                        <a href="{{route('contact.us')}}" class="hover:underline">Contact Us</a>
                    </li>
                    <li>
                        <a href="{{route('disclaimer')}}" class="hover:underline">Disclaimer</a>
                    </li>
                    <li>
                        <a href="{{route('privacy.policy')}}" class="hover:underline">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="http://jasaklan.com/pengembalian" class="hover:underline">Return And Refund</a>
                    </li>
                    <li>
                        <a href="{{route('term.of.condition')}}" class="hover:underline">Terms And Conditions</a>
                    </li>
                </ul>
            </div>

            <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">Resources</h2>
                <ul class="text-gray-600 dark:text-gray-400">
                    <li>
                        <a href="http://jasaklan.com/advertiser/create" class="hover:underline ">Advertiser</a>
                    </li>
                    <li>
                        <a href="http://jasaklan.com/viewers/iklan-view" class="hover:underline">Viewer</a>
                    </li>
                    <li>
                        <a href="http://jasaklan.com/advertiser/tambah/iklan-subscribe" class="hover:underline">Daftar
                            Iklan</a>
                    </li>
                    <li>
                        <a href="http://jasaklan.com/viewers/iklan-view" class="hover:underline">Lihat Iklan</a>
                    </li>
                    <li>
                        <a href="http://jasaklan.com/viewers/blog" class="hover:underline">Blog</a>
                    </li>
                    <li>
                        <a href="http://jasaklan.com/view" class="hover:underline">Panduan Viewer</a>
                    </li>
                    <li>
                        <a href="http://jasaklan.com/iklan" class="hover:underline">Panduan Advertiser</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mb-6 md:mb-0">
            <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">Payment</h2>
            <img src="/image/f03965da-a4dd-44a2-bb8c-efe6a2a15668.png" class="flex items-center mr-3 w-full" alt="FlowBite Logo" />
        </div>
    </div>
    <div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#0099ff" fill-opacity="1"
                    d="M0,128L60,133.3C120,139,240,149,360,170.7C480,192,600,224,720,213.3C840,203,960,149,1080,138.7C1200,128,1320,160,1380,176L1440,192L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
                </path>
            </svg>
        </svg>
        <span class="md:bottom-2 bottom-1 w-full lg:text-md text-black text-center block lg:mt-2 lg:mb-2 ">
            2022 Copyright {{ env('APP_NAME') }}
        </span>
    </div>
</footer>