<!DOCTYPE html>
<html lang="pt-br">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
{{-- @yield('titulo')  --}}
<link rel="stylesheet" href="css/app.css" type="text/css">
<link rel="stylesheet" href="css/footer.css" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link rel="shortcut icon" href="imagens/lamp.ico" type="image/x-icon">
@if(auth()->user()->nivel === 'admin')
       @include('layout._cabecalho_admin')
    @elseif(auth()->user()->nivel === 'usuario')
      @include('layout._cabecalho')
    @elseif(auth()->user()->nivel === 'professor')
      @include('layout._cabecalho_professor')
    @endif
    <div class="mamae">
    <div class="logo">
        <img src="imagens/logo_intelecto.svg" alt="logo_intelecto" class="logo_intelecto" id="imgLogo">
    </div>
        <div class="container">

            @if(auth()->user()->nivel === 'admin')
                <a href="{{route('menu.adm')}}" class="link_voltar"><ion-icon name="arrow-undo-outline"></ion-icon>Voltar</a>
            @elseif(auth()->user()->nivel === 'professor')
                <a href="{{route('menu_professor.adm')}}" class="link_voltar"><ion-icon name="arrow-undo-outline"></ion-icon>Voltar</a>
            @endif            
                <div class="text">Cadastro de Matéria</div>


            <form action="{{route('admin.materias.salvar')}}" method="post" enctype='multipart/form-data'>
            {{csrf_field() }}

            <div class="form-row">
            @component('components.card_form')
                @slot('type')
                    text
                @endslot

                @slot('name')
                    nome_materia
                @endslot

                @slot('placeholder')

                @endslot

                @slot('required')
                required value="{{isset($linha->nome_materia) ? $linha->nome_materia : ''}}"

                @endslot

                @slot('comando')
                    Materia:
                @endslot
            @endcomponent

             <!-- @component('components.card_form')
                @slot('type')
                    text
                @endslot

                @slot('name')

                @endslot

                @slot('placeholder')

                @endslot

                @slot('required')
                    style="display:none"
                @endslot

                @slot('comando')

                @endslot
            @endcomponent -->
            <!-- </div>

            <div class="form-row">

            </div>

            <div class="form-row">

            </div>

            <div class="form-row">

            </div>

            <div class="form-row"> -->

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
