@extends('layout.main')

@section('Title', 'Adicionar um Usuário')

@section('content')

  <h1 class="title">Cadastre um Usuário</h1>

  <form class="form_user" action="/user" method="POST">
    @csrf
    <label for="first_name">Nome:</label>
    <input type="text" id="first_name" name="first_name" required><br><br>

    <label for="last_name">Sobrenome:</label>
    <input type="text" id="last_name" name="last_name" required><br><br>

    <label for="rg">RG:</label>
    <input type="text" id="rg" name="rg" required><br><br>

    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" required><br><br>

    <label for="contact">Contato:</label>
    <input type="text" id="contact" name="contact" required><br><br>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email" required><br><br>

    <label for="password">Senha:</label>
    <input type="password" id="password" name="password" required><br><br>

   <label for="is_admin">Prioridade:</label>
    <select name="is_admin" id="is_admin">
        <option value ="1">Admin</option>
        <option value = "0">Usuário</option>
    <select>

    <label for="cep">Cep:</label>
    <input type="text" id="cep" name="cep" required><br><br>

    <label for="place">Endereço:</label>
    <input type="text" id="place" name="place" required><br><br>

    <label for="number">Número:</label>
    <input type="text" id="number" name="number" required><br><br>


    <button type="submit" class="btn-form">Cadastrar</button>
  </form>

@endsection