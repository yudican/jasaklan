<div>
  <button id="dropdownDividerButton-{{$id}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center " type="button">Aksi <svg class="ml-2 w-4 h-4" aria-hidden="true"
      fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
    </svg></button>

  <!-- Dropdown menu -->
  <div id="dropdownDivider-{{$id}}" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow ">
    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
      @if (isset($actions))
      @foreach ($actions as $extra)
      @if ($extra['type'] == 'link')
      <li>
        <a href="{{route($extra['route'],$extra['params'])}}" class="block py-2 px-4 hover:bg-gray-100 ">{{$extra['label']}}</a>
      </li>
      @elseif ($extra['type'] == 'button')
      <li>
        <button wire:click="{{$extra['route']}}" class="block py-2 px-4 hover:bg-gray-100 ">{{$extra['label']}}</button>
      </li>
      @endif
      @endforeach
      @endif
    </ul>
  </div>


  {{-- script --}}
  @push('scripts')
  <script>
    $(document).ready(function(value) {
      const itemId = @js($id)
            // set the dropdown menu element
          const targetEl = document.getElementById('dropdownDivider-'+itemId);

          // set the element that trigger the dropdown menu on click
          const triggerEl = document.getElementById('dropdownDividerButton-'+itemId);

          // options with default values
          const dropdown = new Dropdown(targetEl, triggerEl);
          dropdown.hide();
        })
  </script>
  @endpush
</div>