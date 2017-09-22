@extends('layouts.app')

@section('banner')
    @include('codeedustore::store._banner')
@endsection

@section('menu')
    @include('codeedustore::store._menu')
@endsection

@section('content')
    <div class="content col-md-9">
        <h2>Resultados encontrados para <strong>{{ $search }}</strong></h2>
        <div class="col-md-12">
            @foreach($products as $product)
                <div class="col-md-3 book-home">
                    <a href="{{route('store.show-product', ['slug' => $product->slug])}}" class="book-thumbnail">
                        <img src="{{ asset($product->thumbnail_small_relative_file) }}" alt="{{$product->title}}"/>
                        {{ $product->title }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection