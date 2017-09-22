@extends('layouts.app')

@section('content')
    <div class="content container">
        <h2>Checkout</h2>

        <h3>Informação do Livro: {{ $product->title }}</h3>
        <p>{{ $product->description }}</p>
        <p>Preço: ${{ $product->price }}</p>

        <div class="stripe-button">
            {!! Form::open([ 'url' => route('store.process', ['product'=> $product->slug]),'method' => 'POST'])!!}
            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-label="Pagar com cartão"
                    data-panel-label="Pagar"
                    data-email="{{ auth()->user()->email }}"
                    data-key="{{ config('services.stripe.public_key')  }}"
                    data-amount="{{  $product->price * 100 }}"
                    data-name="Code Pub"
                    data-description="Livro: {{ $product->title }}"
                    data-locale="auto"></script>
            {!! Form::close() !!}
        </div>
    </div>
@endsection