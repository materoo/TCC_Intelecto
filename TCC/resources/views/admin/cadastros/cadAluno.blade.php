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
            
        <a href="{{route('menu.adm')}}" class="link_voltar"><ion-icon name="arrow-undo-outline"></ion-icon>Voltar</a>
            
            <div class="text">Cadastro de Aluno</div>


            <form action="{{route('admin.alunos.salvar')}}" method="post" enctype='multipart/form-data'>
                {{csrf_field() }}

            <div class="form-row">
                @component('components.card_form')
                @slot('type')
                    text
                @endslot

                @slot('name')
                    nome_aluno
                @endslot

                @slot('placeholder')

                @endslot

                @slot('required')
                    required value="{{isset($linha->nome_aluno) ? $linha->nome_aluno : ''}}"
                @endslot

                @slot('comando')
                    Nome e Imagem:
                @endslot
            @endcomponent

            @component('components.card_form')
                @slot('type')
                    file
                @endslot

                @slot('name')
                    imagem_aluno
                @endslot

                @slot('placeholder')

                @endslot

                @slot('required')
                    required value="{{isset($linha->imagem_aluno) ? $linha->imagem_aluno : ''}}"
                @endslot

                @slot('comando')

                @endslot
            @endcomponent
            </div>

            <div class="form-row">
                @component('components.card_form')
                @slot('type')
                    text
                @endslot

                @slot('name')
                    rg_aluno
                @endslot

                @slot('placeholder')

                @endslot

                @slot('required')
                    required value="{{isset($linha->rg_aluno) ? $linha->rg_aluno : ''}}"
                @endslot

                @slot('comando')
                    RG:
                @endslot
            @endcomponent



        @component('components.card_form')
        @slot('type')
            text
        @endslot

        @slot('name')
            cpf_aluno
        @endslot

        @slot('placeholder')
            {{-- xxx.xxx.xxx-xx --}}
        @endslot

        @slot('required')
            required value="{{isset($linha->cpf_aluno) ? $linha->cpf_aluno : ''}}"
        @endslot

        @slot('comando')
            CPF:
        @endslot
    @endcomponent
            </div>

            <div class="form-row">
                @component('components.card_form')
        @slot('type')
            email
        @endslot

        @slot('name')
            email_aluno
        @endslot

        @slot('placeholder')

        @endslot

        @slot('required')
            required value="{{isset($linha->email_aluno) ? $linha->email_aluno : ''}}"
        @endslot

        @slot('comando')
            E-mail:
        @endslot
    @endcomponent

    @component('components.card_form')
        @slot('type')
            text
        @endslot

        @slot('name')
            celular_aluno
        @endslot

        @slot('placeholder')

        @endslot

        @slot('required')
            required  value="{{isset($linha->celular_aluno) ? $linha->celular_aluno : ''}}"
        @endslot

        @slot('comando')
            Celular:
        @endslot
    @endcomponent
            </div>

            <div class="form-row">
                @component('components.card_form')
                @slot('type')
                    text
                @endslot

                @slot('name')
                    escola_aluno
                @endslot

                @slot('placeholder')

                @endslot

                @slot('required')
                    required value="{{isset($linha->escola_aluno) ? $linha->escola_aluno : ''}}"
                @endslot

                @slot('comando')
                    Escola:
                @endslot
            @endcomponent

            @component('components.card_form')
                @slot('type')
                    text
                @endslot

                @slot('name')
                    serie_aluno
                @endslot

                @slot('placeholder')

                @endslot

                @slot('required')
                    required value="{{isset($linha->serie_aluno) ? $linha->serie_aluno : ''}}"
                @endslot

                @slot('comando')
                    Série:
                @endslot
            @endcomponent
            </div>

            <div class="form-row">

            @component('components.card_form')
                @slot('type')
                    password
                @endslot

                @slot('name')
                    senha_aluno
                @endslot

                @slot('placeholder')

                @endslot

                @slot('required')
                    required required value="{{isset($linha->senha_aluno) ? $linha->senha_aluno : ''}}"
                @endslot

                @slot('comando')
                    Senha:
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
 <!-- é o valor q ta no name q é o id -->
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
        const phoneInput = document.getElementById('celular_aluno');
        phoneInput.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                value = '(' + value;
                if (value.length > 3) {
                    value = [value.slice(0, 3), ') ', value.slice(3)].join('');
                }
                if (value.length > 10) {
                    value = [value.slice(0, 10), '-', value.slice(10)].join('');
                }
                if (value.length > 15) {
                    value = value.slice(0, 15);
                }
            }
            e.target.value = value;
        });
        });
        window.addEventListener('DOMContentLoaded', (event) => {
        const cpfInput = document.getElementById('cpf_aluno');
        const form = document.getElementById('cpf_aluno'); // Substitua 'seu-form-id' pelo ID do seu formulário

            cpfInput.addEventListener('input', (e) => {
                let value = e.target.value.replace(/\D/g, ''); // Remove caracteres não numéricos

                if (value.length > 0) {
                    value = value.replace(/^(\d{3})(\d)/, '$1.$2');
                    value = value.replace(/^(\d{3})\.(\d{3})(\d)/, '$1.$2.$3');
                    value = value.replace(/\.(\d{3})(\d)/, '.$1-$2');

                    if (value.length > 14) {
                        value = value.slice(0, 14);
                    }
                }

                e.target.value = value;
            });

            form.addEventListener('submit', (e) => {
                const cpfValue = cpfInput.value.replace(/\D/g, ''); // Remove caracteres não numéricos

                if (cpfValue.length !== 11) { // Verifica se o CPF tem 11 dígitos
                    e.preventDefault(); // Impede o envio do formulário se o formato estiver incorreto
                    alert('Preencha o CPF no formato correto: xxx.xxx.xxx-xx');
                }
            });
        });
        window.addEventListener('DOMContentLoaded', (event) => {
            const rgInput = document.getElementById('rg_aluno');
            const form = document.getElementById('meu-formulario');

            rgInput.addEventListener('input', (e) => {
                let value = e.target.value.replace(/\D/g, ''); // Remove caracteres não numéricos

                if (value.length > 0) {
                    // value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d{1})$/, '$1.$2.$3-$4');
                    value = value.replace(/^(\d{2})(\d)/, '$1.$2');
                    value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
                    value = value.replace(/\.(\d{3})(\d)/, '.$1-$2');

                    if (value.length > 12) {
                        value = value.slice(0, 12);
                    }
                }

                e.target.value = value;
            });

            form.addEventListener('submit', (e) => {
                const rgValue = rgInput.value.replace(/\D/g, ''); // Remove caracteres não numéricos

                if (rgValue.length !== 9) { // Verifica se o RG tem 9 dígitos
                    e.preventDefault(); // Impede o envio do formulário se o formato estiver incorreto
                    alert('Preencha o RG no formato correto: xx.xxx.xxx-x');
                }
            });
        });

        /* ///////////////// Imagem padronizada //////// */
        document.getElementById("imageUploadForm").addEventListener("submit", function(event) {
            const imageInput = document.getElementById("imagem_aluno");
            const imageError = document.getElementById("imagem_aluno");
            const minSize = 300;
            const maxSize = 1200;

            if (imageInput.files.length > 0) {
                const file = imageInput.files[0];
                const image = new Image();

                image.onload = function() {
                    if (image.width >= minSize && image.height >= minSize && image.width <= maxSize && image.height <= maxSize && image.width === image.height) {
                        // A imagem é quadrada e está dentro do intervalo de tamanhos permitidos
                        imageError.textContent = "";
                    } else {
                        imageError.textContent = "A imagem deve ser quadrada e estar dentro do intervalo de tamanhos permitidos (entre 300px x 300px e 600px x 600px).";
                        event.preventDefault(); // Impede o envio do formulário
                    }
                };

                image.src = URL.createObjectURL(file);
            }
        });

    </script>

@if(auth()->user()->nivel === 'admin')
@include('layout._rodape_admin')
@elseif(auth()->user()->nivel === 'usuario')
@include('layout._rodape')
@elseif(auth()->user()->nivel === 'professor')
@include('layout._rodape_professor')
@endif
