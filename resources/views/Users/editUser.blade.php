@extends('layout.main')

@section('Title', 'Editar um Usuário')

@section('content')

  <h1 class="title">Editando o Usuário: {{$users->first_name}}</h1>

  <form class="form_user" action="/user/update/{{$users ->id}}" method="POST">
    @csrf
    @method('PUT')

    <label for="first_name">Nome:</label>
    <input type="text" id="first_name" name="first_name" required value="{{$users ->first_name}}"><br><br>

    <label for="last_name">Sobrenome:</label>
    <input type="text" id="last_name" name="last_name" required value="{{$users ->last_name}}"><br><br>

    <label for="rg">RG:</label>
    <input type="text" id="rg" name="rg" required value="{{$users ->rg}}"><br><br>

    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" required value="{{$users ->cpf}}"><br><br>

    <label for="contact">Contato:</label>
    <input type="text" id="contact" name="contact" required value="{{$users ->contact}}"><br><br>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email" required value="{{$users ->email}}"><br><br>

    <label for="password">Senha:</label>
    <input type="password" id="password" name="password" required value="{{$users ->password}}"><br><br>

    <select for="is_admin" value="{{$users ->is_admin}}">
        <option value ="1">Admin</option>
        <option value = "0">Usuário</option>
    <select>

        @foreach ($users->address as $address)
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