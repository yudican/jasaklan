<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-2 md:grid-cols-4 gap-2 p-4">
            @foreach ($adsTypes as $item)
            <x-secondary-box title="{{$item->type_name}}" value="{{$item->id}}" class="bg-{{getRandomColor()}}-500" imgUrl="{{$item->icon}}" />
            @endforeach
        </div>
    </div>
</div>