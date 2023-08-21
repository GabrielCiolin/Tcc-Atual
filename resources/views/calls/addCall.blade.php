@extends('layout.main')

@section('Title', 'Adicionar um Atendimento')

@section('content')

  <h1 class="title">Cliente: {{}}</h1>

  <form class="form" action="" method="POST">
    @csrf



    <button type="submit" class="btn-form">Cadastrar</button>
  </form>

@endsection