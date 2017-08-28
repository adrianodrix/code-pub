@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h3>Novo Livro</h3>
        {!! Form::open(['route'=>'books.store','class'=>'form col-md-8'])!!}
        @include('books.form')
        {!! Form::close() !!}
    </div>
</div>
@endsection