<html>
<head>
    <title>VetClin - @yield('titulo')</title>
    <meta charset="UTF-8">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/template.css') }}" rel="stylesheet">
    <style>
        body { padding: 40px; padding-top: 0px; }
        .navbar { margin-bottom: 30px; }
        .card{ margin: 20px; }
        .card-header { color: white; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark bg-success">
    <a class="navbar-brand" href="#"><b>VetClin System</b></a>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li @if($tag=="CLI") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="{{ route('cliente.index') }}">
                    <b>Clientes</b>
                </a>
            </li>
            <li @if($tag=="ESP") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="{{ route('especialidade.index') }}">
                    <b>Especialidades</b>
                </a>
            </li>
            <li @if($tag=="VET") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="{{ route('veterinario.index') }}">
                    <b>Veterinários</b>
                </a>
            </li>
        </ul>
    </div>
</nav>
<div class="card">
    <div class="card-header bg-success">
        <h3><b>{{$titulo}}</b></h2>
    </div>
    <div class="card-body">
        @yield('conteudo')
    </div>
</div>
<hr>
</body>
<footer>
    <b>&copy;2020 - Adriele Santos de Oliveira.</b>
</footer>

<script src="{{asset('js/app.js')}}" type="text/javascript"></script>

@yield('script')
</html>

