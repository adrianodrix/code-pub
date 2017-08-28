@extends('layouts.app')
@section('content')
    <h1>Categorias</h1>
    {!! Button::primary('Nova Categoria')->asLinkTo(route('categories.create')) !!}
    <hr/>
    {!!
        Table::withContents($categories->items())
            ->striped()
            ->hover()
            ->callback('Ações', function($field, $category) {
                $linkEdit = getLinkEdit($category);
                $formDelete = getFormDestroy($category);
                $linkDestroy = getLinkDestroy($category);

                return "<ul class=\"list-inline\">
                            <li>$linkEdit</li>
                            <li>$linkDestroy</li>
                        </ul>
                        $formDelete";
            })
     !!}
    {!! $categories->links() !!}
@endsection

<?php
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