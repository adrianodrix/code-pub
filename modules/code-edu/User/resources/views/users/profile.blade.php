@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar minha conta</h3>

            {!! Form::open(['route' => 'codeeduuser.user.profile.update', 'class' => 'form', 'method' => 'PUT']) !!}

                {!! Html::openFormGroup('password', $errors) !!}
                    {!! Form::label('password', 'Senha',['class' =>'control-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                    {!! Form::error('password', $errors) !!}
                {!! Html::closeFormGroup() !!}

                {!! Html::openFormGroup('password_confirmation', $errors) !!}
                    {!! Form::label('password_confirmation', 'Confirme sua Senha',['class' =>'control-label']) !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                {!! Html::closeFormGroup() !!}

                {!! Html::openFormGroup() !!}
                    {!! Button::primary('Salvar')->submit() !!}
                {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection