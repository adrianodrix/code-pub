@extends('layouts.app')

@section('content')
    <div class="content col-md-9">
        <h2>Livros Preferidos</h2>
        <div class="col-md-12">
            @foreach($products as $product)
                <div class="col-md-3 book-home">
                    <a href="{{route('store.index', ['slug' => $product->id])}}" class="book-thumbnail">
                        <img src="{{ asset($product->thumbnail_small_relative_file) }}" alt="{{$product->title}}"/>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @endsection