@extends('layout.main')

@section('Title', 'Adicionar um Atendimento')

@section('content')

    <h1 class="title">Cliente: {{ $result->first_name ?? $result->name }} {{ $result->last_name }}</h1>

    @if ($errors->any())
         {{$errors}}   
    @endif

    <form class="form" action="/call" method="POST">
        @csrf
        <input type="hidden" value="{{ class_basename($result) }}" name="result_type">
        <input type="hidden" value="{{ $result->id }}" name="result_id">
        <input type="hidden" value="{{ $result->id }}" name="client_id">
        <input type="hidden" value="{{ session('user_id') }}" name="user_id">


        <label>Nome: {{ $result->first_name ?? $result->name }} {{ $result->last_name }} </label>
        <label>Contato: {{ $result->contact }} </label>
        @if ($result->address->isNotEmpty())
            @foreach ($result->address as $address)
                <label>Endereço: {{ $address->place }} {{ $address->number }} </label>
            @endforeach
        @else
            <label>Endereço: N/A </label>
        @endif
        <label>Atendente:
            @if (Session::get('name'))
                {{ session('name') }}
            @endif
        </label>

        <hr>

        <div class="form-group">
            <label class="call_form">Selecione o Técnico</label>
            <select id="technician" name="technician_id" class="nice-select">
                <option data-display="Select" selected disabled>Técnico</option>
                @foreach ($users as $user)
                    <option value={{ $user->id }}>{{ $user->first_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="call_form">Selecione o Tipo de Atendimento:</label>
            <select id="type"  class="nice-select" name="service_type" >
                <option value="internal">Interno</option>
                <option value="external">Externo</option>
            </select>
        </div>

        <div class="form-group">
            <label>Digite informações do Atendimento</label>
            <textarea name="description_call" class="textarea" rows="10" placeholder="Insira aqui as informações" required></textarea>
        </div>

        <div class="form-group">
            <label>Observações adicionais</label>
            <textarea name="comments" class="textarea" rows="6"></textarea>
        </div>

        <button type="submit" class="btn-form">Cadastrar</button>
    </form>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function(Event) {
            console.log('asd')
            var options = {
                searchable: true
            };
            NiceSelect.bind(document.getElementById("technician"), options);
            NiceSelect.bind(document.getElementById("type"), options);
        })
    </script>
@endsection
