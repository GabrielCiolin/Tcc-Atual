<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('Title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="/css/tcc.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/nice-select2.css">


    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script> --}}



</head>



<body>

    <header>
        <div class="container menu">
            <div class="menu_bar">
                <div class="logo_menu">
                    <h1>G.F<span> Sistemas</span></h1>
                </div>

                <ul class=" item_menu">
                    <li><a href="/">Home</a></li>
                    <li>
                        <a href="#">Atendimentos <i class="fas fa-caret-down"></i></a>

                        <div class="drop_atendimentos">
                            <ul>
                                <li><a href="/call/search">Cadastrar</a></li>
                                <li><a href="#">Atendimento Local</a></li>
                                <li><a href="#">Atendimento Externo</a></li>
                                <li><a href="#">Aguardando</a></li>
                                <li><a href="#">Finalizados</a></li>

                            </ul>
                        </div>

                    </li>


                    <li>
                        <a href="/client/search">Clientes <i class="fas fa-caret-down"></i></a>

                        <div class="drop_clientes">
                            <ul>
                                <li><a href="/client/add">Cadastrar</a></li>
                                <li><a href="/client/search">Buscar</a></li>
                            </ul>
                        </div>
                    </li>

                    @if (Session::get('is_admin'))
                        <li>
                            <a href="/user/search">Usuários <i class="fas fa-caret-down"></i></a>
                            <div class="drop_usuarios">
                                <ul>
                                    <li><a href="/user/add">Cadastrar</a></li>
                                    <li><a href="/user/search">Buscar</a></li>
                                </ul>
                            </div>
                        </li>
                    @endif

                </ul>

                <div class="sair">
                    <img src="/img/img_user.png" alt="User">
                    @if (Session::get('name'))
                        <h5>Seja bem-vindo,<br>{{ session('name') }} </h5>
                    @endif


                    <ul>
                        <li>
                            <a href="{{ route('login.logout') }}">Sair</a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

    </header>

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer>
        <div class="container">
            <p>G.F Sistemas &copy; 2023</p>
        </div>

        <script src="/js/nice-select2.js"></script>
        @yield('scripts');

    </footer>

</body>


</html>
