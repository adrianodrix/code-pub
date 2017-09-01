{!! Form::hidden('redirect_to', URL::previous()) !!}
{!! Html::openFormGroup('name', $errors) !!}
{!! Form::label('name', 'Nome',['class' =>'control-label']) !!}
{!! Form::text('name', null, ['class' => 'form-control']) !!}
{!! Form::error('name', $errors) !!}
{!! Html::closeFormGroup() !!}
{!! Html::openFormGroup('email', $errors) !!}
{!! Form::label('email', 'E-mail',['class' =>'control-label']) !!}
{!! Form::email('email', null, ['class' => 'form-control']) !!}
{!! Form::error('email', $errors) !!}
{!! Html::closeFormGroup() !!}

{{--{!! Html::openFormGroup('roles','roles.*', $errors) !!}--}}
{{--{!! Form::label('roles[]', 'Roles',['class' =>'control-label']) !!}--}}
{{--{!! Form::select('roles[]', $roles, null, ['class' => 'form-control', 'multiple' => 'true']) !!}--}}
{{--{!! Form::error('roles', $errors) !!}--}}
{{--{!! Form::error('roles.*', $errors) !!}--}}
{{--{!! Html::closeFormGroup() !!}--}}

{!! Html::openFormGroup('submit', $errors) !!}
    {!! Button::primary(isset($user) ? 'Salvar' : 'Criar Usuário')->prependIcon(Icon::ok())->submit() !!}
{!! Html::closeFormGroup() !!}