<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kontak Kami') }}
            </h2>
        </div>
    </x-slot>
    <!-- konten -->
    <section class="static w-full">
        <div class="items-center xs:pl-10 mt-14 lg:mt-28">
            <!-- Content -->
            <div class="items-center m-2">
                <h2 class="font-bold text-3xl md:text-4 lg:text-3xl text-center mb-6">
                    Kontak Kami
                </h2>
                <p class=" lg:text-md text-center m-6 md:text-xs">
                    Bila ada yang ingin ditanyakan silahkan WA kami di 081372472631 (WA Only)
                </p>

                <div class="w-fullcontent-center">
                    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Nama Lengkap
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="username" type="text" placeholder="Username">
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                Email
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="email" type="text" placeholder="Email">

                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="judul">
                                    Judul Pesan
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="judul" type="text" placeholder="Judul">

                                <div class="mb-6">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="isi">
                                        Isi Pesan
                                    </label>
                                    <textarea
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="pesan" type="text" placeholder="Your message">
      </textarea>

                                    <div class="my-6 ">
                                        <input
                                            class="shadow appearance-none border rounded w-16 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="" type="text" placeholder="">
                                        <p class="inline">+</p>
                                        <input
                                            class="shadow appearance-none border rounded w-16 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="" type="text" placeholder="">
                                        <p class="inline">=</p>
                                        <input
                                            class="shadow appearance-none border rounded w-21 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="" type="text" placeholder="">

                                        <div class="grid grid-cols-2 md:grid-cols-1 gap-2 mb-10">
                                            <button type="button"
                                                    class="mt-8 mx-1 rounded-lg w-21 lg:ml-auto font-semibold px-4 py-2 tracking-wide border  transition-colors duration-200 transform text-white bg-blue-700 hover:bg-blue-400  focus:outline-none">
                                                Kirim Pesan
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            </div>

                    </form>

                </div>

            </div>

        </div>
    </section>

</x-app-layout>
