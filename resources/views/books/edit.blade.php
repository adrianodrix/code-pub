@extends('layouts.app')

@section('content')
<h3>Editar Livro</h3>
<div>
    <span>Autor: {{ $book->author->name  }}</span>
</div>
<hr/>
{!! Form::model($book,['route'=>['books.update',$book->id],'class'=>'form col-md-8','method'=>'PUT'])!!}
    @include('books.form')
{!! Form::close() !!}
@endsection