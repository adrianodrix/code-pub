@extends('layouts.app')
@section('content')
    <div class="row">
        <h1>Categorias</h1>
        {!! Button::primary('Nova Categoria')->asLinkTo(route('categories.create')) !!}
    </div>
    <div class="row">
        {!! Form::model(compact('search'), ['class' => 'form', 'method' => 'GET']) !!}
        {!! Html::search('search') !!}
        {!! Form::close() !!}
    </div>
    <hr/>
    {!!
        Table::withContents($categories->items())
            ->striped()
            ->hover()
            ->callback('Ações', function($field, $category) {
                return callbackTable($field, $category);
            })
     !!}
    {!! $categories->links() !!}
@endsection

<?php
    function callbackTable($field, $category)
    {
        $linkEdit = getLinkEdit($category);
        $formDelete = getFormDestroy($category);
        $linkDestroy = getLinkDestroy($category);

        return "<ul class=\"list-inline\">
                    <li>$linkEdit</li>
                    <li>$linkDestroy</li>
                </ul>
                $formDelete";
    }

    function getLinkDestroy($category)
    {
        $deleteFormID = "form-delete_". $category->id;
        return Button::withValue('Excluir')
                ->extraSmall()
                ->asLinkTo(route('categories.destroy', $category->id))
                ->addAttributes([
                        'onclick' => "event.preventDefault(); document.getElementById(\"$deleteFormID\").submit()"
                ]);
    }

    function getFormDestroy($category)
    {
        $deleteFormID = "form-delete_". $category->id;
        $formDelete = Form::open(['route'=>['categories.destroy', $category->id],'method'=>'DELETE',
                        'class'=>'form-inline','style'=>'display:none', 'id'=> $deleteFormID]).
                Form::submit('Excluir').
                Form::close();
        return $formDelete;
    }

    function getLinkEdit($category)
    {
        return Button::primary('Editar')
                ->asLinkTo(route('categories.edit', $category->id))
                ->extraSmall();
    }
?>