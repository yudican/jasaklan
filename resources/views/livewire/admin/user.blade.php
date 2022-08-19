<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-capitalize">
                        <a href="{{route('dashboard')}}">
                            <span><i class="fas fa-arrow-left mr-3"></i>users</span>
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
                    <x-text-field type="number" name="balance" label="Balance" />
                    <x-text-field type="text" name="username" label="Username" />
                    <x-text-field type="text" name="name" label="Name" />
                    <x-text-field type="text" name="email" label="Email" />
                    <x-text-field type="text" name="email_verified_at" label="Email Verified At" />
                    <x-text-field type="text" name="password" label="Password" />
                    <x-text-field type="text" name="remember_token" label="Remember Token" />
                    <x-text-field type="number" name="phone" label="Phone" />
                    <x-text-field type="text" name="address" label="Address" />
                    <x-text-field type="text" name="city" label="City" />
                    <x-text-field type="text" name="state" label="State" />
                    <x-text-field type="number" name="postal_code" label="Postal Code" />
                    <x-text-field type="text" name="role" label="Role" />
                    <x-select name="active" label="Active">
                        <option value="">Select Active</option>
                    </x-select>

                    <div class="form-group">
                        <button class="btn btn-primary pull-right" wire:click="{{$update_mode ? 'update' : 'store'}}">Simpan</button>
                    </div>
                </div>
            </div>
            @else
            <livewire:table.user-table params="{{$route_name}}" />
            @endif

        </div>

        {{-- Modal balance --}}
        <div id="balance-modal" wire:ignore.self class="modal fade" tabindex="-1" permission="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog" permission="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">Update Balance Deposit</h5>
                    </div>
                    <div class="modal-body">
                        <x-text-field type="number" name="balance" label="Balance Deposit" />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" wire:click='_reset' class="btn btn-danger btn-sm"><i class="fa fa-times pr-2"></i>Batal</button>
                        <button class="btn btn-primary btn-sm" wire:click='saveBalance'><i class="fa fa-check pr-2"></i>Simpan</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal password --}}
        <div id="password-modal" wire:ignore.self class="modal fade" tabindex="-1" permission="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog" permission="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">Update Password</h5>
                    </div>
                    <div class="modal-body">
                        <x-text-field type="password" name="password" label="Password" />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" wire:click='_reset' class="btn btn-danger btn-sm"><i class="fa fa-times pr-2"></i>Batal</button>
                        <button class="btn btn-primary btn-sm" wire:click='savePassword'><i class="fa fa-check pr-2"></i>Simpan</a>
                    </div>
                </div>
            </div>
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
            window.livewire.on('toggleBalanceModal', (data) => {
                $('#balance-modal').modal(data)
            });
            window.livewire.on('togglePasswordModal', (data) => {
                $('#password-modal').modal(data)
            });
        })
    </script>
    @endpush
</div>