{{-- Setup data for datatables --}}
@php
    $heads = ['ID', 'Judul', 'Kategori', 'Tanggal', ['label' => 'Actions', 'no-export' => true, 'width' => 5]];
@endphp

{{-- Customize layout sections --}}

@section('subtitle', 'Daftar Pengaduan Selesai')

@section('content_header_title', 'Daftar Pengaduan Selesai')

{{-- Content body: main page content --}}

<div>
    <div class="card mt-2">
        {{-- Success Message --}}
        @if (session()->has('success'))
            <div class="bg-success border border-success text-success px-4 py-3 rounded position-relative mb-4"
                role="alert">
                <strong class="font-weight-bold">Berhasil!</strong>
                <span class="d-block d-sm-inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-danger border border-danger text-danger px-4 py-3 rounded position-relative mb-4"
                role="alert">
                <strong class="font-weight-bold">Error!</strong>
                <span class="d-block d-sm-inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="card-body">
            <x-adminlte-datatable id="table2" :heads="$heads" head-theme="dark" :config="$data" striped hoverable
                bordered compressed />
        </div>
    </div>
</div>
