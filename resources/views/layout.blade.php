<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>Controle de Series</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light mb-2 d-flex justify-content-between" style="background-color: #e9ecef;">
    <a class="navbar navbar-expand-lg" href="{{ route('listar_series') }}">Home</a>
    @auth <a href="/sair" class="text-danger">Sair</a> @endauth
    @guest <a href="/entrar">Entrar</a> @endguest

</nav>
<div class="container">
    <div class="jumbotron">
        <h1>@yield('cabecalho')</h1>
    </div>

    @yield('conteudo')

</div>
</body>
</html>
