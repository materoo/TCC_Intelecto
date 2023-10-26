<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intelecto - Matérias</title>
    <link rel="stylesheet" href="css/style_materias.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="shortcut icon" href="imagens/icone.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style_pagination.css">

    @if(auth()->user()->nivel === 'admin')
       @include('layout._cabecalho_admin')
    @elseif(auth()->user()->nivel === 'usuario')
      @include('layout._cabecalho')
    @elseif(auth()->user()->nivel === 'professor')
      @include('layout._cabecalho_professor')
    @endif      <main>
        <div class="container">
            <section class="conteudo_principal">
                <div class="texto_principal">
                    <img src="imagens/logo_intelecto.svg" alt="Logo Intelecto"  id="imgLogo">
                    <h2 class="h2_bonito">Matérias e Aulas:</h2>
                    <p>Através dessa página é possível acessar os conteúdos e materiais extras que os professores postam após as aulas, clique nos ícones das matérias para acessar os assuntos referentes de cada componente da grade curricular!!</p>
                </div>
                <div class="imagem_principal">
                    <img src="imagens/prof.png" alt="Professora ensinando">
                </div>
            </section>
        </div>

        <div class="materias">

            <h1>Matérias</h1>

            <div class="container">

                @foreach ($rows as $row)
    
                <div class="ui-card">
                    <div class="card">
                    <a href="{{ route('aulas.apresentar_assuntos', ['nome_materia' => $row->nome_materia]) }}" class="card">
                        <center>
                            <img src="imagens/liv.png" alt="Materia" width="110px" id="{{$row->nome_materia}}">
                            <h2 id="{{$row->nome_materia}}">{{$row->nome_materia}}</h2>
                        </center>
                    </a>
                </div>
                </div>
                @endforeach
    
                </div>
             
                <center>{{ $rows->links('pagination') }} </center>
        </div>
          
    </main>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
                // Mapeamento de IDs para caminhos de imagens
        const idToImagePath = {
            "Português": "{{ asset('imagens/port.png') }}",
            "Matemática": "{{ asset('imagens/mat.png') }}",
            "Química": "{{ asset('imagens/qui.png') }}",
            "Física": "{{ asset('imagens/fis.png') }}",
            "Biologia": "{{ asset('imagens/bio.png') }}",
            "Geografia": "{{ asset('imagens/geo.png') }}",
            "História": "{{ asset('imagens/hist.png') }}",
            "Inglês": "{{ asset('imagens/eng.png') }}",
            "Logica": "{{ asset('imagens/log.png') }}",
            "Redacao": "{{ asset('imagens/red.png') }}",
            // Adicione mais mapeamentos conforme necessário
        };

        // Função para atualizar todas as imagens com base nos IDs
        function atualizarImagens() {
            const cards = document.querySelectorAll(".card");

            cards.forEach((card) => {
                const h2Element = card.querySelector("h2");
                const id = h2Element.id;
                const imgElement = card.querySelector("img");
                const imagePath = idToImagePath[id];

                if (imgElement && imagePath) {
                    imgElement.src = imagePath;
                }
            });
        }

        // Chame a função para atualizar todas as imagens ao carregar a página
        window.addEventListener("load", atualizarImagens);
    </script>
    @if(auth()->user()->nivel === 'admin')
    @include('layout._rodape_admin')
 @elseif(auth()->user()->nivel === 'usuario')
   @include('layout._rodape')
 @elseif(auth()->user()->nivel === 'professor')
   @include('layout._rodape_professor')
 @endif
