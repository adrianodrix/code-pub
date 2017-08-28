<div class="form-group">
    {!! Form::label('name', 'Nome') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <?php $nome_submit = isset($category) ? 'Editar Categoria' : 'Criar Categoria'; ?>
    {!! Form::submit($nome_submit,['class'=>'btn btn-primary']) !!}
</div>
