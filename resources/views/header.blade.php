<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque Produtos 1.0</title>
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/util.css') }}" />

</head>
<body>

    <nav class="menu">
        <a href="{{ url('produtos') }}">Produtos</a>
        <a href="{{ url('produtos/novo') }}">Novo</a>
        <a href="{{ url('produtos/estoque-baixo') }}">Estoque Baixo</a>
        <a href="{{ url('produtos/movimentacoes') }}">Movimentações</a>
    </nav>
    
