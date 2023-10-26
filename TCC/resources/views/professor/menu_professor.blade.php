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
<!-- </head>
<body> -->
@include('layout._cabecalho_professor')
<div class="mae">

    <center>
        <!-- <div class="menu_center"> -->
            <div class="body">
                <div class="menu">
                    <div style="height: 200px"></div>
                    <h1>Funções de Cadastros:</h1>
                    <div class="bot">
                        <a href="../projetoscti24/cad_materia"><button class="button"><span> Cad Materia </span></button></a>
                        <a href="{{route('admin.cadassuntos')}}"><button class="button"><span> Cad Assunto </span></button></a>
                        <a href="{{route('admin.cadaulas')}}"><button class="button"><span> Cad Aula </span></button></a>
                        <a href="{{route('admin.cadastro_exercicio')}}"><button class="button"><span> Cad Exercicio </span></button></a>
                        <a href="../projetoscti24/cad_redacoes"><button class="button"><span> Cad Redacao</span></button></a>
                        <a href="../projetoscti24/cad_alternativas"><button class="button"><span> Cad Alternativas</span></button></a>
                    </div>
                    <h1>Funções de Listagem:</h1>
                    <div class="bot">
                        <a href="{{route('materia.list')}}"><button class="button"><span> Listar Materias </span></button></a>
                        <a href="{{route('assunto.list')}}"><button class="button"><span> Listar Assuntos </span></button></a>
                        <a href="{{route('aula.list')}}"><button class="button"><span> Listar Aulas </span></button></a>
                        <a href="{{route('exercicio.list')}}"><button class="button"><span> Listar Exercicios </span></button></a>
                        <a href="{{route('redacao.list')}}"><button class="button"><span> Listar Redacoes </span></button></a>
                        <a href="{{route('alternativa.list')}}"><button class="button"><span> Listar Alternativas </span></button></a>
                    </div>
                </div>
            </div>
        <!-- </div> -->
    </center>
</div>
@include('layout._rodape_professor') <!--vitalicio-->
