@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Lixeira - Livro - {{ $book->title }}</h3>
            <ul class="list-group">
                <li class="list-group-item">
                    <strong>Sub Título</strong>
                </li>
                <li class="list-group-item">{{$book->subtitle}}</li>
                <li class="list-group-item">
                    <strong>Preço</strong>
                </li>
                <li class="list-group-item">{{$book->price}}</li>
                <li class="list-group-item">
                    <strong>Categorias</strong>
                </li>
                <li class="list-group-item">{!! getCategories($book)  !!}</li>
            </ul>
        </div>
        <div class="row">
            {!! Button::primary('Voltar')->asLinkTo(route('trashed.books.index')) !!}
        </div>
    </div>
@endsection

<?php
    function getCategories($book)
    {
        $string = '';
        foreach ($book->categories as $category) {
            $string .= \Label::normal($category->name_trashed);
            $string .= '&nbsp;';
        }
        return $string;
    }
?>