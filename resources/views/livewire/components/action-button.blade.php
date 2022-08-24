<div class="list-group-item-figure" id="action-{{$id}}">
  <div class="dropdown">
    <button class="btn-dropdown" data-toggle="dropdown" aria-expanded="false">
      <i class="fas fa-ellipsis-h"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-124px, 25px, 0px); top: 0px; left: 0px; will-change: transform;">
      @if (isset($actions))
      @foreach ($actions as $extra)
      @if ($extra['type'] == 'link')
      <a href="{{route($extra['route'],$extra['params'])}}" class="dropdown-item">{{$extra['label']}}</a>
      @elseif ($extra['type'] == 'button')
      <button wire:click="{{$extra['route']}}" class="dropdown-item">{{$extra['label']}}</button>
      @endif
      @endforeach
      @endif
    </div>
  </div>
</div>