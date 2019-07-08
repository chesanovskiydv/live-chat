<div class="box box-default">
    {!! form_start($form) !!}
    <div class="box-body">
        {!! form_rest($form) !!}
    </div>
    <div class="box-footer">
        <a class="btn btn-default" href="{{ route('admin::users.index') }}">@lang('form.cancel')</a>
        {!! Form::button($model->exists ? trans('form.update') :  trans('form.create'), ['type' => 'submit', 'class' => 'btn btn-primary pull-right']) !!}
    </div>
    {!! form_end($form, false) !!}
</div>