<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}" type="text/css">
        <title>Enviar Redações</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">
        <!-- <link rel="stylesheet" href="{{asset ('css/redacao.css')}}" type="text/css"> -->
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('imagens/icone.png') }}" type="image/x-icon">
<!-- </head>
<body> -->
@if(auth()->user()->nivel === 'admin')
       @include('layout._cabecalho_admin')
    @elseif(auth()->user()->nivel === 'usuario')
      @include('layout._cabecalho')
    @elseif(auth()->user()->nivel === 'professor')
      @include('layout._cabecalho_professor')
    @endif      
    
    <div class="mamae">
    
        <div class="logo">
            <img src="{{ asset('imagens/logo_intelecto.svg') }}" alt="logo_intelecto" class="logo_intelecto" id="imgLogo">
        </div>
        
        <div class="container">

        <a href="{{route('menu.adm')}}" class="link_voltar"><ion-icon name="arrow-undo-outline"></ion-icon>Voltar</a>
        <div class="text">Enviar sua redação :</div>
        <center>
            <p class="p_redacao">Envie sua proposta de redação para ser corrigida!</p>
        </center>

        <form action="{{route('redacao_aluno.update')}}" method="post" enctype='multipart/form-data'>
            {{csrf_field() }}
            <input type ="hidden" value="{{auth()->user()->cpf}}" name="fk_cpf_aluno">
            <input type="hidden" value = "{{$titulo}}" name="fk_tema">
                
                
                <div class="form-row">
                    @component('components.card_form')
                        @slot('type')
                            file
                        @endslot

                        @slot('name')
                            nome_arquivo
                        @endslot

                        @slot('placeholder')

                        @endslot

                        @slot('required')
                            required
                        @endslot

                        @slot('comando')

                        @endslot
                    @endcomponent
                </div>

                <div class="form-row submit-btn">
                    <div class="input-data">
                        <div class="inner"></div>
                        <input type="submit" value="Cadastrar">
                    </div>
                </div>
        </form>
        </div>

    </div>

    @if(auth()->user()->nivel === 'admin')
    @include('layout._rodape_admin')
 @elseif(auth()->user()->nivel === 'usuario')
   @include('layout._rodape')
 @elseif(auth()->user()->nivel === 'professor')
   @include('layout._rodape_professor')
 @endif
