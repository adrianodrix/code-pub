{!! Form::hidden('redirect_to', URL::previous()) !!}
{!! Html::formGroup('title','Título', $errors) !!}
{!! Html::formGroup('subtitle','Subtítulo', $errors) !!}
{!! Html::formGroup('price','Preço', $errors) !!}

{!! Html::openFormGroup(['categories', 'categories.*'], $errors) !!}
    {!! Form::label('categories[]', 'Categorias',['class' =>'control-label']) !!}
    {!! Form::select('categories[]', $categories, null, ['class' => 'form-control', 'multiple' => 'true']) !!}
    {!! Form::error('categories', $errors) !!}
    {!! Form::error('categories.*', $errors) !!}
{!! Html::closeFormGroup() !!}

<div class="panel-heading">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1default" data-toggle="tab">Descrição</a></li>
        <li><a href="#tab2default" data-toggle="tab">Dedicatória</a></li>
    </ul>
</div>
<div class="panel-body">
    <div class="tab-content">
        <div class="tab-pane fade in active" id="tab1default">
            {!! Html::openFormGroup('description', $errors) !!}
            {!! Form::label('description', 'Descrição',['class' =>'control-label']) !!}
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            {!! Form::error('description', $errors) !!}
            {!! Html::closeFormGroup() !!}
        </div>
        <div class="tab-pane fade" id="tab2default">
            {!! Html::openFormGroup('dedication', $errors) !!}
            {!! Form::label('dedication', 'Dedicatória',['class' =>'control-label']) !!}
            {!! Form::textarea('dedication', null, ['class' => 'form-control']) !!}
            {!! Form::error('dedication', $errors) !!}
            {!! Html::closeFormGroup() !!}
        </div>
    </div>
</div>

{!! Html::openFormGroup('website', $errors) !!}
{!! Form::label('website', 'Website',['class' =>'control-label']) !!}
{!! Form::text('website', null, ['class' => 'form-control']) !!}
{!! Form::error('website', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('percent_complete', $errors) !!}
{!! Form::label('percent_complete', 'Completo (%)',['class' =>'control-label']) !!}
{!! Form::number('percent_complete', null, ['class' => 'form-control']) !!}
{!! Form::error('percent_complete', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup() !!}
<label>
    {!! Form::checkbox('published') !!} Publicado?
</label>
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('submit', $errors) !!}
    {!! Button::primary(isset($book) ? 'Editar Livro' : 'Criar Livro')->prependIcon(Icon::plus())->submit() !!}
{!! Html::closeFormGroup() !!}