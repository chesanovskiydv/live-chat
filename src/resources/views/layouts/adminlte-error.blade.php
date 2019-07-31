@extends('adminlte::page')

@section('content_header')
    <h1>@lang('error.header_title')</h1>
@endsection

@section('content')
    <div class="error-page">
        <h2 class="headline {{ $textClass ?? "" }}">@yield('code')</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning {{ $textClass ?? "" }}"></i> @lang('error.title_prefix') @yield('title').</h3>

            <p>
                @yield('message').
                @lang('error.message_append', ['link' => route('dashboard')])
            </p>
        </div>
        <!-- /.error-content -->
    </div>
@endsection
