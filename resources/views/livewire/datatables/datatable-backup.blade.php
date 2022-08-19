<div>
    <div wire:loading. wire:loading.flex class="flex justify-center items-center" style="background-color: #66626273;position:absolute;z-index:1;width: 98.5%;height: 100%;border-radius: 10px;">
        <img src=" {{asset('assets/img/loader.gif')}}" alt="loader">
    </div>
    @if($beforeTableSlot)
    <div class="mt-8">
        @include($beforeTableSlot)
    </div>
    @endif
    <div class="relative ">
        <div class="flex justify-between items-center mb-1">
            <div class="flex-grow h-10 flex items-center mt-3 mb-1">
                @if($this->searchableColumns()->count())
                <div class="w-96 flex rounded-lg shadow-sm mb-3 dark">
                    <div class="relative flex-grow focus-within:z-10">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" stroke="currentColor" fill="none">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input wire:model.debounce.500ms="search" class="w-full pl-10 py-3 text-sm leading-4 block rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 focus:outline-none" placeholder="{{__('Cari Disini')}}" type="text" />
                        <div class="absolute inset-y-0 right-0 pr-2 flex items-center">
                            <button wire:click="$set('search', null)" class="text-gray-300 hover:text-red-600 focus:outline-none">
                                <x-icons.x-circle class="h-5 w-5 stroke-current" />
                            </button>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            @if (isset($params['segment1']) || isset($params['segment2']))
            @if (count($selected) > 0)
            <div class="dropdown show">
                <button class="flex items-center h-10 space-x-2 px-4 rounded-md bg-[#2980b9] text-green-500 text-xs leading-4 font-medium uppercase tracking-wider btn btn-primary text-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    Options
                </button>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    {{-- approve finace --}}
                    @if (in_array($params['segment2'],['siap-dikirim','on-process','approve-finance']))
                    <div>
                        @if (in_array($role,['warehouse','superadmin','adminsales']))
                        <button wire:click="bulkPrint" id="bulk-print" class="dropdown-item">
                            Cetak Label
                        </button>
                        @endif
                        <div class="dropdown-divider"></div>
                    </div>
                    {{-- admin proccess --}}
                    @elseif ($params['segment2'] == 'admin-process')
                    <div>
                        @if (in_array($role,['warehouse','superadmin']))
                        <button wire:click="readyToOrder" id="button-siap-dikirim" class="dropdown-item">
                            <span>{{ __('Siap Dikirim') }}</span>
                        </button>
                        @endif
                        <div class="dropdown-divider"></div>
                    </div>
                    @endif

                    <button wire:click="printInvoice" id="invoice-print" class="dropdown-item">
                        <span> {{__('Cetak Invoice')}} </span>
                    </button>
                </div>
            </div>
            @else
            <button class="flex items-center h-10 space-x-2 px-4 rounded-md bg-[#2980b9] text-green-500 text-xs leading-4 font-medium uppercase tracking-wider btn btn-primary text-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink-disabled" disabled>
                Options
            </button>
            @endif
            @endif

            {{-- <button onclick="window.location.reload();" class="btn btn-primary btn-sm" style="font-size: 10pt;">Refresh Page</button> --}}
            <div class="flex items-center space-x-1 ml-2">
                {{--
                <x-icons.cog wire:loading class="h-9 w-9 animate-spin text-gray-400" /> --}}

                @if($exportable)
                <div x-data="{ init() {
                      window.livewire.on('startDownload', link => window.open(link,'_blank'))
                  } }" x-init="init">
                    <button wire:click="export" class="flex items-center h-10 space-x-2 px-2 border border-green-400 rounded-md bg-white text-green-500 text-xs leading-4 font-medium uppercase tracking-wider hover:bg-green-200 focus:outline-none"><span>{{ __('Export') }}</span>
                        <x-icons.excel class="m-2" />
                    </button>
                </div>
                @endif

                @if($hideable === 'select')
                @include('datatables::hide-column-multiselect')
                @endif
            </div>
        </div>

        @if($hideable === 'buttons')
        <div class="p-2 grid grid-cols-8 gap-2">
            @foreach($this->columns as $index => $column)
            <button wire:click.prefetch="toggle('{{ $index }}')" class="px-3 py-2 rounded text-white text-xs focus:outline-none
              {{ $column['hidden'] ? 'bg-blue-100 hover:bg-blue-300 text-blue-600' : 'bg-blue-500 hover:bg-blue-800' }}">
                {{ $column['label'] }}
            </button>
            @endforeach
        </div>
        @endif

        <div class="rounded-lg shadow-lg bg-white max-w-screen overflow-x-scroll px-0">
            <div class="rounded-lg @unless($this->hidePagination) rounded-b-none @endif">
                <div class="table align-middle min-w-full">
                    @unless($this->hideHeader)
                    <div class="table-row divide-x divide-gray-200">
                        @foreach($this->columns as $index => $column)
                        @if($hideable === 'inline')
                        @include('datatables::header-inline-hide', ['column' => $column, 'sort' => $sort])
                        @elseif($column['type'] === 'checkbox')
                        @unless($column['hidden'])
                        <div class="overflow-hidden align-top  px-2 py-4 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider flex h-full flex-col items-center justify-center space-y-2 focus:outline-none">
                            {{-- <div>SELECT ALL</div> --}}
                            <div>
                                <input type="checkbox" wire:click="toggleSelectAll" @if(count($selected)===$this->results->total()) checked @endif class="form-checkbox mt-1 text-blue-600 transition duration-150 ease-in-out" />
                            </div>
                        </div>
                        @endunless
                        @else
                        @include('datatables::header-no-hide', ['column' => $column, 'sort' => $sort])
                        @endif
                        @endforeach
                    </div>

                    <div class="table-row divide-x divide-blue-200 bg-blue-100">
                        {{-- {{dd($this->columns)}} --}}
                        @foreach($this->columns as $index => $column)
                        @if($column['hidden'])
                        @if($hideable === 'inline')
                        <div class="table-cell w-5 overflow-hidden align-top bg-blue-100"></div>
                        @endif

                        @else
                        <div class="table-cell overflow-hidden align-top">
                            @isset($column['filterable'])
                            @if( is_iterable($column['filterable']) )
                            <div wire:key="{{ $index }}">
                                @include('datatables::filters.select', ['index' => $index, 'name' => $column['label'], 'options' => $column['filterable']])
                            </div>
                            @else
                            <div wire:key="{{ $index }}">
                                @include('datatables::filters.' . ($column['filterView'] ?? $column['type']), ['index' => $index, 'name' => $column['label']])
                            </div>
                            @endif
                            @endisset
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endif
                    @forelse($this->results as $index => $result)
                    <div class="table-row p-1 divide-x divide-gray-100 {{ isset($result->checkbox_attribute) && in_array($result->checkbox_attribute, $selected) ? 'bg-orange-100' : ($loop->even ? 'bg-gray-100' : 'bg-gray-50') }}" id="row-{{$index}}">

                        @foreach($this->columns as $keys => $column)
                        @if($column['hidden'])
                        @if($hideable === 'inline')
                        <div class="table-cell w-5 overflow-hidden align-top"></div>
                        @endif
                        @elseif($column['type'] === 'checkbox')
                        @include('datatables::checkbox', ['value' => $result->checkbox_attribute])
                        @elseif($column['name'] == 'id')
                        <div class="px-6 py-2 whitespace-no-wrap text-sm leading-5 text-gray-900 table-cell @if($column['align'] === 'right') text-right @elseif($column['align'] === 'center') text-center @else text-left @endif">
                            {{$index+1}}
                        </div>
                        @else

                        <div class="px-6 py-2 whitespace-no-wrap text-sm leading-5 text-gray-900 table-cell @if($column['align'] === 'right') text-right @elseif($column['align'] === 'center') text-center @else text-left @endif">
                            {!! $result->{$column['name']} !!}
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @empty
                    <div style="height: 200px;">
                        <div class="table-row p-1 divide-x divide-gray-100 flex justify-center items-center" style="position: absolute;left: 0;right: 0;height: 200px;" id="row-">
                            <div class="flex flex-col justify-center items-center mt-8">
                                <img src="{{asset('assets/img/empty.svg')}}" alt="">
                                <span>Tidak Ada Data</span>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
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