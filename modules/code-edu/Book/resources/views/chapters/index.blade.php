@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>{{$book->title}}</h3>
            {!! Button::primary('Novo Capítulo')->asLinkTo(route('books.chapters.create', ['book' => $book->id])) !!}
        </div>
        <br>
        <div class="row">
            {!! Form::model(compact('search'), ['class' => 'form', 'method' => 'GET']) !!}
            {!! Html::search('search') !!}
            {!! Form::close() !!}
        </div>
        <br>
        <div class="row">
            {!!
                Table::withContents($chapters->items())->striped()
                ->callback('Ações', function ($field, $chapter) use($book) {
                    $linkEdit = route('books.chapters.edit', ['book' => $book->id, 'chapter' => $chapter->id]);
                    $linkDestroy = route('books.chapters.destroy', ['book' => $book->id, 'chapter' => $chapter->id]);
                    $deleteForm = "delete-form-{$chapter->id}";
                    $form = Form::open(['route'     => ['books.chapters.destroy', 'book' => $book->id, 'chapter' => $chapter->id],
                                            'method'    => 'DELETE',
                                            'id'        => $deleteForm ,
                                            'style'     => 'display:none']) .
                            Form::close();
                    $anchorDestroy = Button::normal(\Icon::trash())->extraSmall()
                                            ->asLinkto($linkDestroy)
                                            ->addAttributes([
                                                'onclick' => "event.preventDefault(); document.getElementById(\"{$deleteForm}\").submit();"
                                            ]);
                    return "<ul class=\"list-inline\">" .
                                "<li>" . Button::primary('Editar')->extraSmall()->asLinkTo($linkEdit) . "</li>" .
                                "<li>" . $anchorDestroy . "</li>" .
                            "</ul>" .
                            $form;
                })
            !!}
            {{ $chapters->links() }}
        </div>
    </div>
@endsection