{!! Form::hidden('redirect_to', URL::previous()) !!}
{!! Html::openFormGroup('name', $errors) !!}
{!! Form::label('name', 'Name',['class' =>'control-label']) !!}
{!! Form::text('name', null, ['class' => 'form-control']) !!}
{!! Form::error('name', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('order', $errors) !!}
{!! Form::label('order', 'Order',['class' =>'control-label']) !!}
{!! Form::text('order', isset($chapter) ? $chapter->order : 1, ['class' => 'form-control']) !!}
{!! Form::error('order', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('content', $errors) !!}
{!! Form::label('content', 'Content',['class' =>'control-label']) !!}
{!! Form::textarea('content', null, ['class' => 'form-control']) !!}
{!! Form::error('content', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('submit', $errors) !!}
    {!! Button::primary(isset($chapter) ? 'Editar Capítulo' : 'Criar Capítulo')->prependIcon(Icon::floppyDisk())->submit() !!}
    {!! Button::success('Cancelar')->prependIcon(Icon::floppyRemove())->asLinkTo(URL::previous()) !!}
{!! Html::closeFormGroup() !!}