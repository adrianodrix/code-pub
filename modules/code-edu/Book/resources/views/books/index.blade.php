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
                    ->callback('Capa', function($field, $book) {
                        return \Image::rounded($book->thumbnail_small_relative_file)->withAttributes(['width' => '70px']);
                    })
                    ->callback('', function($field, $book) {
                        $menu = callbackTable($field, $book);
                        return '<ul class="nav nav-pills">
                                  <li role="presentation" class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                      Ações <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                      '. $menu .'
                                    </ul>
                                  </li>
                                </ul>';
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

    $formExport = getFormExport($book);
    $linkExport = getLinkExport($book);

    return "<ul class=\"list-inline\">
                <li>$linkChapters</li>
                <li>$linkCover</li>
                <li>$linkExport</li>
                <li>$linkEdit</li>
                <li>$linkDestroy</li>
            </ul>
            $formDelete
            $formExport";
}

function getLinkDestroy($book)
{
    $deleteFormID = "form-delete_". $book->id;
    return Button::withValue(\Icon::trash() .' Excluir')
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
    return Button::success("<span class=\"badge\">{$chapters}</span> Capítulos")
            ->asLinkTo(route('books.chapters.index', ['book' => $book->id]))
            ->extraSmall();
}

function getLinkCover($book)
{
    return Button::success("Capa")
            ->asLinkTo(route('books.cover.create', ['book' => $book->id]))
            ->extraSmall();
}

function getLinkExport($book)
{
    $linkExport = route('books.export', ['book' => $book->id]);
    $exportFormId = "export-form-{$book->id}";

    return Button::success(\Icon::download() .' Exportar')
            ->asLinkto($linkExport)
            ->extraSmall()
            ->addAttributes([
                    'onclick' => "event.preventDefault(); document.getElementById(\"{$exportFormId}\").submit();"
            ]);

}

function getFormExport($book)
{
    $exportFormId = "export-form-{$book->id}";
    return Form::open(['route'     => ['books.export' , 'book' => $book->id],
                    'method'    => 'POST',
                    'id'        => $exportFormId ,
                    'style'     => 'display:none']) .
            Form::close();
}
?>