{!! Form::hidden('redirect_to', URL::previous()) !!}
{!! Html::formGroup('name','Nome',$errors) !!}

<div class="form-group">
    <?php $nome_submit = isset($category) ? 'Editar Categoria' : 'Criar Categoria'; ?>
    {!! Button::primary($nome_submit)->submit() !!}
</div>
