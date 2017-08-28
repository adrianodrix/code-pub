@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Livro</h3>
            {!! Form::model($book,['route'=>['books.update',$book->id],'class'=>'form col-md-8','method'=>'PUT'])!!}
                @include('books.form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection