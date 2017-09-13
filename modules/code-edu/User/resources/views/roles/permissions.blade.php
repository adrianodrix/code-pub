@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Permissões para {{ $role->description }}</h3>
        </div>
        <div class="row">
            {!! Form::open(['route' => ['codeeduuser.roles.permissions.update', $role->id], 'class' => 'form', 'method' => 'PUT']) !!}

            {!! Html::openFormGroup(['permissions','permissions.*'], $errors) !!}
            <ul class="list-group">
                @foreach($permissionsGroup as $pg)
                    <li class="list-group-item">
                        <h4 class="list-group-item-heading">
                            <strong>{{ $pg->description }}</strong>
                        </h4>
                        <p class="list-group-item-text">
                            <ul class="list-inline">
                                <?php
                                    $permissionsSubGroup = $permissions->filter(function ($value) use ($pg) {
                                        return $value->name == $pg->name;
                                    });
                                ?>
                                @foreach($permissionsSubGroup as $permission)
                                    <li>
                                        <div class="checkbox checkbox-primary">
                                            <input
                                                    type="checkbox" name="permissions[]" id="permissions-{{ $permission->id }}" value="{{ $permission->id }}"
                                                    {{ $role->permissions->contains('id', $permission->id) ? 'checked="checked"' : '' }}
                                            />
                                            <label for="permissions-{{ $permission->id }}">
                                                {{ $permission->resource_description }}
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </p>
                    </li>
                @endforeach
            </ul>
            {!! Form::error('permissions', $errors) !!}
            {!! Form::error('permissions.*', $errors) !!}

            {!! Html::closeFormGroup() !!}

            {!! Html::openFormGroup() !!}
            {!! Button::primary('Salvar')->submit() !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection