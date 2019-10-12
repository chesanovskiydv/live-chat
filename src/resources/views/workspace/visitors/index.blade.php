<?php
/**
 * @var \Yajra\DataTables\Html\Builder $dataTable
 */
?>

@extends('adminlte::page')

@section('content_header')
    <h1>@choice('visitors.visitor', PHP_INT_MAX)</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('grid.list_of_records', ['record' => trans_choice('visitors.visitor', PHP_INT_MAX)])</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    {!! $dataTable->table() !!}
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="row actions">
                        @can('create', \App\Models\Visitor::class)
                            <div class="col-sm-12">
                                {{ Html::linkRoute('workspace::visitors.create', __('grid.create_new_record', ['record' => trans_choice('visitors.visitor', 1)]), [], ['class' => 'btn btn-primary']) }}
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
@stop

@push('js')
{!! $dataTable->scripts() !!}
@endpush
