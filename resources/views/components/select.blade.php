<div @isset($ignore) wire:ignore @endisset class="form-group {{$errors->has($name) ? 'has-error has-feedback' : '' }} w-100">
  <label for="{{$name}}" class="placeholder"><b>{{$label}}</b></label>

  <select name="{{$name}}" id="{{isset($id) ? $id : $name}}" wire:model="{{$name}}" wire:change="{{isset($handleChange) ? $handleChange.'("'.$type.'",$event.target.value)' : ''}}" class="form-control {{isset($class) ? $class : ''}}" {{isset($multiple) ? 'multiple' : '' }}>
    {{$slot}}
  </select>
  <small id="helpId" class="text-danger">{{ $errors->has($name) ? $errors->first($name) : '' }}</small>
</div>