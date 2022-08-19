<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tentang Kami') }}
            </h2>
        </div>
    </x-slot>

    <!-- konten -->
    <section class="static w-full">
        <div class="items-center xs:pl-10 lg:mt-10">
            <!-- Content -->
            <div class="items-center m-2">
                <h2 class="font-bold text-3xl md:text-4 lg:text-3xl text-center mb-6">
                    {{$blog->title}}
                </h2>
                <p class="text-lg text-justify m-6">
                    {!!$blog->body!!}
                </p>


            </div>
        </div>
    </section>

</x-app-layout>
