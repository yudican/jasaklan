<div class="form-group {{$errors->has($name) ? 'has-error has-feedback' : '' }}">
  <label for="{{$name}}" class="placeholder"><b>{{$label}}</b></label>

  <input id="{{$name}}" value="{{$value ?? ''}}" name="{{$name}}" min="{{ $min ?? null }}" max="{{date('Y-m-d')}}"
    wire:model="{{$name}}" type="{{$type ?? 'text'}}" class="form-control" {{isset($readonly) ? 'readonly' : ''}}>
  <small id="helpId" class="text-danger">{{ $errors->has($name) ? $errors->first($name) : '' }}</small>
</div>