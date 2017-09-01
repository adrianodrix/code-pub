@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Novo Usuário</h3>

            {!! Form::open(['route' => 'codeeduuser.users.store', 'class' => 'form']) !!}

            @include('codeeduuser::users._form')

            {!! Form::close() !!}
        </div>
    </div>
@endsection