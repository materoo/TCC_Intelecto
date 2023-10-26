<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/homepage.css">
    <title>Termos de Uso - Intelecto</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            transition: 0.3s;
            font-family: "Poppins", sans-serif;
        }

        :root {
            --cor01: #FFCEAE;
            --cor02: #FF8B3E;
            --cor03: #FFF5DD;
            --dark: #22353E;
            --dark2: #0F181D;
        }

        body {
            font-family: 'Segoe UI';
            font-weight: 400;
            background-color: #FFF5DD;

        }

        .termos_uso{
            padding: 60px;
        }

        .botao_termos {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            background: var(--cor02);
            border-radius: 7px;
        }

        .botao_termos:hover{
            transition: 0.3s;
            color: var(--cor02);
            background: #fff;
        } 

        ul{
            padding-left: 25px
        }

        .dark-mode ul li {
            color: #fff;
        }
    </style>
</head>
    <body>
            <div class="termos_uso">
                <h1>Termos de Uso e Política de Cookies</h1>
                <h2>1. Introdução</h2>
                <p>Estes Termos de Uso e Política de Cookies (doravante referidos como "Termos") regulam o uso do nosso site e a coleta e uso de cookies para salvar informações do usuário. Ao acessar e usar nosso site, você concorda com estes Termos.</p>
                <h2>2. Uso de Cookies</h2>
                <p>Nosso site utiliza cookies para coletar e armazenar informações sobre sua interação com o site. Essas informações podem incluir, mas não estão limitadas a, preferências de idioma, preferências de usuário e histórico de navegação.</p>
                <h2>3. Finalidades dos Cookies</h2>
                <p>Os cookies são utilizados para os seguintes fins:</p>
                <ul>
                    <li>Personalização da experiência do usuário;</li>
                    <li>Análise de tráfego do site;</li>
                    <li>Melhoria da usabilidade do site;</li>
                    <li>Publicidade direcionada.</li>
                </ul>
                <h2>4. Consentimento do Usuário</h2>
                <p>Ao usar nosso site, você concorda com a coleta e uso de cookies, de acordo com estes Termos. Você pode retirar seu consentimento a qualquer momento, ajustando as configurações do seu navegador para rejeitar cookies. No entanto, observe que isso pode afetar a funcionalidade do site.</p>
                <h2>5. Contato</h2>
                <p>Se você tiver alguma dúvida ou preocupação sobre nossos Termos ou Política de Cookies, entre em contato conosco em: [contato@inteleco.com.br].</p>
                <p>Estes Termos estão sujeitos a alterações. Verifique periodicamente esta página para obter as versões mais atualizadas dos Termos.</p>
                <br><br><a href="{{route('home')}}" class="botao_termos">Voltar para a Homepage</a>
            </div>
      
    </body>

@if(auth()->user()->nivel === 'admin')
@include('layout._rodape_admin')
@elseif(auth()->user()->nivel === 'usuario')
@include('layout._rodape')
@elseif(auth()->user()->nivel === 'professor')
@include('layout._rodape_professor')
@endif