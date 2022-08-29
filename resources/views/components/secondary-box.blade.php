<a href="{{ route('ads.create',  ['id' => $value]) }}" class="p-4 border rounded-lg {{ $class }}">
    <img src="{{$imgUrl}}" style="height: 30px;" />
    <div class="my-4">
        <span class="font-light text-white text-xl">{{ $title }}</span>
    </div>
</a>