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
                <h1>Tabela de Redações Corrigidas</h1>
            </center>
        </div>

        <form action="{{route('redacaocorrigida.search')}}" method="get" enctype='multipart/form-data'>
            <div class="search-bar">
                <input type="text" name="busca" placeholder="Pesquisar por tema">
                <button class="first" type="submit">
                    <ion-icon name="search-outline"></ion-icon>
                </button>

                <button>
                    <a href="{{route('redacao_corrigida.list')}}"><ion-icon name="close-outline"></ion-icon></a>
                </button>
            </div>
        </form>

        <center>
            <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Tema</th>
                        <th>Aluno</th>
                        <th>E-mail do Aluno</th>
                        <th>arquivo de correcao</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody></tbody>
                    @foreach($rows as $row)
                    <tr>
                        <td>{{$row->fk_tema}}</td>
                        <td>{{$row->aluno->nome_aluno}}</td>
                        <td>{{$row->aluno->email_aluno}}</td>
                        <td>{{$row->arquivo_correcao}}</td>
                        <td>
                            <a href="{{asset($row->arquivo_correcao)}}" download class="btn-edit"><ion-icon name="download-outline"></ion-icon></a>
                            <a href="{{ route('admin.redacao_corrigida.edit', $row->id_redacao_corrigida) }}" class="btn-edit"><ion-icon name="create-outline"></ion-icon></a>
                            <a href="{{ route('admin.redacao_corrigida.excluir', $row->id_redacao_corrigida) }}" class="btn-remove"><ion-icon name="trash-outline"></ion-icon></a>
                        </td>
                    </tr>
                     @endforeach
                </tbody>
            </table>
            </div>
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
