<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/footer.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/btn.css')}}" type="text/css">
    <title>Intelecto - Trocar a senha</title>
</head>
<body>

    <div class="mamae">
        <div class="logo">
            <img src="imagens/logo_intelecto.svg" alt="logo_intelecto" class="logo_intelecto" id="imgLogo">  
        </div>
        <div class="form_wrap">
            
            <h1 class="conf">Insira o Código e a Nova Senha:</h1>
        
            <form class="" action="{{route('confirmar_email_senha')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
            <input type="text" name="codigoresp" placeholder="codigo">
            <input type="password" name="senhaNova" placeholder="Nova senha">
            <input type="hidden" name="time" value="{{(string)$info->time}}">
            <input type="hidden" name="codigo" value="{{(string)$info->codigo}}">
            <input type="hidden" name="email" value="{{(string)$info->email}}">
           
            <button class="button-conf"><span>Enviar</span></button>

            <br>
                <label class="switch">
                    modo escuro???
                    <input type="checkbox" id="darkModeToggle">
                    <span class="slider"></span>
                </label>

            </form>
        
        </div>
    </div>
@include('layout._rodape_confirmacao')

