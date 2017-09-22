@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>{{$book->title}}</h3>

            {!! Form::model($chapter, [
                    'route' => ['books.chapters.update', 'book' => $book->id, 'chapter' => $chapter->id
                    ], 'class' => 'form', 'method' => 'PUT']) !!}

            @include('codeedubook::chapters._form')

            {!! Form::close() !!}
        </div>
    </div>
@endsection