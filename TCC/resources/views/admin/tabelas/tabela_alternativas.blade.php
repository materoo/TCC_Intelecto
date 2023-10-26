<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intelecto - Tabela</title>
    <link rel="stylesheet" href="css/style_tabela.css">
    <link rel="stylesheet" href="css/barra_pesquisa.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/style_pagination.css">
    <link rel="shortcut icon" href="imagens/lamp.ico" type="image/x-icon">
<!-- </head>

<body> -->
@if(auth()->user()->nivel === 'admin')
       @include('layout._cabecalho_admin')
    @elseif(auth()->user()->nivel === 'usuario')
      @include('layout._cabecalho')
    @elseif(auth()->user()->nivel === 'professor')
      @include('layout._cabecalho_professor')
    @endif      <main>
        <!-- <img src="imagens/menu.png" alt="Menu lateral" height="40px"> -->
        <div class="container">
            <center>
                <img src="imagens/logo_intelecto.svg" alt="Logo Intelecto" width="400px" id="imgLogo">
                <h1>Tabela de Alternativas</h1>
            </center>
        </div>

        <form action="{{route('alternativa.search')}}" method="get" enctype='multipart/form-data'>
            <div class="search-bar">
                <input type="text" name="busca" placeholder="Pesquisar por descricao">
                <button class="first" type="submit">
                    <ion-icon name="search-outline"></ion-icon>
                </button>

                <button>
                    <a href="{{route('alternativa.list')}}"><ion-icon name="close-outline"></ion-icon></a>
                </button>
            </div>
        </form>

        <center>
            <a href="{{route('admin.cadastro_alternativa')}}" class="addBtn">Novo Cadastro</a><br><br><br>
            <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Id Exercício</th>
                        <th>Letra</th>
                        <th>Correta</th>
                        <th>Descricao</th>
                        <th>Imagem</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $row)
                    <tr>
                        <td>{{$row->fk_id_exercicio}}</td>
                        <td>{{$row->letra}}</td>
                        <td>{{ $row->correta ? 'Sim' : 'Não' }}</td>
                        <td>{{$row->descricao_alternativa}}</td>
                        <td>{{$row->imagem_alternativa}}</td>
                        <td>
                                <a href="{{ route('admin.alternativa.edit', $row->id_alternativa) }}" class="btn-edit"><ion-icon name="create-outline"></ion-icon></a>
                                <a href="{{ route('admin.alternativa.excluir', $row->id_alternativa) }}" class="btn-remove"><ion-icon name="trash-outline"></ion-icon></a>
                        </td>
                    </tr>
                     @endforeach

                </tbody>
            </table>
            <div>
            {{ $rows->links('pagination') }} 
        </center>

    </main>
    @if(auth()->user()->nivel === 'admin')
    @include('layout._rodape_admin')
 @elseif(auth()->user()->nivel === 'usuario')
   @include('layout._rodape')
 @elseif(auth()->user()->nivel === 'professor')
   @include('layout._rodape_professor')
 @endif
