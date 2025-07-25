{{-- Setup data for datatables --}}
@php
    $heads = ['ID', 'Judul', 'Kategori', ['label' => 'Actions', 'no-export' => true, 'width' => 5]];
@endphp

{{-- Customize layout sections --}}

@section('subtitle', 'Daftar Arsip')

@section('content_header_title', 'Daftar Arsip')

{{-- Content body: main page content --}}

<div>
    <div class="card mt-2">
        <div class="card-body">
            <x-adminlte-datatable id="table2" :heads="$heads" head-theme="dark" :config="$data" striped hoverable
                bordered compressed />
        </div>
    </div>
</div>
