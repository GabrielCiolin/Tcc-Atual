@extends('layout.main')

@section('Title', 'Selecione o cliente')

@section('content')

    <h1 class="title">Pra quem é o Atendimento ?</h1>
    <form action="/call/search" method="GET">
        <input type="text" id="search" name="search" placeholder="Insira o nome do cliente">
    </form>

    <div class="list">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Contato</th>
                    <th>Local</th>
                    <th>Número</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @if (count($results) > 0)
                    @foreach ($results as $result)
                        <tr>
                            <td>
                                @if ($result instanceof App\Models\User)
                                    {{ $result->first_name }} {{ $result->last_name }}
                                @elseif ($result instanceof App\Models\Client)
                                    {{ $result->name }}
                                @endif
                            </td>
                            <td>{{ $result->contact }}</td>
                            <td>
                                @if ($result->address->isNotEmpty())
                                    @foreach ($result->address as $address)
                                        {{ $address->place }}
                                        <br>
                                    @endforeach
                                @else
                                    N/A
                                @endif
                            <td>
                                @if ($result->address->isNotEmpty())
                                    @foreach ($result->address as $address)
                                        {{ $address->number }}
                                        <br>
                                    @endforeach
                                @else
                                    N/A
                                @endif
                            <td class="btn-container">
                                <a href="/call/add">Adicionar</a>
                                <a href="/call/historic/{{ $result->id }}">Histórico</a>

                            </td>
                        </tr>
                    @endforeach
                @elseif($query)
                    <p>Nenhum resultado encontrado.</p>
                @endif
            </tbody>
        </table>
    </div>
    <div class="btn-container">
        <a href="/call/search">Voltar para a página de atendimento</a>
    </div>
@endsection
