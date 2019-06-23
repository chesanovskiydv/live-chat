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
                    <table class="table table-bordered" id="workspaces-table">
                        <thead>
                        <tr>
                            <th class="key">@lang('grid.key_column')</th>
                            <th>@lang('workspace.name')</th>
                            <th class="actions"></th>
                        </tr>
                        </thead>
                        <!-- table content -->
                    </table>
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
<script>
    $(document).ready(function () {
        $('#workspaces-table').dataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin::workspaces.index') }}',
            columns: [
                {data: 'DT_RowIndex', name: 'created_at'},
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            order: [[0, "desc"]]
        });
    });
</script>
@endpush
