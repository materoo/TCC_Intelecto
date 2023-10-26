<link rel="stylesheet" href="{{ asset('css/estilo.css') }}" />

<link
  href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
  rel="stylesheet"
/>
</head>
<body>
<nav>
  <div class="logo">
    <i class="bx bx-menu menu-icon"></i>
  </div>
  <div class="sidebar">
    <div class="logo">
      <i class="bx bx-menu menu-icon"></i>
      <span class="logo-name">Intelecto</span>
    </div>

    <div class="sidebar-content">
    <div class="guarda-perfil">

        <!-- <div class="user"><i class="bx bx-user-circle icon" ></i></div> -->
        <img src="{{ asset('imagens/gatito3.jpg') }}" alt="user" class="imgCabecalho">   <!--mudar a imagem-->
        <div class="nome-perfil">
            <h1 class="nome-perfil-x">{{auth()->user()->name}}</h1>
        </div>

    </div>
      <ul class="lists">
        <li class="list">
          <a href="{{route('home')}}" class="nav-link">
            <i class="bx bx-home-alt icon"></i>
            <span class="link">Home</span>
          </a>
        </li>
        <li class="list">
          <a href="{{route('menu.adm')}}" class="nav-link">
            <i class="bx bx-book icon">  </i>
            <span class="link">Cadastro e Listar</span>
          </a>
        </li>
        <li class="list">
        <a href="{{route('menu_aluno.adm')}}" class="nav-link">
            <i class="bx bx-book icon"> </i>
            <span class="link">Telas Aluno</span>
          </a>
        </li>
        <li class="list">
        <a href="https://intelecto.vercel.app" class="nav-link">
            <i class="bx bx-line-chart icon"> </i>
            <span class="link">Estatísticas</span>
          </a>
        </li>
      </ul>


      <div class="bottom-cotent">
        <!-- <li class="list">
            <label class="switch">
                <input type="checkbox" id="darkModeToggle">
                <span class="slider"></span>
            </label>
          </li> -->

          <li class="list">
          <a href="" class="nav-link">
            <i class="bx bx-moon icon"></i>
            <span class="link">Alterar tema:</span>
            <label class="switch">
              <input type="checkbox" id="darkModeToggle">
              <span class="slider"></span>
            </label>
          </a>
        </li>

        <!-- <li class="list">
          <a href="#" class="nav-link">
            <i class="bx bx-cog icon"></i>
            <span class="link">Configurações</span>
          </a>
        </li> -->
        <li class="list">
          <a href="{{route('logout')}}" class="nav-link">
            <i class="bx bx-log-out icon"></i>
            <span class="link">Logout</span>
          </a>
        </li>
      </div>
    </div>
  </div>
</nav>

<section class="overlay"></section>

<!-- <script src="script.js"></script> -->

