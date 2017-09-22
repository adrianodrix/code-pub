@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Lixeira - Livros</h3>
        </div>
        <div class="row">
            {!! Form::model(compact('search'), ['class' => 'form', 'method' => 'GET']) !!}
            {!! Html::search('search') !!}
            {!! Form::close() !!}
        </div>
        <br>
        <div class="row">
            @if($books->count() > 0)
                {!!
                    Table::withContents($books->items())->striped()
                    ->callback('Ações', function ($field, $book){
                        $linkView = route('trashed.books.show', ['book' => $book->id]);
                        $linkRestore = route('trashed.books.index', ['book' => $book->id]);
                        $restoreForm = "restore-form_{$book->id}";

                        $form = Form::open(['route'     =>
                                    ['trashed.books.update' , 'book' => $book->id],
                                                'method'    => 'PUT',
                                                'id'        => $restoreForm ,
                                                'style'     => 'display:none']) .
                                //Form::hidden('redirect_to', URL::previous()) .
                                Form::close();

                        $anchorRestore = Button::normal(\Icon::copy())
                                                ->asLinkto($linkRestore)
                                                ->addAttributes([
                                                    'title' => 'Restaurar Livro',
                                                    'onclick' => "event.preventDefault(); document.getElementById(\"{$restoreForm}\").submit();"
                                                ]);

                        return "<ul class=\"list-inline\">" .
                                    "<li>" .
                                        Button::normal(\Icon::eyeOpen())
                                            ->asLinkTo($linkView)
                                            ->addAttributes([
                                                'title' => 'Ver',
                                            ]) .
                                    "</li>" .
                                    "<li>" . $anchorRestore . "</li>" .
                                "</ul>" .
                                $form;
                    })
                !!}
            @else
                <div class="well well-lg text-center">
                    <strong>A Lixeira esta vazia</strong>
                </div>
            @endif
            {{ $books->links() }}
        </div>
    </div>
@endsection