@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Capa para: {{$book->title}}</h3>
        </div>
        <br>
        <div class="row">
            {!! Form::open(['route' => ['books.cover.store', $book->id], 'files' => true]) !!}

            {!! Form::hidden('redirect_to', URL::previous()) !!}

            {!! Html::openFormGroup('file', $errors) !!}
            {!! Form::label('file', 'Informe uma imagem para capa do livro (aceita somente imagens jpeg') !!}
            {!! Form::file('file', ['class' => 'form-control']) !!}
            {!! Form::error('file', $errors) !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection