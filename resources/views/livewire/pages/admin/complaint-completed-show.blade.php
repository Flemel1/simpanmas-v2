@section('subtitle', 'Pengaduan Diterima')


@section('content_header_title', 'Daftar Pengaduan Selesai')

@section('content_header_subtitle', 'Detail Pengaduan Selesai')

<div class="card">
    <div class="card-header">
        <h2 class="h2">Isi Pengaduan</h2>
    </div>
    <div class="card-body">

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
                <div class="col-sm-12">
                    <h4 class="h4">Deskripsi Dari Admin</h4>
                    <span>{{ $accepted_complaint->description }}</span>
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
        </div>
    </div>
</div>
