{!! Form::hidden('redirect_to', URL::previous()) !!}
{!! Html::formGroup('name','Nome', $errors) !!}
{!! Html::formGroup('description','Descrição', $errors) !!}

{!! Html::openFormGroup('submit', $errors) !!}
    {!! Button::primary(isset($user) ? 'Salvar' : 'Criar Perfil de Usuário')->prependIcon(Icon::ok())->submit() !!}
{!! Html::closeFormGroup() !!}