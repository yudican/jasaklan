<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dompet') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-2 md:grid-cols-4 gap-2 p-4">
                <x-secondary-box title="Buat Iklan Follower" value="follower" class="bg-green-500"/>
                <x-secondary-box title="Buat Iklan Komentar" value="komentar" class="bg-red-500"/>
                <x-secondary-box title="Buat Iklan Like" value="like" class="bg-cyan-500"/>
                <x-secondary-box title="Buat Iklan Posting" value="posting" class="bg-indigo-500"/>
                <x-secondary-box title="Buat Iklan Subscribe" value="subscribe" class="bg-pink-500"/>
                <x-secondary-box title="Buat Iklan Views" value="views" class="bg-orange-500"/>
                <x-secondary-box title="Buat Iklan View Questions" value="question" class="bg-purple-500"/>
            </div>
        </div>
    </div>
</x-app-layout>
