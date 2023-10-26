<!DOCTYPE html>
<html lang="pt-br">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
{{-- @yield('titulo')  --}}
<link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('css/footer.css') }}" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
@if(auth()->user()->nivel === 'admin')
       @include('layout._cabecalho_admin')
    @elseif(auth()->user()->nivel === 'usuario')
      @include('layout._cabecalho')
    @elseif(auth()->user()->nivel === 'professor')
      @include('layout._cabecalho_professor')
    @endif
    <div class="mamae">
    <div class="logo">
        <img src="{{ asset ('imagens/logo_intelecto.svg')}}" alt="logo_intelecto" class="logo_intelecto" id="imgLogo">
    </div>
        <div class="container">
            @if(auth()->user()->nivel === 'admin')
                <a href="{{route('menu.adm')}}" class="link_voltar"><ion-icon name="arrow-undo-outline"></ion-icon>Voltar</a>
            @elseif(auth()->user()->nivel === 'professor')
                <a href="{{route('menu_professor.adm')}}" class="link_voltar"><ion-icon name="arrow-undo-outline"></ion-icon>Voltar</a>
            @endif
            <div class="text">Editar Redação:</div>

            @foreach($rows as $row)
            <form action="{{ route('admin.redacao_corrigida.update', $row->id_redacao_corrigida) }}" method="post" enctype='multipart/form-data'>
            @method('PUT')
            @csrf
            @component('components.card_form')
                @slot('type')
                    hidden
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
              
                @endslot
            @endcomponent

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
        

            <div class="form-row">
            @component('components.card_form')
                @slot('type')
                    file
                @endslot

                @slot('name')
                    arquivo_correcao
                @endslot

                @slot('placeholder')

                @endslot

                @slot('required')
                    required value="{{isset($row->arquivo_correcao) ? $row->arquivo_correcao : ''}}"
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
