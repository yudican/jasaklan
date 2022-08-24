<div class="form-group {{$errors->has($name) ? 'has-error has-feedback' : '' }}">
    @if (isset($label))
    @if (in_array($type, ['text', 'password', 'date', 'email','number']))
    <label for="{{$name}}" class="placeholder"><b>{{$label}}</b> <span style="color:red">{{ $isreq ?? '' }}</span></label>
    @endif
    @endif

    <input id="{{$name}}" value="{{$value ?? ''}}" name="{{$name}}" wire:model="{{$name}}" type="{{$type ?? 'text'}}" class="form-control  w-100" {{isset($readonly) ? 'readonly' : '' }} placeholder="{{isset($placeholder) ? $placeholder : ''}}">
    <small id="helpId" class="text-danger">{{ $errors->has($name) ? $errors->first($name) : '' }}</small>
</div>