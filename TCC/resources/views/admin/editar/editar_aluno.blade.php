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

            <a href="{{route('menu.adm')}}" class="link_voltar"><ion-icon name="arrow-undo-outline"></ion-icon>Voltar</a>
            <div class="text">Editar Alunos</div>

            @foreach($rows as $row)
            <form action="{{ route('admin.aluno.update', ['email_aluno' => $row->email_aluno, 'cpf_aluno' => $row->cpf_aluno]) }}" method="post" enctype='multipart/form-data'>
            @method('PUT')
            @csrf

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
                    required value="{{isset($row->nome_aluno) ? $row->nome_aluno : ''}}"
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
                    value="{{isset($row->imagem_aluno) ? $row->imagem_aluno : ''}}"
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
                    required value="{{isset($row->rg_aluno) ? $row->rg_aluno : ''}}"
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

        @endslot

        @slot('required')
            required value="{{isset($row->cpf_aluno) ? $row->cpf_aluno : ''}}"
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
            required value="{{isset($row->email_aluno) ? $row->email_aluno : ''}}"
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
            required  value="{{isset($row->celular_aluno) ? $row->celular_aluno : ''}}"
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
                        value="{{isset($row->escola_aluno) ? $row->escola_aluno : ''}}"
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
                    value="{{isset($row->serie_aluno) ? $row->serie_aluno : ''}}"
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
                        required required value="{{isset($row->senha_aluno) ? $row->senha_aluno : ''}}"
                    @endslot

                    @slot('comando')
                        Senha:
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
    </script>


    @if(auth()->user()->nivel === 'admin')
    @include('layout._rodape_admin')
 @elseif(auth()->user()->nivel === 'usuario')
   @include('layout._rodape')
 @elseif(auth()->user()->nivel === 'professor')
   @include('layout._rodape_professor')
 @endif
@endforeach
