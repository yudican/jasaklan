<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Blog') }}
            </h2>
        </div>
    </x-slot>

    <!-- konten -->
    <section class="static bg-slate-200">
        <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-4 lg:p-10 lg:m-10 lg:mb-0 p-5">
            @foreach ($blogs as $blog)
            <!-- Column -->
            <div class="max-w-sm rounded overflow-hidden shadow-lg">
                <div class="px-6 py-4">
                    <a href="{{ route('blog-detail', strtolower(str_replace('--','-',str_replace([' ','?','/'],'-',$blog->title))).'-'.$blog->id) }}" class="font-bold text-xl mb-2">{{$blog->title}}</a>
                    <p class="text-gray-700 text-base">
                        {{substr(strip_tags($blog->body),0,100)}}.
                    </p>
                </div>
            </div>
            <!-- END Column -->
            @endforeach
        </div>
    </section>

</x-app-layout>