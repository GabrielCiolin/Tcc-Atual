@extends('layout.main')

@section('Title', 'Buscar um Cliente')

@section('content')

<h1 class="title">Busque por um cliente:</h1>
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

<form action="/client/search" method="GET">
    <input type="text" id="search" name="search" placeholder="Insira o nome do cliente">
</form>
<div class="list">
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>RG</th>
                <th>CPF</th>
                <th>Contato</th>
                <th>Data de Cadastro</th>
                <th>CEP</th>
                <th>Local</th>
                <th>Número</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
            <tr>
                <td><span class="name">{{$client->name}}</span></td>
                <td>{{$client->rg}}</td>
                <td>{{$client->cpf}}</td>
                <td>{{$client->contact}}</td>
                <td>{{\Carbon\Carbon::parse($client->date)->format('d/m/Y') }}</td>
                <td>
                    @if($client->address->isNotEmpty())
                        @foreach ($client->address as $address)
                            {{$address->cep}}
                            <br>
                        @endforeach
                    @else
                        N/A
                    @endif
                </td>

                <td>
                    @if($client->address->isNotEmpty())
                        @foreach ($client->address as $address)
                            {{$address->place}}
                            <br>
                        @endforeach
                    @else
                        N/A
                    @endif
                </td>

                <td>
                    @if($client->address->isNotEmpty())
                        @foreach ($client->address as $address)
                            {{$address->number}}
                            <br>
                        @endforeach
                    @else
                        N/A
                    @endif
                </td>
                <td class="btn-container">
                    <a href="/client/edit/{{$client -> id}}">Alterar</a>
                    <a href="/client/delete/{{$client -> id}}">Excluir</a>
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