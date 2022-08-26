<div class="mx-12 mt-12">
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900  ">Iklan @isset($type) {{$type}} @endisset</h5>
    <div class="overflow-x-auto relative">
        <livewire:table.ads.my-ads-table params="{{$type}}" />
    </div>
</div>