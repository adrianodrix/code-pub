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

{!! Html::openFormGroup('submit', $errors) !!}
    {!! Button::primary(isset($book) ? 'Editar Livro' : 'Criar Livro')->prependIcon(Icon::plus())->submit() !!}
{!! Html::closeFormGroup() !!}