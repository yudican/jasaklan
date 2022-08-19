<x-guest-layout>
    <div class="flex gap-2">
        @include('admins.layouts.sidebar')
        <div class="m-12 w-full">
            <a href="{{ route('admin.blog.create') }}" class="font-semibold text-xl mb-12">Tambah Blog</a> 
            <div class="overflow-x-auto relative">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            Title
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Tanggal Upload
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($blogs as $blog)
                        <tr class="bg-white border-b">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                {{ $blog->title }}
                            </th>
                            <td class="py-4 px-6">
                                {{ $blog->created_at }}
                            </td>
                            <td class="py-4 px-6">
                                <a href="{{ route('admin.blog.destroy', $blog->id) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-guest-layout>
