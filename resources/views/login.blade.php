<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>G.F Sistemas -Seja bem vindo!</title>

    <link rel="stylesheet" href="/css/login.css">


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
                <form class="dados_login" action= {{route('login')}} method="POST">
                    @csrf
                    <input type="email" value="{{old('email')}}" name="email" id="email" placeholder="Insira seu E-mail">
                    {{$errors->has('email') ? $errors->first('email') : ''}}
                    <input type="password" name="password" id="password" placeholder=" Insira sua senha">
                    {{$errors->has('password') ? $errors->first('password') : ''}}
                    <button type="submit">Entrar</button>
                </form>
                

            </div>
            {{-- {{isset($erro) && $erro != '' ? $erro : ''}} --}}
        </div>
    </div>


</body>


</html>