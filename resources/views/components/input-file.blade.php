<div class="form-group">
  <label>{{$label}}</label>
  <div class="input-group">
    <div class="custom-file">
      <input type="file" class="custom-file-input" id="{{$name}}" wire:model="{{$name}}" accept="application/pdf">
      @if ($file)
      @if ($path)
      <label class="custom-file-label" for="{{$name}}">{{$path}}</label>
      @else
      <label class="custom-file-label" for="{{$name}}">{{$file}}</label>
      @endif
      @else
      @if ($path)
      <label class="custom-file-label" for="{{$name}}">{{$path}}</label>
      @else
      <label class="custom-file-label" for="{{$name}}">Choose file</label>
      @endif
      @endif
    </div>
  </div>
  <small id="helpId" class="text-danger">{{ $errors->has($name) ? $errors->first($name) : '' }}</small>
</div>