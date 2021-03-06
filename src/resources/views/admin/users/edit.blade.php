@extends('adminlte::page')

@section('content_header')
    <h1>@lang('form.edit_record', ['record' => trans_choice('users.user', 1)])</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            {!! Html::form($form, $user) !!}
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@stop
