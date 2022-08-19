<div class="form-group" id="{{$name}}" style="">
  <div class="text-left">
    @if (isset($label))
    <label>{{$label}}</label>
    @endif
    <br>
    <label for="{{$name}}_picker">
      <img wire:loading wire:target="{{$name}}" src="https://crm-aimigroup.test/assets/img/loader.gif" style="height: 50px;position: absolute;margin-top: 50px;margin-left: 50px;" alt="loader">
      @if ($foto)
      @if ($path)
      <img id="image-preview-{{$name}}" width="150" class=" btn btn-light ratio-img img-fluid p-2 border image rounded border-dashed" style="width: 150px;height:150px;object-fit:contain;" src="{{ $path }}" alt="your image" />
      @else
      <img id="image-preview-{{$name}}" width="150" class=" btn btn-light ratio-img img-fluid p-2 border image rounded border-dashed" style="width: 150px;height:150px;object-fit:contain;" src="{{ getImage($foto) }}" alt="your image" />
      @endif

      @else
      @if ($path)
      <img id="image-preview-{{$name}}" width="150" class=" btn btn-light ratio-img img-fluid p-2 border image rounded border-dashed" style="width: 150px;height:150px;object-fit:contain;" src="{{ $path }}" alt="your image" />
      @else
      <img id="image-preview-{{$name}}" class=" btn btn-light ratio-img img-fluid p-2 border image rounded border-dashed" width="150" style="width: 150px;height:150px;object-fit:contain;" src="{{asset('assets/img/card.svg')}}" alt="your image" />
      @endif
      @endif
      <br>
      {{-- button --}}
      @if ($foto || $path)
      <label for="{{$name}}_picker" class="btn btn-primary btn-sm text-white w-100"><i class="fas fa-upload"></i> Change</label>
      @else
      <label for="{{$name}}_picker" class="btn btn-primary btn-sm text-white w-100"><i class="fas fa-upload"></i> Choose File</label>
      @endif
    </label>
    <input id="{{$name}}_picker" class="d-none" wire:model="{{$name}}" type="file" accept="image/*" />
    <br>
    <small id="helpId-{{$name}}" class="text-danger">{{ $errors->has($name) ? $errors->first($name) : '' }}</small>

  </div>
</div>