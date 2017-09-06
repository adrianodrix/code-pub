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
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
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
                $menu = [
                    ['link' => route('categories.index'), 'title' => 'Categorias', 'permission' => 'categories/index'],
                    ['link' => route('books.index'), 'title' => 'Livros', 'permission' => 'books/index'],
                ];
                $navBar->withContent(Navigation::links(NavBarAuth::getLinksAuthorized($menu)));

                $user = [
                    [
                        'Lixeira',
                        [
                                ['link' => route('trashed.books.index'), 'title' => 'Livros', 'permission' => 'trashed/index'],
                        ]
                    ],
                    [
                        Auth::user()->name,
                        [
                            ['link' => route('codeeduuser.user.profile.edit'), 'title' => 'Minha Conta', 'permission' => true],
                            //Navigation::NAVIGATION_DIVIDER,
                            ['link' => route('codeeduuser.users.index'), 'title' => 'Usuários', 'permission' => 'users/index'],
                            ['link' => route('codeeduuser.roles.index'), 'title' => 'Perfil de Usuários', 'permission' => 'roles/index'],
                            //Navigation::NAVIGATION_DIVIDER,
                            [
                                'link' => route('logout'),
                                'title' => 'Sair',
                                'permission' => true,
                                'linkAttributes' => [
                                        'onclick' => "event.preventDefault();document.getElementById(\"logout-form\").submit();"
                                ]
                            ]
                        ]
                    ]
                ];

                $navBar->withContent(Navigation::right()->links(NavBarAuth::getLinksAuthorized($user)));
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
                @if (isset(Session::get('message')['type']))
                    {!! Alert::{Session::get('message')['type']}(Session::get('message')['message'])->close() !!}
                @else
                    {!! Alert::warning(Session::get('message'))->close() !!}
                @endif
            @endif

            @yield('content')
        </div>
    </div>
    <footer class="text-center">
        <p>{{ config('app.name') }} &copy; {{ date('Y') }}</p>
    </footer>
    <!-- Scripts -->
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('content')
    </script>
</body>
</html>
