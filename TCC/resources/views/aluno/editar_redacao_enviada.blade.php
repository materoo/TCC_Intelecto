{{-- @extends('layout.site') --}}
{{-- @extends('layout.site') --}}
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- @yield('titulo')  --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="shortcut icon" href="imagens/icone.png" type="image/x-icon">
</head>
<body>
    
@if(auth()->user()->nivel === 'admin')
       @include('layout._cabecalho_admin')
    @elseif(auth()->user()->nivel === 'usuario')
      @include('layout._cabecalho')
    @elseif(auth()->user()->nivel === 'professor')
      @include('layout._cabecalho_professor')
    @endif
    <div class="mamae">

        <div class="logo">
            <img src="{{!! asset('imagens/logo_intelecto.svg') !!}}" alt="logo_intelecto" class="logo_intelecto" id="imgLogo">
        </div>
    
        <div class="container">

            <div class="text">Editar Redação Enviada:</div>

            @foreach($rows as $row)
            <form action="{{ route('admin.redacao_enviada.update', $row->id_redacao) }}" method="post" enctype='multipart/form-data'>
            @method('PUT')
            @csrf

            <div class="form-row">
            @component('components.card_form')
                @slot('type')
                    text
                @endslot

                @slot('name')
                    fk_tema
                @endslot

                @slot('placeholder')

                @endslot

                @slot('required')
                    required value="{{isset($row->fk_tema) ? $row->fk_tema : ''}}"
                @endslot

                @slot('comando')
                    Tema:
                @endslot
            @endcomponent

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
                    required value="{{isset($row->nome_arquivo) ? $row->nome_arquivo : ''}}"
                @endslot

                @slot('comando')
                   
                @endslot
            @endcomponent

     
            </div>

            <div class="form-row">
            @component('components.card_form')
                @slot('type')
                    hidden
                @endslot

                @slot('name')
                    fk_cpf_aluno
                @endslot

                @slot('placeholder')

                @endslot

                @slot('required')
                    required value="{{isset($row->fk_cpf_aluno) ? $row->fk_cpf_aluno : ''}}"
                @endslot

                @slot('comando')
                  
                @endslot
            @endcomponent
            
            </div>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <div class="inner"></div>
                        <input type="submit" value="Editar">
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
@endforeach
