{{-- Setup data for datatables --}}
@php
    $heads = ['ID', 'Judul', 'Kategori', 'Tanggal'];
@endphp

{{-- Customize layout sections --}}

@section('subtitle', 'Daftar Pengaduan Dibatalkan')


@section('content_header_title', 'Daftar Pengaduan Dibatalkan')

{{-- Content body: main page content --}}

<div>
    <div class="card mt-2">
        {{-- <div class="card-header">
            <a href="{{ route('complaint.create') }}" class="btn btn-primary" navigate>Buat Pengaduan</a>
        </div> --}}
        <div class="card-body">
            
            <x-adminlte-datatable id="table2" :heads="$heads" head-theme="dark" :config="$data" striped hoverable
                bordered compressed />
        </div>
    </div>
</div>
