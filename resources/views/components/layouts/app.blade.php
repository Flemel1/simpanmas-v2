@extends('adminlte::page')

@section('meta_tags')
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
@endsection

{{-- Extend and customize the browser title --}}

@section('title')
    {{ config('adminlte.title') }}
    @hasSection('subtitle')
        | @yield('subtitle')
    @endif
@endsection

@section('content_header')
    @hasSection('content_header_title')
        <h1 class="text-muted">
            @yield('content_header_title')

            @hasSection('content_header_subtitle')
                <small class="text-dark">
                    <i class="fas fa-xs fa-angle-right text-muted"></i>
                    @yield('content_header_subtitle')
                </small>
            @endif
        </h1>
    @endif
@endsection


{{-- Rename section content to content_body --}}

@section('content')
    {{ $slot }}
@endsection

{{-- Extend and customize the page footer --}}

{{-- Create a common footer --}}

@section('footer')
    <div class="float-right">
        Version: {{ config('app.version') }}
    </div>

    <strong>
        {{ config('app.name') }}
    </strong>
@endsection
