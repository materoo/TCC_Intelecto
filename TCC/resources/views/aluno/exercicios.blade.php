{{-- @extends('layout.site') --}}
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intelecto - Exercícios</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_exercicios.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/barra_pesquisa.css') }}">
    <link rel="shortcut icon" href="imagens/lamp.ico" type="image/x-icon">
    <!-- </head>

<body> -->
    @if (auth()->user()->nivel === 'admin')
        @include('layout._cabecalho_admin')
    @elseif(auth()->user()->nivel === 'usuario')
        @include('layout._cabecalho')
    @elseif(auth()->user()->nivel === 'professor')
        @include('layout._cabecalho_professor')
    @endif
    <script>
        window.onload = function() {
            sessionStorage.clear(); // Limpa todas as mensagens armazenadas na sessão
        };
    </script>

    <main> <!-- conteudo principal da homepage -->
        {{-- <a name="exercicio1"></a> --}}
        <section class="container_main">
            <div class="main-text">
                <img src="{{ asset('imagens/logo_intelecto.svg') }}" alt="Logo Intelecto" id="imgLogo">
                <h2>Exercícios e listas: </h2>
                
                <p class="p_exercicios">Realizar exercícios para fixar conteúdo e se preparar para provas e processos seletivos é essencial, pois fortalece a memória, identifica lacunas no aprendizado, desenvolve habilidades de raciocínio lógico e prepara melhor os estudantes para lidar com desafios e pressão, contribuindo    significativamente para o sucesso acadêmico e profissional.</p>
                    
                <a href="#exercicio_atual" class="btn_ultimo_exerc">Ir para o último exercicio respondido</a>
            </div>
            <div class="main-img">
                <img src="{{ asset('imagens/mlk.png') }}" alt="imagem_homepage">
            </div>
        </section>
    </main>

    <!-- ///////////////////////////////////////// -->
    <form action="{{ route('exercicio.search_aluno') }}" method="get" enctype='multipart/form-data'>
        <div class="barra_pesquisa">

            <!-- <span>Questões</span> -->

            <select name="Materia" id="select1" class="select">
                <option value="todos">Selecionar Matéria:</option>
                <!-- <option value="" disabled selected>Matéria</option> -->
                @foreach ($materias as $mat)
                    <option value="{{ $mat->nome_materia }}">{{ $mat->nome_materia }}</option>
                @endforeach
            </select>

            <select name="Assunto" id="select3" class="select">
                <option value="todos">Selecionar Assunto:</option>
                <!-- <option value="" disabled selected>Assunto</option> -->
                @foreach ($assuntos as $assunto)
                    <option value="{{ $assunto->nome_assunto }}">{{ $assunto->nome_assunto }}</option>
                @endforeach
            </select>

            <?php
            //Não permite que o campo vestibular se repita no select
            $rowsArray = $exs->toArray();
            $vestibulares = array_column($rowsArray, 'vestibular');
            $uniqueVestibulares = array_unique($vestibulares);
            
            //Não permite que o campo ano se repita no select
            $ano = array_column($rowsArray, 'ano_exercicio');
            $uniqueAno = array_unique($ano);
            ?>

            <select name="Vestibular" id="select4" class="select">
                <option value="todos">Selecionar Vestibular:</option>
                <!-- <option value="" disabled selected>Vestibular</option> -->
                <?php foreach ($uniqueVestibulares as $vestibular): ?>
                <option value="<?= $vestibular ?>"><?= $vestibular ?></option>
                <?php endforeach; ?>
            </select>

            <select name="Ano" id="select5" class="select">
                <!-- <option value="" disabled selected>Ano</option> -->
                <option value="todos">Selecionar Ano:</option>
                <?php foreach ($uniqueAno as $ano): ?>
                <option value="<?= $ano ?>"><?= $ano ?></option>
                <?php endforeach; ?>
            </select>

            <button class="btn_pesquisa_exercicios" type="submit">
                <ion-icon name="search-outline"></ion-icon>
            </button>

            <button class="btn_pesquisa_exercicios">
                <a href="{{ route('aluno_listar_exercicio') }}"><ion-icon name="close-outline"></ion-icon></a>
            </button>

        </div>
    </form>

    <section class="cards">


        <center>
        @foreach ($rows as $row)
            @if (count($row->alternativas) > 0)
            <div class="card">
                    <!-- <div class="card-top">
                        {{ $row->vestibular }}, {{ $row->ano_exercicio }}, {{ $row->fk_assunto }},
                        {{ $row->fk_materia }}
                    </div> -->

                    <div class="header"> 
                        <p>Ano da Questão: {{ $row->ano_exercicio }} </p> 
                        <p>Banca: {{ $row->vestibular }}</p>
                        <p>Matéria: {{ $row->fk_materia }}</p>
                        <p>Assunto: {{ $row->fk_assunto }}</p>
                    </div>

                    <div class="enunciado">
                        <p>{{ $row->descricao_exercicio }}</p>
                        
                        @if ($row->imagem_exercicio)
                            <img src="{{ asset($row->imagem_exercicio) }}" alt="imagem_homepage"
                                width="35%">
                                <!-- <img src="" alt="Descrição da imagem"> -->
                        @endif
                             
                    </div>
                    
                    <!-- <div class="imagem_exercicio">
                <img src="intelecto.jpg" alt="Imagem da questão"> -->
            

                <form class="alternativas" id="quizForm" action="{{ route('salvar_resposta_aluno') }}" method="post"
                            enctype='multipart/form-data'> 

                     

                <!-- <a href="#exercicio1">Ir para o Exercício 1</a> -->


                
                    <!-- <div class="card-body"> -->
                        <!-- <h1>{{ $row->descricao_exercicio }} </h1>
                        <br> -->
                        <!-- <form id="quizForm" action="{{ route('salvar_resposta_aluno') }}" method="post"
                            enctype='multipart/form-data'> -->
                            {{ csrf_field() }}
                            <input type="hidden" name="fk_id_exercicio" value="{{ $row->id_exercicio }}">

                            <!-- @if ($row->imagem_exercicio)
                                <img src="{{ asset($row->imagem_exercicio) }}" alt="Descrição da imagem">
                            @endif -->
                            @foreach ($row->alternativas->sortBy('letra') as $alternativa)
                            
                                @component('components.card_exercicio')
                                    @slot('value')
                                        {{ $alternativa->descricao_alternativa }}
                                    @endslot
                                    @slot('option')
                                        {{ $alternativa->letra }}. '' . {{ $row->id_exercicio }}
                                    @endslot
                                    @slot('correta')
                                    @endslot
                                    @slot('letra')
                                        {{ $alternativa->letra }}
                                    @endslot

                                    @slot('style')
                                        @if (session('exercicios'))
                                            @foreach (session('exercicios') as $exercicio)
                                                @if (
                                                    $exercicio['alternativa_respondida'] == $alternativa->letra &&
                                                        $exercicio['id_exercicio'] == $alternativa->fk_id_exercicio)
                                                    checked style="font-weight: bold; color: blue;"
                                                @elseif($exercicio['resposta_certa_errada'] == 'correta' && $exercicio['id_exercicio'] == $alternativa->fk_id_exercicio)
                                                    style="font-weight: bold; color: blue;"
                                                @endif
                                            @endforeach
                                        @endif
                                    @endslot

                                    @slot('style_span')
                                        @if (session('exercicios'))
                                            @foreach (session('exercicios') as $exercicio)
                                         @if(!is_null($exercicio['alternativa_respondida']))
                                                @if ($exercicio['letra_correta'] == $alternativa->letra && $exercicio['id_exercicio'] == $alternativa->fk_id_exercicio)
                                                    style="font-weight: bold; color: white; background-color:green;"
                                                @elseif (
                                                    $exercicio['alternativa_respondida'] == $alternativa->letra &&
                                                        $exercicio['id_exercicio'] == $alternativa->fk_id_exercicio)
                                                    style="font-weight: bold; color: white; background-color:red;"
                                                @endif
                                        @endif
                                            @endforeach
                                        @endif
                                    @endslot
                                @endcomponent
                                <br>
                             
                                @if ($alternativa->imagem_alternativa)
                                     <img src="{{ asset($alternativa->imagem_alternativa) }}" alt="imagem_homepage" width="10%">
                                    <!-- <img src="{{ asset($alternativa->imagem_alternativa) }}" alt="Descrição da imagem"> -->
                                @endif
                                <br>
                            @endforeach
                          
                            <br>
                        <center>
                            @if (session('exercicios'))
                                @foreach (session('exercicios') as $exercicio)
                                    @if (!is_null($exercicio['resposta_certa_errada']))
                                        @if ($exercicio['resposta_certa_errada'] == 'correta' && $exercicio['id_exercicio'] == $alternativa->fk_id_exercicio && !is_null($exercicio['alternativa_respondida']))
                                            <div class="resposta-correta">Correto!</div>
                                        @elseif($exercicio['resposta_certa_errada'] == 'errada' && $exercicio['id_exercicio'] == $alternativa->fk_id_exercicio  && !is_null($exercicio['alternativa_respondida']))
                                            <div class="resposta-incorreta">Incorreto! Resposta correta:
                                                {{ $exercicio['letra_correta'] }} </div>
                                        @elseif(
                                            $exercicio['resposta_certa_errada'] == 'Selecione uma resposta antes de enviar.' &&
                                                $exercicio['id_exercicio'] == $alternativa->fk_id_exercicio)
                                            <div class="resposta-incorreta"> Selecione alguma alternativa, por favor! </div>
                                        @endif
                                    @endif
                                @endforeach
                            @endif

                        
                            @if (session('exercicios'))
                                @php
                                    $exercicios = session('exercicios');
                                    $ultimoExercicio = end($exercicios);

                                @endphp
                                @if ($ultimoExercicio['id_exercicio'] == $alternativa->fk_id_exercicio)
                                    <a name="exercicio_atual" style="display: hidden;"></a>
                                @endif
                            @endif


                            <!-- <button class="btn_exercicios">Enviar</button>  -->
                            <button type="submit" class="btn_exercicios"
                                @if (session('exercicios')) @foreach (session('exercicios') as $exercicio)
                                @if ($exercicio['id_exercicio'] == $alternativa->fk_id_exercicio && !is_null($exercicio['alternativa_respondida'])) disabled style = "background-color: red; color:white;" @endif
                                @endforeach
            @endif>Enviar</button>
                                        </center>

            </form> 
            </div>
                                        </div>
                                        
            
            </div>
        @endif
        @endforeach
        </center>
    </section>


    <div class="card_exercicios"> 
        
    </div>

    </div>
    </main>

    <script src="js/barra_pesquisa.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    @if (auth()->user()->nivel === 'admin')
        @include('layout._rodape_admin')
    @elseif(auth()->user()->nivel === 'usuario')
        @include('layout._rodape')
    @elseif(auth()->user()->nivel === 'professor')
        @include('layout._rodape_professor')
    @endif

</html>


