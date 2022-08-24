<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-capitalize">
                        <a href="{{route('dashboard')}}">
                            <span><i class="fas fa-arrow-left mr-3"></i>packages</span>
                        </a>
                        <div class="pull-right">
                            @if ($form_active)
                            <button class="btn btn-danger btn-sm" wire:click="toggleForm(false)"><i class="fas fa-times"></i> Cancel</button>
                            @else
                            <button class="btn btn-primary btn-sm" wire:click="{{$modal ? 'showModal' : 'toggleForm(true)'}}"><i class="fas fa-plus"></i> Add New</button>
                            @endif
                        </div>
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            @if ($form_active)
            <div class="card">
                <div class="card-body">
                    <x-text-field type="text" name="name" label="Name" />
                    <x-select name="label" label="Label">
                        <option value="">Select Label</option>
                        <option value="detik">Detik</option>
                        <option value="share">Share</option>
                        <option value="subscribe">Subscribe</option>
                        <option value="likes">Likes</option>
                        <option value="posting">Posting</option>
                        <option value="komentar">Komentar</option>
                        <option value="follower">Follower</option>
                    </x-select>
                    <x-select name="type" label="Type">
                        <option value="">Select Type</option>
                        <option value="views">views</option>
                        <option value="share">Share</option>
                        <option value="subscribe">Subscribe</option>
                        <option value="like">Like</option>
                        <option value="posting">Posting</option>
                        <option value="comment">Comment</option>
                        <option value="follower">Follower</option>
                    </x-select>
                    <x-text-field type="number" name="price" label="Price" />
                    <x-text-field type="number" name="benefits" label="Benefits" />
                    <x-text-field type="number" name="commission" label="Commission" />
                    <x-select name="ads_type_id" label="Ads Type">
                        <option value="">Select Type</option>
                        @foreach($ads_types as $ads_type)
                        <option value="{{ $ads_type->id }}">{{ $ads_type->type_name }}</option>
                        @endforeach
                    </x-select>

                    <div class="form-group">
                        <button class="btn btn-primary pull-right" wire:click="{{$update_mode ? 'update' : 'store'}}">Simpan</button>
                    </div>
                </div>
            </div>
            @else
            <livewire:table.package-table params="{{$route_name}}" />
            @endif

        </div>

        {{-- Modal confirm --}}
        <div id="confirm-modal" wire:ignore.self class="modal fade" tabindex="-1" permission="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog" permission="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">Konfirmasi Hapus</h5>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin hapus data ini.?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" wire:click='delete' class="btn btn-danger btn-sm"><i class="fa fa-check pr-2"></i>Ya, Hapus</button>
                        <button class="btn btn-primary btn-sm" wire:click='_reset'><i class="fa fa-times pr-2"></i>Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')



    <script>
        document.addEventListener('livewire:load', function(e) {
            window.livewire.on('loadForm', (data) => {
                
                
            });

            window.livewire.on('closeModal', (data) => {
                $('#confirm-modal').modal('hide')
            });
        })
    </script>
    @endpush
</div>