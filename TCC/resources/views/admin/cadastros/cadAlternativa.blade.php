
<!DOCTYPE html>
<html lang="pt-br">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- @yield('titulo')  --}}
    <link rel="stylesheet" href="css/app.css" type="text/css">
    <link rel="stylesheet" href="css/footer.css" type="text/css">
    <link rel="shortcut icon" href="imagens/lamp.ico" type="image/x-icon">
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
        <img src="imagens/logo_intelecto.svg" alt="logo_intelecto" class="logo_intelecto" id="imgLogo">
    </div>
        <div class="container">

            @if(auth()->user()->nivel === 'admin')
                <a href="{{route('menu.adm')}}" class="link_voltar"><ion-icon name="arrow-undo-outline"></ion-icon>Voltar</a>
            @elseif(auth()->user()->nivel === 'professor')
                <a href="{{route('menu_professor.adm')}}" class="link_voltar"><ion-icon name="arrow-undo-outline"></ion-icon>Voltar</a>
            @endif
            <div class="text">Cadastro de Alternativas</div>


            <form action="{{route('admin.alternativas.salvar')}}" method="post" enctype='multipart/form-data'>
                {{csrf_field() }}
            <div class="form-row">
            @component('components.card_form')
                @slot('type')
                    text
                @endslot

                @slot('name')
                    letra
                @endslot

                @slot('placeholder')

                @endslot

                @slot('required')
                    required  value="{{isset($linha->letra) ? $linha->letra : ''}}"
                @endslot

                @slot('comando')
                    Letra:
                @endslot
            @endcomponent

            @component('components.select_form')

                @slot('comando')
                    
                @endslot

                @slot('name')
                    correta
                @endslot

                @slot('required')
                   required value="{{isset($linha->correta) ? $linha->correta : ''}}"
                @endslot
  
            @endcomponent
            </div>

            <div class="form-row">
                @component('components.card_form')
                @slot('type')
                    text
                @endslot

                @slot('name')
                    descricao_alternativa
                @endslot

                @slot('placeholder')

                @endslot

                @slot('required')
                    required  value="{{isset($linha->descricao_alternativa) ? $linha->descricao_alternativa : ''}}"
                @endslot

                @slot('comando')
                    Descrição e Imagem:
                @endslot
            @endcomponent
            @component('components.card_form')
            @slot('type')
                file
            @endslot

            @slot('name')
                imagem_alternativa
            @endslot

            @slot('placeholder')

            @endslot

            @slot('required')
                required value="{{isset($linha->imagem_alternativa) ? $linha->imagem_alternativa : ''}}"
            @endslot

            @slot('comando')

            @endslot
            @endcomponent
            </div>
            <div class="form-row">


            &nbsp;&nbsp;&nbsp;&nbsp;<p>ID exercício: </p><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <select name="fk_id_exercicio">
                @foreach ($exercicios as $ex)
                    <option value="{{ $ex->id_exercicio }}">{{ $ex->id_exercicio }} </option>
                @endforeach
            </select>
                <!-- @component('components.card_form')
                @slot('type')
                    number
                @endslot

                @slot('name')
                    fk_id_exercicio
                @endslot

                @slot('placeholder')

                @endslot

                @slot('required')
                    required  value="{{isset($linha->fk_id_exercicio) ? $linha->fk_id_exercicio : ''}}"
                @endslot

                @slot('comando')
                    Id do Exercício:
                @endslot
                @endcomponent -->


            </div>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <div class="inner"></div>
                        <input type="submit" value="Cadastrar">
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

    </form>

    @if(auth()->user()->nivel === 'admin')
    @include('layout._rodape_admin')
 @elseif(auth()->user()->nivel === 'usuario')
   @include('layout._rodape')
 @elseif(auth()->user()->nivel === 'professor')
   @include('layout._rodape_professor')
 @endif 
