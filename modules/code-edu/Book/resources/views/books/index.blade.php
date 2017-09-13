@extends('layouts.app')
@section('content')
    <div class="row">
        <h1>Livros</h1>
        @can('books/new')
            {!! Button::primary('Novo Livro')->asLinkTo(route('books.create')) !!}
        @endcan
    </div>
    <div class="row">
        {!! Form::model(compact('search'), ['class' => 'form', 'method' => 'GET']) !!}
        {!! Html::search('search') !!}
        {!! Form::close() !!}
    </div>
    <div class="row">
        @if($books->count() > 0)
            {!!
                Table::withContents($books->items())
                    ->striped()
                    ->hover()
                    ->callback('Completo', function($field, $book) {
                        return $book->published ?
                            Label::success('Publicado') :
                            ProgressBar::info($book->percent_complete)->striped()->visible();
                    })
                    ->callback('Ações', function($field, $book) {
                        return callbackTable($field, $book);
                    })
             !!}
        @else
            <div class="well well-lg text-center">
                <strong>Listagem vazia</strong>
            </div>
        @endif
        {!! $books->links() !!}
    </div>
@endsection

<?php
function callbackTable($field, $book)
{
    $linkEdit = getLinkEdit($book);
    $linkChapters = getLinkChapters($book);
    $linkCover = getLinkCover($book);
    $formDelete = getFormDestroy($book);
    $linkDestroy = getLinkDestroy($book);

    return "<ul class=\"list-inline\">
                <li>$linkChapters</li>
                <li>$linkCover</li>
                <li>$linkEdit</li>
                <li>$linkDestroy</li>
            </ul>
            $formDelete";
}

function getLinkDestroy($book)
{
    $deleteFormID = "form-delete_". $book->id;
    return Button::withValue(\Icon::trash())
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
            Form::submit('Lixeira').
            Form::close();
    return $formDelete;
}

function getLinkEdit($book)
{
    if (\Auth::user()->can('update', $book)) {
        return Button::primary('Editar')
                ->asLinkTo(route('books.edit', $book->id))
                ->extraSmall();
    }

    return Button::normal('Editar')
            ->extraSmall()
            ->disable();
}

function getLinkChapters($book)
{
    $chapters = $book->chapters->count();
    return Button::success("Capítulos <span class=\"badge\">{$chapters}</span>")
            ->asLinkTo(route('books.chapters.index', ['book' => $book->id]))
            ->extraSmall();
}

function getLinkCover($book)
{
    return Button::success("Capa")
            ->asLinkTo(route('books.cover.create', ['book' => $book->id]))
            ->extraSmall();
}
?>