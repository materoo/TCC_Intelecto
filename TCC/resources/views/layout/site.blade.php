@include('layout._cabecalho')

{{-- Exibe o conteúdo, chamado em cada página --}}
@yield('content')

{{-- Inclui o código do rodape --}}
@include('layout._rodape')