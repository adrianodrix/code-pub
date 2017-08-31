@extends('layouts.app')

@section('content')
    <h3>Novo Livro</h3>
    {!! Form::open(['route'=>'books.store','class'=>'form col-md-8'])!!}
        @include('codeedubook::books._form')
    {!! Form::close() !!}
@endsection