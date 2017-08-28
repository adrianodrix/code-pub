{!! Html::formGroup('name','Nome',$errors) !!}

<div class="form-group">
    <?php $nome_submit = isset($category) ? 'Editar Categoria' : 'Criar Categoria'; ?>
    {!! Form::submit($nome_submit,['class'=>'btn btn-primary']) !!}
</div>
