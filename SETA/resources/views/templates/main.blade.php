<html>
<head>
    <title>SETA - @yield('titulo')</title>
    <meta charset="UTF-8">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/template.css') }}" rel="stylesheet">
    <style>
        body {  }
    </style>
</head>
<body>
    <div class="container">
        <div class="cabecalho">
            <div class="ca-titulo">
                <img id="logo" src=@yield('logo')>
                <h5><b>@yield('titulo')</b></h5>
            </div>

            <h1 class="titulo">SETA - Sistema de Entrega de Trabalhos e Atividades</h1>

            <a  href="{{ route('home') }}"> <b>Home</b> </a>
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

<script src="{{asset('js/app.js')}}" type="text/javascript"></script>

@yield('script')
</html>

