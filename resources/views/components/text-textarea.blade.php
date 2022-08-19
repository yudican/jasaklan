<div class="form-group {{$errors->has($name) ? 'has-error has-feedback' : '' }}">
    <label for="{{$name}}" class="placeholder"><b>{{$label}}</b></label>
    <textarea id="{{$name}}" name="{{$name}}" wire:model="{{$name}}" type="text" class="form-control"></textarea>
    <small id="helpId" class="text-danger">{{ $errors->has($name) ? $errors->first($name) : '' }}</small>
</div>