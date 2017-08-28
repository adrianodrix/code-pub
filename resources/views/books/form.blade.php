<div class="form-group">
    {!! Form::label('title', 'Título') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('subtitle', 'Sub-Titulo') !!}
    {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('price', 'Preço') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <?php $nome_submit = isset($book) ? 'Editar Livro' : 'Criar Livro'; ?>
    {!! Form::submit($nome_submit,['class'=>'btn btn-primary']) !!}
</div>