{{-- @extends('layout.site') --}}
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intelecto - Redações</title>
    <link rel="stylesheet" href="css/redacao.css">
    <link rel="shortcut icon" href="imagens/icone.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style_pagination.css">

    <!-- <link rel="stylesheet" href="css/card_redacoes.css"> -->
    <link rel="stylesheet" href="css/barra_pesquisa.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


<!-- </head>
    <body> -->
    @if(auth()->user()->nivel === 'admin')
       @include('layout._cabecalho_admin')
    @elseif(auth()->user()->nivel === 'usuario')
      @include('layout._cabecalho')
    @elseif(auth()->user()->nivel === 'professor')
      @include('layout._cabecalho_professor')
    @endif          
    <main>
        <section class="container_main">
            <div class="main-text">
                <img src="{{ asset('imagens/logo_intelecto.svg') }}" alt="Logo Intelecto" id="imgLogo">
                <h2>Redações: </h2>
                
                <p class="p_exercicios">Nesta página, os alunos podem enviar suas redações para correção detalhada por nossa equipe de especialistas, recebendo feedback personalizado para aprimorar suas habilidades de escrita e se preparar melhor para as provas de vestibular.</p>
                    
            </div>
            <div class="main-img">
              <img src="imagens/imagem_redacao.png" alt="Imagem redação">
            </div>
        </section>
    </main>

            <!-- /////////////////////////////////////////////  -->

            <h1 class="titulos">Temas de Redações:</h1>
            <p class="subtitulo">A ampla variedade de temas de redação disponíveis para a prática prepara os alunos para vestibulares e processos seletivos, avaliando sua capacidade de expressão e argumentação, além de incentivá-los a se manterem informados sobre questões sociais, políticas e culturais, tornando-os cidadãos mais conscientes e preparados.</p>

            <!-- /////////////////////////////////////////////  -->

            <form action="{{route('redacaoaluno.search')}}" method="get" enctype='multipart/form-data'>
            <div class="search-bar">
                <input type="text" name="busca" placeholder="Pesquisar">
                <button class="first" type="submit">
                    <ion-icon name="search-outline"></ion-icon>
                </button>

                <button>
                    <a href="{{route('redacao')}}"><ion-icon name="close-outline"></ion-icon></a>
                </button>
            </div>
            </form>

            <!-- /////////////////////////////////////////////  -->

            <div class="container">

            @foreach ($rows as $row)

            <div class="card">
            <a href="{{ route('redacao_aluno.edit', $row->titulo) }}" class="btnRed">
              <img src="{{asset($row->nome_imagem)}}" alt="Imagem" class="teste_imagem">
              <div class="containercard">
                  <center>
                    <h4>{{$row->titulo}}</h4>
                    <p alt="{{$row->texto_imagem}}">{{$row->descricao}}</p>
                  </center>
              </div>
            </a>
            </div>

            @endforeach 

            
            </div>

            
            <center>{{ $rows->links('pagination') }}</center>
            

        </main>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    @if(auth()->user()->nivel === 'admin')
    @include('layout._rodape_admin')
 @elseif(auth()->user()->nivel === 'usuario')
   @include('layout._rodape') 
 @elseif(auth()->user()->nivel === 'professor')
   @include('layout._rodape_professor')
 @endif

