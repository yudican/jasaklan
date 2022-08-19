<div class="card">
  {{-- <div wire:loading. wire:loading.flex class="flex justify-center items-center" style="background-color: #66626273;position:absolute;z-index:1;width: 98.5%;height: 100%;border-radius: 10px;">
    <img src=" {{asset('assets/img/loader.gif')}}" alt="loader">
  </div> --}}
  @if($beforeTableSlot)
  <div class="mt-8">
    @include($beforeTableSlot)
  </div>
  @endif
  <div class="card-body">
    <div class="overflow-x-auto shadow-md sm:rounded-lg">
      <div class="flex justify-between items-center">
        @if($this->searchableColumns()->count())
        {{-- search --}}
        <div class="pb-2 bg-white px-2 pt-2">
          <label for="table-search" class="sr-only">Search</label>
          <div class="relative mt-1">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
              <svg class="w-5 h-5 text-gray-500 " aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <input type="text" id="table-search" class="block pl-10 w-80 text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " wire:model.debounce.500ms="search" placeholder="Cari Disini">
          </div>
        </div>
        {{-- end search --}}
        @endif
        <div class="flex flex-row justify-center items-center">
          <div>
            @if($hideable === 'select')
            @include('datatables::hide-column-multiselect')
            @endif
          </div>
        </div>
      </div>


      <table class="w-full text-sm text-left text-gray-500 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
          <tr>
            @foreach($this->columns as $index => $column)
            @if ($column['type'] == 'checkbox')
            @unless($column['hidden'])
            <th scope="col" class="p-4">
              <div class="flex items-center">
                <input type="checkbox" wire:click="toggleSelectAll" @if(count($selected)===$this->results->total()) checked @endif class="form-checkbox mt-1 text-blue-600" />
              </div>
            </th>
            @endunless
            @else
            @unless($column['hidden'])
            <th scope="col" class="py-3 px-6">
              {{$column['label']}}
            </th>
            @endunless
            @endif
            @endforeach
          </tr>
        </thead>
        <tbody>
          @forelse($this->results as $index => $result)
          <tr class="bg-white border-b hover:bg-gray-50 dark:hover:bg-gray-600">
            @foreach($this->columns as $keys => $column)
            @if($column['hidden'])
            @elseif ($column['type'] == 'checkbox')
            <th scope="col" class="p-4">
              <div class="flex items-center">
                <input type="checkbox" checked wire:model="selected.{{$result->checkbox_attribute}}" value="{{$result->checkbox_attribute}}" class="form-checkbox mt-1 text-blue-600" />
              </div>
            </th>
            @elseif($column['name'] == 'id')
            <td scope="col" class="py-3 px-6">
              {{$index+1}}
            </td>
            @else
            <td scope="col" class="py-3 px-6">
              {!! $result->{$column['name']} !!}
            </td>
            @endif
            @endforeach
          </tr>
          @empty
          <tr>
            <td colspan="{{count($this->columns)}}">
              <div class="flex flex-col justify-center items-center mt-8 mb-8">
                <img src="{{asset('assets/img/empty.svg')}}" alt="">
                <span>Tidak Ada Data</span>
              </div>
            </td>
          </tr>
          @endforelse

        </tbody>
      </table>
      @unless($this->hidePagination)
      <div class="rounded-lg rounded-t-none max-w-screen border-b border-gray-200 bg-white">
        <div class="p-2 sm:flex items-center justify-between mx-4">
          {{-- check if there is any data --}}
          @if(count($this->results))
          <div class="my-2 sm:my-0 flex items-center">
            <select name="perPage" class="mt-1 form-select block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5" wire:model="perPage">
              @foreach(config('livewire-datatables.per_page_options', [ 10, 25, 50, 100 ]) as $per_page_option)
              <option value="{{ $per_page_option }}">{{ $per_page_option }}</option>
              @endforeach
              <option value="99999999">{{__('All')}}</option>
            </select>
          </div>

          <div class="my-4 sm:my-0">
            <div class="lg:hidden">
              <span class="space-x-2">{{ $this->results->links('datatables::tailwind-simple-pagination') }}</span>
            </div>

            <div class="hidden lg:flex justify-center">
              <span>{{ $this->results->links('datatables::tailwind-pagination') }}</span>
            </div>
          </div>

          <div class="flex justify-end text-gray-600">
            {{__('Results')}} {{ $this->results->firstItem() }} - {{ $this->results->lastItem() }} {{__('of')}}
            {{ $this->results->total() }}
          </div>
          @endif
        </div>
      </div>
      @endif
    </div>
  </div>
  @if($afterTableSlot)
  <div class="mt-8">
    @include($afterTableSlot)
  </div>
  @endif
</div>