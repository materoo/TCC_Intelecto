<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('imagens/icone.png') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="imagens/icone.png" type="image/x-icon">
    <!-- <link rel="stylesheet" href="estilo/homepage.css"> -->
    <link rel="stylesheet" href="{{ asset('css/assunto.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/barra_pesquisa.css') }}" type="text/css">
    
    <title>Assunto - Intelecto </title>
<!-- </head>
    <body> -->
    @if(auth()->user()->nivel === 'admin')
       @include('layout._cabecalho_admin')
    @elseif(auth()->user()->nivel === 'usuario')
      @include('layout._cabecalho')
    @elseif(auth()->user()->nivel === 'professor')
      @include('layout._cabecalho_professor')
    @endif          <main> <!-- conteudo principal da homepage -->
            <section class="container_main">
                <div class="main-logo">
                    <img src="{{ asset('imagens/logo_intelecto.svg') }}" alt="Logo Intelecto" id="imgLogo" width="600px">
                </div>
                <div class="main-img">
                    <img src="{{ asset('imagens/assunto.png') }}" alt="image_assunto">
                </div>
            </section>
        </main>

        <!-- //////////////////Barra de pesquisa //////////////////-->
        <form action="{{route('aulas.search.assuntoaula')}}" method="get" enctype='multipart/form-data'>
              <div class="search-bar">
                  <input type="text" name="busca" placeholder="Pesquisar">
                  
                  <select name="filtro" >
                    <option value="" disabled selected>Buscar Por</option>
                    <option value="assunto">Assunto</option>
                    <option value="aula" selected>Aula</option>
                  </select>

                  <button class="first" type="submit">
                      <ion-icon name="search-outline"></ion-icon>
                  </button>

                  <button>
                      <a href="{{ route('aulas.apresentar_assuntos', ['nome_materia' => $nome_materia]) }}"><ion-icon name="close-outline"></ion-icon></a>
                  </button> 

                  <input type="hidden" name="materia" value="{{$nome_materia}}">
              </div>
        </form>

        
        <!-- ////////////Barra de pesquisa///////////////////////-->        

        @php
            $lastAssunto = null;
        @endphp
            @foreach ($rows as $index => $row)
            @if ($index === 0 || $row->fk_materia !== $rows[$index - 1]->fk_materia)
                <h1 class="titulos">{{$row->fk_materia}}</h1>
            @endif



        <!-- <p class="subtitulo">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consectetur dicta similique quod architecto, magni culpa tempora deleniti libero vel saepe. Repellat ut facere tempora eum magni quasi perspiciatis ratione soluta.</p> -->

            <div class="container_download">

            <div class="topic">
            @if ($lastAssunto !== $row->fk_assunto)
                <h2>{{$row->fk_assunto}}</h2>
                @php
                    $lastAssunto = $row->fk_assunto;
                @endphp
            @endif
              @component('components.topic')
                @slot('titulo')
                    {{$row->nome_aula}}
                @endslot
                @slot('arquivo')
                  {{asset($row->nome_arquivo)}}
                @endslot
             @endcomponent
            </div>
            </div>
        @endforeach


</div>
{{ $rows->links('pagination') }}  
    </div>
    @if(auth()->user()->nivel === 'admin')
    @include('layout._rodape_admin')
 @elseif(auth()->user()->nivel === 'usuario')
   @include('layout._rodape')
 @elseif(auth()->user()->nivel === 'professor')
   @include('layout._rodape_professor')
 @endif
