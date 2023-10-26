<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/404.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <title>404</title>
</head>
    <body>
        <img src="{{ asset('imagens/Broken light bulb-pana.svg') }}" alt="erro 404">   
        <h1>Erro 500</h1>
        <h1>Problema interno no servidor</h1> 
        <a href="{{ route('aluno.login') }}">Voltar para login</a>

<footer class="footer">
    <div class="footer-wave-box">
        <div class="footer-wave"></div>
    </div>
    <div class="social">
        <a href="https://instagram.com/escolaintelecto?igshid=MzRlODBiNWFlZA=="><ion-icon name="logo-instagram"></ion-icon></a>
        {{-- <a href="#"><ion-icon name="logo-twitter"></ion-icon></a>
        <a href="#"><ion-icon name="logo-linkedin"></ion-icon></a> --}}
        <a href="https://www.facebook.com/intelectobauru"><ion-icon name="logo-facebook"></ion-icon></a>
    </div>


    <p class="copyright">
        Intelecto @ 2023
    </p>


</footer>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
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