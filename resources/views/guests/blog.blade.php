<x-app-layout>
    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Posts Section -->
        <section class="w-full md:w-2/3 flex flex-col items-center px-3">

            @foreach ($blogs as $blog)
            <article class="flex flex-col shadow my-4">
                <!-- Article Image -->
                {{-- <a href="#" class="hover:opacity-75">
                    <img src="https://source.unsplash.com/collection/1346951/1000x500?sig=1">
                </a> --}}
                <!-- Column -->

                <div class="bg-white flex flex-col justify-start p-6">
                    {{-- <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">Technology</a> --}}
                    <a href="{{ route('blog-detail', strtolower(str_replace('--','-',str_replace([' ','?','/'],'-',$blog->title))).'-'.$blog->id) }}" class="text-3xl font-bold hover:text-gray-700 pb-4">{{$blog->title}}</a>
                    <p href="#" class="text-sm pb-3">
                        Published on {{date('d F Y', strtotime($blog->created_at))}}
                    </p>
                    <a href="{{ route('blog-detail', strtolower(str_replace('--','-',str_replace([' ','?','/'],'-',$blog->title))).'-'.$blog->id) }}" class="pb-6">{{substr(strip_tags($blog->body),0,200)}}...</a>
                    <a href="{{ route('blog-detail', strtolower(str_replace('--','-',str_replace([' ','?','/'],'-',$blog->title))).'-'.$blog->id) }}" class="uppercase text-gray-800 hover:text-black h-4">Continue Reading <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>
            @endforeach
        </section>

        <!-- Sidebar Section -->
        <aside class="w-full md:w-1/3 flex flex-col items-center px-3">

            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">Artikel Lainnya</p>
                @foreach ($blogs as $blog)
                <a href="{{ route('blog-detail', strtolower(str_replace('--','-',str_replace([' ','?','/'],'-',$blog->title))).'-'.$blog->id) }}" class="block border-b-2 pb-2">
                    <span class="">
                        <h3 class="text-green-darkest transition-colors duration-300 hover:text-green text-base font-body font-bold pb-1" {{$blog->title}}</h3>
                        <p class="text-green-darkest text-[13px] font-body pt-1">{{substr(strip_tags($blog->body),0,90)}}...</p>
                        <p class="font-body font-semibold text-green hover:text-blue transition-colors duration-300 text-xs pt-2">Read More »</p>
                    </span>
                </a>
                @endforeach
            </div>

            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <div class="w-full">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951" style="width:100%">
                </div>
            </div>

        </aside>

    </div>
</x-app-layout>