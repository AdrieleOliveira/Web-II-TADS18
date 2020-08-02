<html>
  <head>
    <title>Sistema de Gestão de Municípios</title>
    <meta charset="UTF-8">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/template.css') }}" rel="stylesheet">
  </head>
  <body>
    <div class="container">
        <div class="cabecalho">
            @if($pagina != "Default")
                <div class="ca-titulo">
                    <img id="logo" src=@yield('logo')>
                    <h5>@yield('titulo')</h5>
                </div>
            @endif

            <h1 class="titulo"
                @if($pagina == "Default")
                    style="text-align: center"
                @endif
            >SGM - Sistema de Gestão de Municípios</h1>
        </div>

        @yield('conteudo')
    </div>
  </body>
  <footer>
      <div class="container">
          <hr>
          <b>&copy; 2020 - Adriele Santos de Oliveira.</b>
      </div>
  </footer>

<script src="{{ asset('js/app.js') }}" type='text/javascript'></script>
</html>
