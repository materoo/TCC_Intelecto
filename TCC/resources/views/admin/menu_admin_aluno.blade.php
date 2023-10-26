{{-- @extends('layout.site') --}}
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('titulo')
    <link rel="stylesheet" href="{{ asset('css/app.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/footer.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/btn.css')}}" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="shortcut icon" href="imagens/lamp.ico" type="image/x-icon">
    <!-- <link rel="stylesheet" href="css/redacao.css"> -->
<!-- </head>
<body> -->
@if(auth()->user()->nivel === 'admin')
       @include('layout._cabecalho_admin')
    @elseif(auth()->user()->nivel === 'usuario')
      @include('layout._cabecalho')
    @elseif(auth()->user()->nivel === 'professor')
      @include('layout._cabecalho_professor')
    @endif  <div class="mae">
    <div class="body"> <!--provisorio-->
    <div class="logo">
        <img src="imagens/logo_intelecto.svg" alt="logo_intelecto" class="logo_intelecto" id="imgLogo">
    </div>
        <div class="menu">
        <center>
                <h1>Telas de Alunos</h1>
                <div class="bot">
                    <a href="{{route('redacao')}}"><button class="button"><span>Redações</span></button></a>
                    <a href="{{route('aluno_listar_exercicio')}}"><button class="button"><span>Exercícios</span></button></a>
                </div>
                <div class="bot">
                     <a href="{{route('materiais')}}"><button class="button"><span>Matérias</span></button></a>
                     <a href="{{ route('listar.redacoes_corrigidas', ['cpf' => auth()->user()->cpf]) }}"><button class="button"><span>Redações Corrig.</span></button></a>
                </div>
            </div>
        </center>




    </div>
</div>
@if(auth()->user()->nivel === 'admin')
@include('layout._rodape_admin')
@elseif(auth()->user()->nivel === 'usuario')
@include('layout._rodape')
@elseif(auth()->user()->nivel === 'professor')
@include('layout._rodape_professor')
@endif <!--provisorio-->
