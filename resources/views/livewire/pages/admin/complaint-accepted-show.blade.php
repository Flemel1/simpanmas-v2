@section('subtitle', 'Pengaduan Diterima')


@section('content_header_title', 'Daftar Pengaduan Diterima')

@section('content_header_subtitle', 'Detail Pengaduan Diterima')

<div class="card">
    <div class="card-header">
        <h2 class="h2">Isi Pengaduan</h2>
    </div>
    <div class="card-body">

        {{-- Error Message --}}
        @if (session()->has('error'))
            <div class="bg-danger border border-danger text-danger px-4 py-3 rounded position-relative mb-4"
                role="alert">
                <strong class="font-weight-bold">Error!</strong>
                <span class="d-block d-sm-inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-md-3">
                    <h4 class="h4">Nama</h4>
                    <span>{{ $accepted_complaint->complaint->name }}</span>
                </div>
                <div class="col-md-3">
                    <h4 class="h4">Judul Pengaduan</h4>
                    <span>{{ $accepted_complaint->complaint->title }}</span>
                </div>
                <div class="col-md-3">
                    <h4 class="h4">Nomor HP</h4>
                    <span>{{ $accepted_complaint->complaint->phone_number }}</span>
                </div>
                <div class="col-md-3">
                    <h4 class="h4">Kategori Pengaduan</h4>
                    <span>{{ $accepted_complaint->complaint->report_category }}</span>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-sm-12">
                    <h4 class="h4">Instansi</h4>
                    @if ($accepted_complaint->complaint->agency)
                        <span>{{ $accepted_complaint->complaint->agency->name }}</span>
                    @else
                        <span>{{ $accepted_complaint->complaint->new_agency }}</span>
                    @endif
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-12">
                    <h4 class="h4">Deskripsi Pengaduan</h4>
                    <span>{{ $accepted_complaint->complaint->description }}</span>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-12 col-md-6">
                    <img src="{{ asset('storage/' . $accepted_complaint->complaint->identity_photo) }}" height="300" alt="KTP"
                        class="w-100">
                </div>
                <div class="col-sm-12 col-md-6">
                    <button wire:click="download_attachment" class="btn btn-primary">
                        <i class="fas fa-download"></i>
                        Download Laporan Berkas
                    </button>
                </div>
            </div>
            @if ($accepted_complaint->doned_at == null)
                <div class="row mb-4">
                    <div class="col">
                        <button wire:click="open_complete_modal" class="btn btn-success">Selesai</button>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <button wire:click="open_cancel_modal" class="btn btn-danger">Batalkan</button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Acceptance Modal -->
    @if ($accepted_complaint->doned_at == null)
        <div wire:ignore.self class="modal fade" id="complete_modal" tabindex="-1"
            aria-labelledby="complete_modal_label" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form wire:submit.prevent="completed">
                        <div class="modal-header">
                            <h5 class="modal-title" id="complete_modal_label">Form Penerimaan Pengaduan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Response Textbox -->
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea id="description" wire:model.defer="form.description" rows="4" class="form-control"></textarea>
                                @error('form.description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- File Upload -->
                            <div class="form-group">
                                <label for="attachment">Dokumen (Optional)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="attachment"
                                        wire:model="form.attachment">
                                    <label class="custom-file-label" for="attachment">
                                        @if ($form->attachment)
                                            {{ $form->attachment->getClientOriginalName() }}
                                        @else
                                            Pilih file...
                                        @endif
                                    </label>
                                    @error('form.attachment')
                                        <div class="text-danger d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="completed">Submit</span>
                                <span wire:loading wire:target="completed">Submitting...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Cancel Modal -->
    @if ($accepted_complaint->complaint->canceled_at == null)
        <div wire:ignore.self class="modal fade" id="cancel_modal" tabindex="-1" aria-labelledby="cancel_modal_label"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form wire:submit.prevent="canceled">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cancel_modal_label">Form Pembatalan Pengaduan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Response Textbox -->
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea id="description" wire:model.defer="cancel_form.description" rows="4" class="form-control"></textarea>
                                @error('cancel_form.description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- File Upload -->
                            <div class="form-group">
                                <label for="cancel_attachment">Dokumen (Optional)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="cancel_attachment"
                                        wire:model="canecl_form.attachment">
                                    <label class="custom-file-label" for="cancel_attachment">
                                        @if ($form->attachment)
                                            {{ $form->attachment->getClientOriginalName() }}
                                        @else
                                            Pilih file...
                                        @endif
                                    </label>
                                    @error('cancel_form.attachment')
                                        <div class="text-danger d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="canceled">Submit</span>
                                <span wire:loading wire:target="canceled">Submitting...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    @push('js')
        {{-- Ensure jQuery and Bootstrap JS are loaded in your main layout file --}}
        <script>
            document.addEventListener('livewire:init', () => {
                // Show the modal on event
                Livewire.on('open_complete_modal', () => {
                    $('#complete_modal').modal('show');
                });

                // Hide the modal on event
                Livewire.on('close_complete_modal', () => {
                    $('#complete_modal').modal('hide');
                });

                // Show the cancel modal on event
                Livewire.on('open_cancel_modal', () => {
                    $('#cancel_modal').modal('show');
                });

                // Hide the cancel modal on event
                Livewire.on('close_cancel_modal', () => {
                    $('#cancel_modal').modal('hide');
                });

                // Handle the custom file input label
                $('#attachment').on('change', function() {
                    var fileName = $(this).val().split('\\').pop();
                    $(this).next('.custom-file-label').html(fileName);
                });

                // Handle the custom file input label
                $('#cancel_attachment').on('change', function() {
                    var fileName = $(this).val().split('\\').pop();
                    $(this).next('.custom-file-label').html(fileName);
                });
            });
        </script>
    @endpush
</div>
