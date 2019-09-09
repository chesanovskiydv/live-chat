<?php
/**
 * @var \Kris\LaravelFormBuilder\Form $form
 * @var \App\Models\User $user
 */
?>
@extends('adminlte::page')

@section('content_header')
    <h1>@lang('form.create_record', ['record' => trans_choice('users.user', 1)])</h1>
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
