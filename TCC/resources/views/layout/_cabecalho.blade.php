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
        <img src="{{ asset(auth()->user()->imagem) }}" alt="user" class="imgCabecalho">
        
        
       
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
            <a href="{{ route('listar.redacoes_corrigidas', ['cpf' => auth()->user()->cpf]) }}" class="nav-link">
            <i class="bx bx-file-find icon"></i>
              <span class="link">Redações Corrigidas</span>
            </a>
          </li>
        <li class="list">
          <a href="{{route('materiais')}}" class="nav-link">
            <i class="bx bx-book icon">  </i>
            <span class="link">Materiais</span>
          </a>
        </li>
        <li class="list">
          <a href="{{route('aluno_listar_exercicio')}}" class="nav-link">
            <i class="bx bx-pencil icon"></i>
            <span class="link">Exercícios</span>
          </a>
        </li>
        <li class="list">
          <a href="{{route('redacao')}}" class="nav-link">
            <i class="bx bx-file icon"></i>
            <span class="link">Redações</span>
          </a>
        </li>

        <li class="list">
        <a href="{{ route('redacao.list_aluno_para_aluno', ['cpf' => auth()->user()->cpf]) }}" class="nav-link">
            <i class="bx bx-cloud-upload icon"></i>
            <span class="link">Redações Enviadas</span>
          </a>
        </li>

      </ul>

      <div class="bottom-cotent">
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

