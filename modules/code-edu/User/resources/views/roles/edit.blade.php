@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Perfil</h3>

            {!! Form::model($user, [
                    'route' => ['codeeduuser.roles.update', 'user' => $user->id
                    ], 'class' => 'form', 'method' => 'PUT']) !!}

            @include('codeeduuser::roles._form')

            {!! Form::close() !!}
        </div>
    </div>
@endsection