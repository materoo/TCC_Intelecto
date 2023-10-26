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
            <h1>Funções de Cadastros</h1>
            <div class="bot">

                <a href="../projetoscti24/cad_aluno"><button class="button"><span> Cad Aluno </span></button></a>
                <a href="../projetoscti24/cad_professores"><button class="button"><span> Cad Professor </span></button></a>
                <a href="../projetoscti24/cad_materia"><button class="button"><span> Cad Materia </span></button></a>
                <a href="{{route('admin.cadassuntos')}}"><button class="button"><span> Cad Assunto </span></button></a>
                <a href="{{route('admin.cadaulas')}}"><button class="button"><span> Cad Aula </span></button></a>
                <a href="{{route('admin.cadastro_exercicio')}}"><button class="button"><span> Cad Exercicio </span></button></a>
                <a href="../projetoscti24/cad_redacoes"><button class="button"><span> Cad Redacao</span></button></a>
                <a href="../projetoscti24/cad_alternativas"><button class="button"><span> Cad Alternativas</span></button></a>
            </div>
            <br><br><br>
            <h1>Funções de Listagem</h1>
            <div class="bot">
                <a href="{{route('aluno.list')}}"><button class="button"><span> Listar Alunos </span></button></a>
                <a href="{{route('professor.list')}}"><button class="button"><span> Listar Professores </span></button></a>
                <a href="{{route('materia.list')}}"><button class="button"><span> Listar Materias </span></button></a>
                <a href="{{route('assunto.list')}}"><button class="button"><span> Listar Assuntos </span></button></a>
                <a href="{{route('aula.list')}}"><button class="button"><span> Listar Aulas </span></button></a>
                <a href="{{route('exercicio.list')}}"><button class="button"><span> Listar Exercicios </span></button></a>
                <a href="{{route('redacao.list')}}"><button class="button"><span> Listar Redacoes </span></button></a>
                <a href="{{route('redacao.list_aluno')}}"><button class="button"><span> Listar Redac Aluno </span></button></a>
                <a href="{{route('alternativa.list')}}"><button class="button"><span> Listar Alternativas </span></button></a>
                <a href="{{route('redacao_corrigida.list')}}"><button class="button"><span> Listar Redacoes Co </span></button></a>
                <!-- <a href="{{route('redacao_corrigida.list')}}"><button class="button"><span> Listar Redacoes Co </span></button></a> -->

            </div>
        </center>
        </div>
    </div>
</div>
@if(auth()->user()->nivel === 'admin')
@include('layout._rodape_admin')
@elseif(auth()->user()->nivel === 'usuario')
@include('layout._rodape')
@elseif(auth()->user()->nivel === 'professor')
@include('layout._rodape_professor')
@endif<!--provisorio-->
