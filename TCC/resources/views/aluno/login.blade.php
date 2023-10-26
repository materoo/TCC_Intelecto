{{-- @extends('layout.site') --}}
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="shortcut icon" href="imagens/icone.png" type="image/x-icon">
    <title>Intelecto - Login</title>
</head>
    <body>
        <main>
            

            <div class="mae">
                <div class="container">
                  <div class="content">
                    <div class="image-box">
                     <img src="imagens/imagem_login.svg" alt="pessoa do login">
                    </div>
                  <form action="{{route('aluno.login.entrar')}}" method="post">
                    {{ csrf_field() }}
                    <div class="topic">Login - Intelecto</div>
                    <div class="input-box">
                      <input type="text"name="email" required>
                      <label>Digite seu E-mail</label>
                    </div>
                    <div class="input-box">
                      <input type="password" name="password" required>
                      <label>Digite sua Senha</label>
                    </div>
                    <br><br><br>
                    <a href="{{route('enviar_email')}}" class="esqSenha">Esqueci a senha</a>
                    <div class="input-box">
                      <input type="submit" value="Entrar">
                    </div>
                  </form>
                  @if(session()->has('success'))
                    {{ session()->get('success')}}
                    @else
                    @error('error')
                        {{session()->get('error')}}
                    @enderror
                    @endif
                </div>
                </div>
            </div>

<!-- ////////////////// velho -->
            
            
        </main>
        <script>
            // script.js
          document.addEventListener("DOMContentLoaded", function () {
            const darkModeToggle = document.getElementById("darkModeToggle");
            const siteImage = document.getElementById("imgLogo");
          
            // Load user preference from localStorage
            const darkModePreference = localStorage.getItem("darkMode");
            if (darkModePreference === "true") {
              document.body.classList.add("dark-mode");
              darkModeToggle.checked = true;
              siteImage.src = "{{ asset('imagens/logo_dark.png') }}"
            }
          
            darkModeToggle.addEventListener("change", function () {
              if (this.checked) {
                document.body.classList.add("dark-mode");
                localStorage.setItem("darkMode", "true");
                siteImage.src = "{{ asset('imagens/logo_dark.png') }}";
              } else {
                document.body.classList.remove("dark-mode");
                localStorage.setItem("darkMode", "false");
                siteImage.src = "{{ asset('imagens/logo_intelecto.svg') }}";
              }
            });
          });
          </script>
     </body>
</html>