<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="padding-top: 70px;">
    <div id="app">
        <?php
            $navBar = Navbar::withBrand(config('app.name', 'Laravel'), url('/'))
                ->inverse()
                ->top();

            if (Auth::guest()) {
                $linksGuest = Navigation::right()->links([
                        ['link' => route('login'), 'title' => 'Entrar'],
                        ['link' => route('register'), 'title' => 'Cadastre-se'],
                ]);
                $navBar->withContent($linksGuest);
            }

            if (Auth::check()) {
                $menu = Navigation::links([
                    ['link' => route('categories.index'), 'title' => 'Categorias'],
                    ['link' => route('books.index'), 'title' => 'Livros'],
                ]);
                $navBar->withContent($menu);

                $user = Navigation::right()->links([
                    [
                        'Lixeira',
                        [
                            ['link' => route('trashed.books.index'), 'title' => 'Livros'],
                        ]
                    ],
                    [
                        Auth::user()->name,
                        [
                            [
                                'link' => url('/logout'),
                                'title' => 'Sair',
                                'linkAttributes' => [
                                        'onclick' => "event.preventDefault();document.getElementById(\"logout-form\").submit();"
                                ]
                            ]
                        ]
                    ]
                ]);
                $navBar->withContent($user);
            }
        ?>

        {!! $navBar !!}
        {!!
            Form::open(['url'=> route('logout'), 'id' => 'logout-form', 'style'=>'display:none']).
            csrf_field().
            Form::close()
        !!}

        <div class="container">
            @if (Session::has('message'))
                {!! Alert::{Session::get('message')['type']}(Session::get('message')['message'])->close() !!}
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
