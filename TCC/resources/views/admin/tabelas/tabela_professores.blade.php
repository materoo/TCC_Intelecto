<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intelecto - Tabela</title>
    <link rel="stylesheet" href="css/style_tabela.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/barra_pesquisa.css">
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
                <h1>Tabela de Professores</h1>
            </center>
        </div>
        <form action="{{route('professor.search')}}" method="get" enctype='multipart/form-data'>
            <div class="search-bar">
                <input type="text" name="busca" placeholder="Pesquisar por nome">
                <button class="first" type="submit">
                    <ion-icon name="search-outline"></ion-icon>
                </button>

                <button>
                    <a href="{{route('professor.list')}}"><ion-icon name="close-outline"></ion-icon></a>
                </button>
            </div>
        </form>
        <center>
        <a href="{{route('admin.cadastro_professor')}}" class="addBtn">Novo Cadastro</a><br><br><br>
            <!-- <table class="styled-table"> -->
            <div class="table-container">
            <table>
                <!-- <thead>
                    <tr>
                        <th>Nome</th>
                        <th>RG</th>
                        <th>CPF</th>
                        <th>E-mail</th>
                        <th>Celular</th>
                        {{-- <th>Matéria</th> --}}
                        <th>Descricao</th>
                        <th>Imagem</th>
                        <th></th>
                    </tr>
                </thead> -->
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>RG</th>
                    <th>CPF</th>
                    <th>E-mail</th>
                    <th>Celular</th>
                    <th>Descricao</th>
                    <th>Imagem</th>
                    <th>Acoes</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $row)
                    <tr>
                        <td>{{$row->nome_professor}}</td>
                        <td>{{$row->rg_professor}}</td>
                        <td>{{$row->cpf_professor}}</td>
                        <td>{{$row->email_professor}}</td>
                        <td>{{$row->celular_professor}}</td>
                        {{-- <td>{{$row->fk_materia}}</td> --}}
                        <td>{{$row->descricao_professor}}</td>
                        <td>{{$row->imagem_professor}}</td>
                        <!-- <td class="btns">
                            <a href="{{ route('admin.professor.edit', ['email_professor' => $row->email_professor, 'cpf_professor' => $row->cpf_professor]) }}" class="btn-edit"><ion-icon name="create-outline"></ion-icon></a>
                            <a href="{{ route('admin.professor.excluir',['email_professor' => $row->email_professor, 'cpf_professor' => $row->cpf_professor])}}" class="btn-remove"><ion-icon name="trash-outline"></ion-icon></a>
                        </td> -->
                        <td>
                            <a href="{{ route('admin.professor.edit', ['email_professor' => $row->email_professor, 'cpf_professor' => $row->cpf_professor]) }}" class="btn-edit"><ion-icon name="create-outline"></ion-icon></a>
                            <a href="{{ route('admin.professor.excluir',['email_professor' => $row->email_professor, 'cpf_professor' => $row->cpf_professor])}}" class="btn-remove"><ion-icon name="trash-outline"></ion-icon></a>
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
