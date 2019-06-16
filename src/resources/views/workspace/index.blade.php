<?php
/**
 * @var \Illuminate\Contracts\Pagination\LengthAwarePaginator|\App\Models\Workspace[] $workspaces
 */
?>

@extends('adminlte::page')

@section('title', trans_choice('workspace.workspace', PHP_INT_MAX))

@section('content_header')
    <h1>@choice('workspace.workspace', PHP_INT_MAX)</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('grid.list_of_records', ['record' => trans_choice('workspace.workspace', PHP_INT_MAX)])</h3>

                    <div class="box-tools">
                        {{ Html::searchForm() }}
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="key">{{ Html::sortableLink('created_at', __('grid.key_column'), 'desc') }}</th>
                            <th>{{ Html::sortableLink('display_name', __('workspace.name')) }}</th>
                            @if(\Auth::user()->can('update', \App\Models\Workspace::class) || \Auth::user()->can('delete', \App\Models\Workspace::class))
                                <th class="actions"></th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($workspaces as $workspace)
                            <tr data-key="{{$workspace->getKey()}}">
                                <td>{{ $workspaces->firstItem() + $loop->index }}</td>
                                <td>{{ $workspace->display_name }}</td>
                                @if(\Auth::user()->can('update', \App\Models\Workspace::class) || \Auth::user()->can('delete', \App\Models\Workspace::class))
                                    <td class="text-center">
                                        {{
                                            Html::actions([
                                                'view' => ['url' => route('workspaces.show', ['workspace' => $workspace]), 'can' => ['view', $workspace]],
                                                'update' => ['url' => route('workspaces.edit', ['workspace' => $workspace]), 'can' => ['update', $workspace]],
                                                'delete' => [
                                                    'url' => route('workspaces.destroy', ['workspace' => $workspace]), 'method' => 'DELETE',
                                                    'can' => ['delete', $workspace],
                                                    'confirmation' => [
                                                        'title' => __('form.confirmation.delete.title'),
                                                        'text' => __('form.confirmation.delete.text'),
                                                    ]
                                                ],
                                            ])
                                         }}
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%">@lang('grid.empty_grid')</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="{{ route('workspaces.create') }}" class="btn btn-primary">
                        @lang('grid.create_new_record', ['record' => trans_choice('workspace.workspace', 1)])
                    </a>

                    {{ $workspaces->links() }}
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
@stop
