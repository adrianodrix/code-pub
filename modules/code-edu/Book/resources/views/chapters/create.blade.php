@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>{{$book->title}}</h3>

            {!! Form::open(['route' => ['chapters.store', 'book' => $book->id], 'class' => 'form']) !!}
                @include('codeedubook::chapters._form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection