@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Perfil de Usuários</h3>
            {!! Button::primary('Novo Perfil')->asLinkTo(route('codeeduuser.roles.create')) !!}
        </div>
        <br>
        <div class="row">
            {!! Form::model(compact('search'), ['class' => 'form', 'method' => 'GET']) !!}
            {!! Html::search('search') !!}
            {!! Form::close() !!}
        </div>
        <br>
        <div class="row">
            @if($roles->count() > 0)
            {!!
                Table::withContents($roles->items())->striped()
                ->callback('Actions', function ($field, $role){
                    $linkEdit = route('codeeduuser.roles.edit', ['role' => $role->id]);
                    $linkEditPermission = route('codeeduuser.roles.permissions.edit', ['role' => $role->id]);
                    $linkDestroy = route('codeeduuser.roles.destroy', ['role' => $role->id]);
                    $deleteForm = "delete-form-{$role->id}";

                    $form = Form::open(['route'     =>
                                    ['codeeduuser.roles.destroy' , 'role' => $role->id],
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


                    return "<ul class=\"list-inline\">" .
                                "<li>" . Button::primary('Editar')->asLinkTo($linkEdit)->extraSmall() . "</li>" .
                                "<li>" . Button::primary('Permissões')->asLinkTo($linkEditPermission)->extraSmall() . "</li>" .
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
            {{ $roles->links() }}
        </div>
    </div>
@endsection