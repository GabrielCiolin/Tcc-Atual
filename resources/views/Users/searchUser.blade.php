@extends('layout.main')

@section('Title', 'Buscar um Usuário')

@section('content')



<h1 class="title">Busque por um Usuário:</h1>

@if(session('msg'))
    <div class="alert-success" id="success-alert">
        {{ session('msg') }}
    </div>
@endif

@if(session('msg-danger'))
    <div class="alert-danger" id="alert-danger">
        {{ session('msg-danger') }}
    </div>
    
@endif

@if(session('msg-success'))
    <div class="alert-success" id="success-alert">
        {{ session('msg-success') }}
    </div>
    
@endif

<form action="/user/search" method="GET">
    <input type="text" id="search" name="search" placeholder="Insira o nome do usuário">
</form>
<div class="list">
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>RG</th>
                <th>CPF</th>
                <th>Contato</th>
                <th>Email</th>
                <th>Prioridade</th>
                <th>Data de Cadastro</th>
                <th>CEP</th>
                <th>Local</th>
                <th>Número</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td><span class="name">{{$user->first_name}}</span></td>
                <td><span class="name">{{$user->last_name}}</span></td>
                <td>{{$user->rg}}</td>
                <td>{{$user->cpf}}</td>
                <td>{{$user->contact}}</td>
                <td>{{$user->email}}</td>
                <td>{{$roles[$user->is_admin]}}</td>

                <td>{{ \Carbon\Carbon::parse($user->date)->format('d/m/Y') }}</td>

                <td>
                    @if($user->address->isNotEmpty())
                        @foreach ($user->address as $address)
                            {{$address->cep}}
                            <br>
                        @endforeach
                    @else
                        N/A
                    @endif
                </td>

                <td>
                    @if($user->address->isNotEmpty())
                        @foreach ($user->address as $address)
                            {{$address->place}}
                            <br>
                        @endforeach
                    @else
                        N/A
                    @endif
                </td>

                <td>
                    @if($user->address->isNotEmpty())
                        @foreach ($user->address as $address)
                            {{$address->number}}
                            <br>
                        @endforeach
                    @else
                        N/A
                    @endif
                </td>
                <td class="btn-container">
                    <a href="/user/edit/{{$user -> id}}">Alterar</a>
                    <a href="/user/delete/{{$user -> id}}">Excluir</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
  
  @if(session('msg-success'))
        setTimeout(function() {
            document.getElementById("success-alert").style.display = 'none';
        }, 3000);
    @endif

    setTimeout(function() {
        document.getElementById("success-alert").style.display = 'none';
    }, 3000);

    @if(session('msg-danger'))
        setTimeout(function() {
            document.getElementById("alert-danger").style.display = 'none';
        }, 3000);
    @endif
</script>
@endsection

