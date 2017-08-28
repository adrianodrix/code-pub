{!! Html::formGroup('title','Título',$errors) !!}
{!! Html::formGroup('subtitle','Subtítulo',$errors) !!}
{!! Html::formGroup('price','Preço',$errors) !!}

<div class="form-group">
    <?php $nome_submit = isset($book) ? 'Editar Livro' : 'Criar Livro'; ?>
    {!! Form::submit($nome_submit,['class'=>'btn btn-primary']) !!}
</div>