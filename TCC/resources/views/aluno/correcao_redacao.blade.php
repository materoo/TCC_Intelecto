<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intelecto - Redações Corrigidas</title>
    <link rel="stylesheet" href="{{asset('css/style_tabela.css')}}">
    <link rel="stylesheet" href="{{ asset('css/footer.css')}}">
    <link rel="shortcut icon" href="imagens/icone.png" type="image/x-icon">
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
                <img src="{{ asset('imagens/logo_intelecto.svg') }}" alt="Logo Intelecto" id="imgLogo" width="400px">
                <h1>Tabela com suas Redações Corrigidas</h1>
            </center>
        </div>
     
        <center>
            <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Tema</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $row)
                    <tr>
                        <td>{{$row->fk_tema}}</td>
                        <td>
                            <a href="{{asset($row->arquivo_correcao)}}" download class="btn-edit"><ion-icon name="download-outline"></ion-icon></a> 
                        </td>
                    </tr>
                     @endforeach
                </tbody>
            </table>
            </div>
        </center>
    </main>
    
    @if(auth()->user()->nivel === 'admin')
    @include('layout._rodape_admin')
 @elseif(auth()->user()->nivel === 'usuario')
   @include('layout._rodape')
 @elseif(auth()->user()->nivel === 'professor')
   @include('layout._rodape_professor')
 @endif
