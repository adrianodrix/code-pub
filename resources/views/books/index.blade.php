@extends('layouts.app')
@section('content')

    <h1>Livros</h1>
    {!! Button::primary('Novo Livro')->asLinkTo(route('books.create')) !!}
    <hr/>
    {!!
        Table::withContents($books->items())
            ->striped()
            ->hover()
            ->callback('Ações', function($field, $book) {
                $linkEdit = getLinkEdit($book);
                $formDelete = getFormDestroy($book);
                $linkDestroy = getLinkDestroy($book);

                return "<ul class=\"list-inline\">
                            <li>$linkEdit</li>
                            <li>$linkDestroy</li>
                        </ul>
                        $formDelete";
            })
     !!}
    {!! $books->links() !!}

@endsection

<?php
function getLinkDestroy($book)
{
    $deleteFormID = "form-delete_". $book->id;
    return Button::withValue('Excluir')
            ->extraSmall()
            ->asLinkTo(route('books.destroy', $book->id))
            ->addAttributes([
                    'onclick' => "event.preventDefault(); document.getElementById(\"$deleteFormID\").submit()"
            ]);
}

function getFormDestroy($book)
{
    $deleteFormID = "form-delete_". $book->id;
    $formDelete = Form::open(['route'=>['books.destroy', $book->id],'method'=>'DELETE',
                    'class'=>'form-inline','style'=>'display:none', 'id'=> $deleteFormID]).
            Form::submit('Excluir').
            Form::close();
    return $formDelete;
}

function getLinkEdit($book)
{
    return Button::primary('Editar')
            ->asLinkTo(route('books.edit', $book->id))
            ->extraSmall();
}
?>