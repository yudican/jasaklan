<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-capitalize">
                        <a href="{{route('dashboard')}}">
                            <span><i class="fas fa-arrow-left mr-3 text-capitalize"></i>tickets</span>
                        </a>
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <livewire:table.ticket-table params="{{$route_name}}" />
        </div>

        {{-- Modal form --}}
        <div id="form-modal" wire:ignore.self class="modal fade" tabindex="-1" permission="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog" permission="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-capitalize" id="my-modal-title">Konfirmasi Reject</h5>
                    </div>
                    <div class="modal-body">
                        <x-text-field type="text" name="notes" label="Catatan Reject" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="saveReject" class="btn btn-primary btn-sm"><i class="fa fa-check pr-2"></i>Simpan</button>
                        <button class="btn btn-danger btn-sm" wire:click='_reset'><i class="fa fa-times pr-2"></i>Batal</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')



    <script>
        document.addEventListener('livewire:load', function(e) {
            window.livewire.on('toggleModalReject', (data) => {
                $('#form-modal').modal(data)
            });
        })
    </script>
    @endpush
</div>