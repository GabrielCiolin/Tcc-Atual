<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>G.F Sistemas -Seja bem vindo!</title>

    <link rel="stylesheet" href="/css/login.css">

    <style>
        .alert {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
        border-radius: 4px;
        padding: 10px;
        margin-bottom: 15px;
    }

    .alert .close {
        cursor: pointer;
    }
    </style>

</head>


<body>

    <div class="dados">
        <div class="parte_esquerda">
            <h2>Seja bem - vindo!</h2>
            <img src="/img/img_login.jpg" alt="">
        </div>

            <div class="parte_direita">
                <div class="card">
                    <h1>G.F Sistemas</h1>
                    @if (session('error'))
                    <div class="alert">
                        {{ session('error') }}
                    </div>
                @endif
                    <form class="dados_login" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" value="{{ old('email') }}" name="email" id="email" class="form-control" placeholder="Insira seu E-mail">
                            @if ($errors->has('email'))
                                <div class="alert">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Insira sua senha">
                            @if ($errors->has('password'))
                                <div class="alert">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn">Entrar</button>
                    </form>
                </div>
            </div>


        </div>
    </div>


</body>


</html>