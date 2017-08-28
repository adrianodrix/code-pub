{!! Form::hidden('redirect_to', URL::previous()) !!}
{!! Html::formGroup('title','Título',$errors) !!}
{!! Html::formGroup('subtitle','Subtítulo',$errors) !!}
{!! Html::formGroup('price','Preço',$errors) !!}

<div class="form-group">
    <?php $nome_submit = isset($book) ? 'Editar Livro' : 'Criar Livro'; ?>
    {!! Button::primary($nome_submit)->prependIcon(Icon::plus())->submit() !!}
</div>