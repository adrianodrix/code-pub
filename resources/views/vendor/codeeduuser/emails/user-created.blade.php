<h1>{{config('app.name')}}</h1>
<hr/>
<h3>Olá! {{ $user->name }}.</h3>
<p>Sua conta na plataforma foi criada,</p>
<p>para o e-mail: <strong>{{$user->email}}</strong></p>
<p>
    <?php $link = route('codeeduuser.user.email-verification.check', $user->verification_token). '?email=' . urlencode($user->email) ; ?>
    Clique aqui para verificar sua conta <a href="{{$link}}">{{$link}}</a>
</p>
<small>Não responda este e-mail, ele é gerado automaticamente</small>
