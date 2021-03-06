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
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('/css/store.css') }}" rel="stylesheet">

    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
                'userId' => auth()->check() ? auth()->user()->id : null
        ]); ?>
    </script>

</head>
<body style="padding-top: 70px;">
    <div id="app">
        <?php
            $appName = config('app.name');
            $navBar = Navbar::withBrand("<img src=\"/img/logo.png\" title=\"$appName\" alt=\"$appName\"> ", url('/'))
                ->top();

            if (Auth::guest()) {
                $formSearch = Form::open(['url' => route('store.search'), 'class' => 'form-inline form-search navbar-left', 'method' => 'GET']).
                        Html::openFormGroup().
                        InputGroup::withContents(Form::text('q', null, ['class' => 'form-control']))
                                ->append(Form::submit('', ['class' => 'btn-search'])).
                        Form::close();
                $menuRight = Navigation::pills([
                        [
                                'link' => route('register'),
                                'title' => 'Registrar',
                                'linkAttributes' => [
                                        'class' => 'btnnew btnnew-default'
                                ]
                        ],
                        [
                                'link' => route('login'),
                                'title' => 'Entrar',
                                'linkAttributes' => [
                                        'class' => 'btnnew btnnew-default'
                                ]
                        ],
                ])->right()->render();
                $navBar->withContent($menuRight)->withContent("<div>$formSearch</div>");
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
                            ['link' => route('store.orders'), 'title' => 'Minhas compras', 'permission' => true],
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

            @yield('banner')
            @yield('menu')
            <section>
                @yield('content')
            </section>
        </div>
    </div>
    <footer class="text-center">
        <p>{{ config('app.name') }} &copy; {{ date('Y') }}</p>
    </footer>
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
