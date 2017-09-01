@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Usuários</h3>
            {!! Button::primary('Novo Usuário')->asLinkTo(route('codeeduuser.users.create')) !!}
        </div>
        <br>
        <div class="row">
            {!! Form::model(compact('search'), ['class' => 'form', 'method' => 'GET']) !!}
            {!! Html::search('search') !!}
            {!! Form::close() !!}
        </div>
        <br>
        <div class="row">
            @if($users->count() > 0)
            {!!
                Table::withContents($users->items())->striped()
                ->callback('Actions', function ($field, $user){
                    $linkEdit = route('codeeduuser.users.edit', ['user' => $user->id]);

                    if($user->id == \Auth::user()->id) {
                        $form = "";
                        $anchorDestroy = Button::withValue(\Icon::trash())
                                                ->disable()
                                                ->extraSmall();
                    } else {
                        $linkDestroy = route('codeeduuser.users.destroy', ['user' => $user->id]);
                        $deleteForm = "delete-form-{$user->id}";

                        $form = Form::open(['route'     =>
                                        ['codeeduuser.users.destroy' , 'user' => $user->id],
                                        'method'    => 'DELETE',
                                        'id'        => $deleteForm ,
                                        'style'     => 'display:none']) .
                                Form::close();

                        $anchorDestroy = Button::withValue(\Icon::trash())
                                                ->asLinkto($linkDestroy)
                                                ->extraSmall()
                                                ->addAttributes([
                                                    'onclick' => "event.preventDefault(); document.getElementById(\"{$deleteForm}\").submit();"
                                                ]);

                    }

                    return "<ul class=\"list-inline\">" .
                                "<li>" . Button::primary('Editar')->asLinkTo($linkEdit)->extraSmall() . "</li>" .
                                "<li>" . $anchorDestroy . "</li>" .
                            "</ul>" .
                            $form;
                })
            !!}
            @else
                <div class="well well-lg text-center">
                    <strong>Listagem vazia</strong>
                </div>
            @endif
            {{ $users->links() }}
        </div>
    </div>
@endsection