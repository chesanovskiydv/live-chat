<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator|\App\Models\Workspace[] $workspaces
 */
?>

@extends('adminlte::page')

@section('content_header')
    <h1>@choice('workspace.workspace', PHP_INT_MAX)</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('grid.list_of_records', ['record' => trans_choice('workspace.workspace', PHP_INT_MAX)])</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    {!! $dataTable->table() !!}
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="row actions">
                        <div class="col-sm-12">
                            <a href="{{ route('admin::workspaces.create') }}" class="btn btn-primary">
                                @lang('grid.create_new_record', ['record' => trans_choice('workspace.workspace', 1)])
                            </a>
                        </div>
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
