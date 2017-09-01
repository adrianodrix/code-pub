@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Usuário</h3>

            {!! Form::model($user, [
                    'route' => ['codeeduuser.users.update', 'user' => $user->id
                    ], 'class' => 'form', 'method' => 'PUT']) !!}

            @include('codeeduuser::users._form')

            {!! Form::close() !!}
        </div>
    </div>
@endsection