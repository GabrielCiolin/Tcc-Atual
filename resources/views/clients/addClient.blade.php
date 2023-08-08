@extends('layout.main')

@section('Title', 'Adicionar um Cliente')

@section('content')

  <h1 class="title">Cadastre um Cliente</h1>

  <form class="form" action="/client" method="POST">
    @csrf
    <label for="name">Nome:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="rg">RG:</label>
    <input type="text" id="rg" name="rg" required><br><br>

    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" required><br><br>

    <label for="contact">Contato:</label>
    <input type="text" id="contact" name="contact" required><br><br>
    
    <label for="cep">Cep:</label>
    <input type="text" id="cep" name="cep" required><br><br>

    <label for="place">Endereço:</label>
    <input type="text" id="place" name="place" required><br><br>

    <label for="number">Número:</label>
    <input type="text" id="number" name="number" required><br><br>


    <button type="submit" class="btn-form">Cadastrar</button>
  </form>

@endsection