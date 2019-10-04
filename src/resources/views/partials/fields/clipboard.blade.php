@if($showLabel && $showField)
    @if($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!} >
    @endif
@endif

@if($showLabel && $options['label'] !== false && $options['label_show'])
    {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
@endif

@if($showField)

    <div class="input-group">
        @if($options['input'])
            {!! Form::input('text', $name, $options['value'], $options['attr']) !!}
        @endif
        <span class="input-group-btn">
            <button type="button" class="btn btn-default btn-flat {{ \App\Forms\Fields\Clipboard::DEFAULT_CLASS }}" {!! $options['clipboardAttrs'] !!}>
          <i class="fa fa-fw fa-clipboard"></i>
      </button>
    </span>
</div>

@include('laravel-form-builder::help_block')

@endif

@if($showLabel && $showField)
    @if($options['wrapper'] !== false)
        </div>
    @endif
@endif
