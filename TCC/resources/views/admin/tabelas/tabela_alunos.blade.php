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
                <h1>Tabela de Alunos</h1>
            </center>
        </div>
        <form action="{{route('aluno.search')}}" method="get" enctype='multipart/form-data'>
            <div class="search-bar">
                <input type="text" name="busca" placeholder="Pesquisar por nome">
                <button class="first" type="submit">
                    <ion-icon name="search-outline"></ion-icon>
                </button>

                <button>
                    <a href="{{route('aluno.list')}}"><ion-icon name="close-outline"></ion-icon></a>
                </button>
            </div>
        </form>
        <center>
            <a href="{{route('admin.cadastro_aluno')}}" class="addBtn">Novo Cadastro</a><br><br><br>
            <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>RG</th>
                        <th>CPF</th>
                        <th>E-mail</th>
                        <th>Celular</th>
                        <th>Escola</th>
                        <th>Série</th>

                        <th>Imagem</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $row)
                    <tr>
                        <td>{{$row->nome_aluno}}</td>
                        <td>{{$row->rg_aluno}}</td>
                        <td>{{$row->cpf_aluno}}</td>
                        <td>{{$row->email_aluno}}</td>
                        <td>{{$row->celular_aluno}}</td>
                        <td>{{$row->escola_aluno}}</td>
                        <td>{{$row->serie_aluno}}</td>
                        <td>{{$row->imagem_aluno}}</td>
                        <td class="btns">
                            <a href="{{ route('admin.aluno.edit', ['email_aluno' => $row->email_aluno, 'cpf_aluno' => $row->cpf_aluno]) }}" class="btn-edit"><ion-icon name="create-outline"></ion-icon></a>
                            <a href="{{ route('admin.aluno.excluir',['email_aluno' => $row->email_aluno, 'cpf_aluno' => $row->cpf_aluno])}}" class="btn-remove"><ion-icon name="trash-outline"></ion-icon></a>
                        </td>
                    </tr>
                    @endforeach

                    @if(session()->has('success'))
                        {{ session()->get('success')}}
                    @else
                    @error('error')
                        {{session()->get('error')}}
                    @enderror
                    @endif



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
