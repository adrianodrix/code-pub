@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">

        <h1>Categorias</h1>
        <a class="btn btn-primary" href="{{route('categories.create')}}">Nova Categoria</a>
        <hr/>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Acões</th>
                </tr>
            </thead>

            <tbody>
            @foreach($categories as $category)
                <?php $deleteFormID ="form-delete_". $loop->index; ?>
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <ul class="list-inline">
                            <li>
                                <a href="{{route('categories.edit', $category->id)}}"
                                   class="label label-primary">
                                    Editar</a>
                            </li>
                            <li>
                                <a href="{{route('categories.destroy', $category->id)}}"
                                   onclick="event.preventDefault(); document.getElementById('{{ $deleteFormID }}').submit()"
                                   class="label label-default">
                                    Excluir</a>
                            </li>
                        </ul>

                        {!! Form::open(['route'=>['categories.destroy', $category->id],'method'=>'DELETE',
                            'class'=>'form-inline','style'=>'display:none', 'id'=> $deleteFormID])!!}
                        {!! Form::submit('Excluir') !!}
                        {!! Form::close() !!}

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $categories->links() !!}
    </div>
</div>
@endsection