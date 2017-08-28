@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h3>Nova Categoria</h3>
        {!! Form::open(['route'=>'categories.store','class'=>'form col-md-8'])!!}
        @include('categories.form')
        {!! Form::close() !!}
    </div>
</div>
@endsection