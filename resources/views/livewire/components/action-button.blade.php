<div>
  <button id="action-dropdown" data-dropdown-toggle="dropdown-action"
    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
    </svg>
  </button>

  <!-- Dropdown menu -->
  <div id="dropdown-action" class="hidden z-10 w-48 bg-white rounded shadow dark:bg-gray-700">
    <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="action-dropdown">
      @if (isset($actions))
      @foreach ($actions as $extra)
      @if ($extra['type'] == 'link')
      <li>
        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
          <a href="{{route($extra['route'],$extra['params'])}}" class="ml-2 w-full text-sm font-medium text-gray-900 rounded dark:text-gray-300">{{$extra['label']}}</a>
        </div>
      </li>
      @elseif ($extra['type'] == 'modal')
      <li>
        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
          <button wire:click="{{$extra['route']}}" class="ml-2 w-full text-sm font-medium text-gray-900 rounded dark:text-gray-300">{{$extra['label']}}</button>
        </div>
      </li>
      @else
      <li>
        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
          <button wire:click="{{$extra['route']}}" class="ml-2 w-full text-sm font-medium text-gray-900 rounded dark:text-gray-300">{{$extra['label']}}</button>
        </div>
      </li>
      @endif
      @endforeach
      @endif
    </ul>
  </div>
</div>