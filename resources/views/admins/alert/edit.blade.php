<x-guest-layout>
    <div class="flex gap-2">
        @include('admins.layouts.sidebar')
        <div class="m-12 w-full">
            <div class="w-full ">
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('admin.alert.update') }}">@csrf
                  <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                      Title
                    </label>
                    <input required name="title"  value="{{$alert->title}}" class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username">
                  </div>
                  <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                      Body
                    </label>
                    <textarea required name="body" class="content shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">{{$alert->body}}</textarea>
                  </div>
                  <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                      Update
                    </button>
                  </div>
                </form>
              </div>
        </div>
    </div>
</x-guest-layout>
