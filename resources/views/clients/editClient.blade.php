@extends('layout.main')

@section('Title', 'Editar um Cliente')

@section('content')

  <h1 class="title">Editando o cliente: {{$clients->name}}</h1>

  <form class="form" action="/client/update/{{$clients ->id}}" method="POST">
    @csrf
    @method('PUT')
    <label for="name">Nome:</label>
    <input type="text" id="name" name="name" required value="{{$clients ->name}}"><br><br>

    <label for="rg">RG:</label>
    <input type="text" id="rg" name="rg" required  value="{{$clients ->rg}}"><br><br>

    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" required  value="{{$clients ->cpf}}"><br><br>

    <label for="contact">Contato:</label>
    <input type="text" id="contact" name="contact" required  value="{{$clients ->contact}}"><br><br>



    @foreach ($clients->address as $address)
      <label for="cep">Cep:</label>
      <input type="text" id="cep" name="cep[]" required value="{{ $address->cep }}"><br><br>

      <label for="place">Endereço:</label>
      <input type="text" id="place" name="place[]" required value="{{ $address->place }}"><br><br>

      <label for="number">Número:</label>
      <input type="text" id="number" name="number[]" required value="{{ $address->number }}"><br><br>

          <input type="hidden" name="address_id[]" value="{{ $address->id }}">

     @endforeach

    <button type="submit" class="btn-form">Alterar</button>
  </form>

@endsection