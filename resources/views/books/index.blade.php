@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <h1>Livros</h1>
        <a class="btn btn-primary" href="{{route('books.create')}}">Novo Livro</a>
        <hr/>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Código</th>
                <th>Título</th>
                <th>Preço</th>
                <th>Acões</th>
            </tr>
            </thead>

            <tbody>
            @foreach($books as $book)
                <?php $formDeleteID ="form-delete".$loop->index; ?>
                <tr>
                    <td>{{$book->id}}</td>
                    <td>{{$book->title}}</td>
                    <td>{{$book->price}}</td>
                    <td>
                        <ul class="list-inline">
                            <li>
                                <a href="{{route('books.edit',$book->id)}}"
                                    class="label label-primary">Editar</a>
                            </li>
                            <li>
                                <a href="{{route('books.destroy',$book->id)}}"
                                   onclick="event.preventDefault(); document.getElementById('{{$formDeleteID}}').submit()"
                                    class="label label-default">
                                    Excluir</a>
                            </li>
                        </ul>

                        {!! Form::open(['route'=>['books.destroy',$book->id],'method'=>'DELETE',
                            'class'=>'form-inline','style'=>'display:none', 'id'=>$formDeleteID])!!}
                        {!! Form::submit('Excluir') !!}
                        {!! Form::close() !!}

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $books->links() !!}
    </div>
</div>
@endsection