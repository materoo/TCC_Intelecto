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
            <div class="text">Cadastro de Exercícios : </div>

            <form action="{{route('admin.exercicios.salvar')}}" method="post" enctype='multipart/form-data'>
            {{csrf_field() }}

            <div class="form-row">
                @component('components.card_form')
                    @slot('type')
                        number
                    @endslot

                    @slot('name')
                        ano_exercicio
                    @endslot

                    @slot('placeholder')

                    @endslot

                    @slot('required')
                        required value="{{isset($linha->ano_exercicio) ? $linha->ano_exercicio : ''}}"
                    @endslot

                    @slot('comando')
                        Ano:
                    @endslot
                @endcomponent

                @component('components.card_form')
                    @slot('type')
                        text
                    @endslot

                    @slot('name')
                        vestibular
                    @endslot

                    @slot('placeholder')

                    @endslot

                    @slot('required')
                        required value="{{isset($linha->vestibular) ? $linha->vestibular : ''}}"
                    @endslot

                    @slot('comando')
                        Vestibular:
                    @endslot
                @endcomponent
            </div>

            <div class="form-row">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p>Assunto:</p><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <select name="fk_assunto">
                    @foreach ($rows as $row)
                        <option value="{{ $row->nome_assunto }}">{{ $row->nome_assunto }}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-row">
            @component('components.card_form')
                @slot('type')
                    text
                @endslot

                @slot('name')
                    descricao_exercicio
                @endslot

                @slot('placeholder')

                @endslot

                @slot('required')
                    required value="{{isset($linha->descricao_exercicio) ? $linha->descricao_exercicio : ''}}"
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
                imagem_exercicio
            @endslot

            @slot('placeholder')

            @endslot

            @slot('required')
                required value="{{isset($linha->imagem_exercicio) ? $linha->imagem_exercicio : ''}}"
            @endslot

            @slot('comando')

            @endslot
        @endcomponent
            </div>

            <div class="form-row">
            @component('components.card_form')
                @slot('type')
                    number
                @endslot

                @slot('name')
                    id_exercicio
                @endslot

                @slot('placeholder')

                @endslot

                @slot('required')
                    required value="{{isset($linha->id_exercicio) ? $linha->id_exercicio : ''}}"
                @endslot

                @slot('comando')
                    Id:
                @endslot
            @endcomponent
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Último Exercício Cadastrado: {{$maiorIdExercicio}}.</p>
            
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
