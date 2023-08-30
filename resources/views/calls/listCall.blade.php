@extends('layout.main')

@section('Title', 'Lista dos Atendimentos')

@section('content')

    <h1 class="title">Lista de Chamados:</h1>
    <div class="card-container">
        @foreach ($calls as $call)
            <div class="card">
                <div class="card-header">
                    Chamado #{{ $call->id }}
                </div>
                <div class="card-body">
                    <div class="card-row">
                        <div>
                            <strong>Usuário:</strong> {{ $call->user->first_name ?? 'N/A' }}
                        </div>

                        <div>
                            <strong>Cliente:</strong>
                            @if ($call->client_type === 'Client')
                                {{ $call->client->name ?? 'N/A' }}
                            @elseif ($call->client_type === 'User')
                                {{ $call->user->first_name ?? 'N/A' }} {{ $call->user->last_name ?? 'N/A' }}
                            @else
                                N/A
                            @endif
                        </div>
                        <div>
                            <strong>Telefone:</strong>
                            @if ($call->client_type === 'Client')
                                {{ $call->client->contact ?? 'N/A' }}
                            @elseif ($call->client_type === 'User')
                                {{ $call->user->contact ?? 'N/A' }}
                            @else
                                N/A
                            @endif
                        </div>



                        <div>
                            <?php 
                            dd($calls);
                            ?> 
                            @if ($call->client_type === 'Client')
                                @foreach ($calls->client->adressClient as $address)

                                    <p>Endereço do Cliente: {{ $address->place }}</p>
                                @endforeach
                            @endif
                        </div>

                        {{-- @if ($calls->client)
    <p>Endereço do Cliente: {{ $address->address->place }}</p>
@endif</div> --}}

                        {{-- <div>
                        <strong>Endereço:</strong>
                        @if ($call->client_type === 'Client')
                            @if ($call->client->adressClient)
                                @foreach ($call->client->adressClient as $address)
                                    {{ $address->place }}
                                    <br>
                                @endforeach
                            @else
                                N/A
                            @endif
                        @elseif ($call->client_type === 'User')
                            @if ($call->user->adressUser)
                                @foreach ($call->userAddress as $address)
                                    {{ $address->place }}
                                    <br>
                                @endforeach
                            @else
                                N/A
                            @endif
                        @else
                            N/A
                        @endif
                    </div> --}}



                        {{-- <div>
                            <strong>Endereço:</strong>
                            @if ($call->client_type === 'Client')
                                {{ $call->client->address->place ?? 'N/A' }}
                            @elseif ($call->client_type === 'User')
                                {{ $call->user->address->place ?? 'N/A' }}
                            @else
                                N/A
                            @endif
                        </div> --}}

                        <div>
                            <strong>Técnico:</strong> {{ $call->technician->first_name ?? 'N/A' }}
                        </div>
                        <div>
                            <strong>Tipo de Serviço:</strong> {{ \App\Models\Call::ROLES[$call->service_type] }}
                        </div>
                    </div>

                    <div class="card-divider"></div>
                    <div class="card-description">
                        <strong>Descrição do Chamado:</strong>
                        <p>{{ $call->description_call }}</p>
                    </div>
                    <div class="card-divider"></div>
                    <div class="card-observations">
                        <strong>Observações:</strong>
                        @foreach (explode("\n", $call->comments) as $observation)
                            <p>{{ $observation }}</p>
                            <div class="card-divider"></div>
                        @endforeach
                    </div>
                </div>
                <div class="btn-container">
                    <a href="#">Alterar</a>
                    <a href="#">Adicionar Observações</a>
                    <a href="#">Finalizar</a>
                </div>
            </div>
        @endforeach
    </div>

@endsection
