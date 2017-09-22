@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Novo Perfil</h3>

            {!! Form::open(['route' => 'codeeduuser.roles.store', 'class' => 'form']) !!}

            @include('codeeduuser::roles._form')

            {!! Form::close() !!}
        </div>
    </div>
@endsection