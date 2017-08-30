@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Categoria</h3>
            {!! Form::model($category,['route'=>['categories.update',$category->id],'class'=>'form col-md-8','method'=>'PUT'])!!}
                @include('categories.form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection