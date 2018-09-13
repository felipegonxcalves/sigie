<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Relatório De Entradas</title>
    <style>
        table {
            border: 1px solid black;
            border-collapse: collapse;
        }
        table td {
            border: 1px solid black;
        }
    </style>

    <!--Custon CSS (está em /public/assets/site/css/certificate.css)-->
<!-- <link rel="stylesheet" href="{{ url('css/app.css') }}"> -->
</head>
<body>

<h1 align="center" style="color:#1e282c;">Relátorio De Entradas</h1>
<table align="center">
    <tr>
        <td align="center"><strong>#</strong></td>
        <td align="center"><strong>Tipo de Entrada</strong></td>
        <td align="center"><strong>Descrição</strong></td>
        <td align="center"><strong>Congregação</strong></td>
        <td align="center"><strong>Data</strong></td>
        <td align="center"><strong>Valor</strong></td>
    </tr>
    <?php $cont = 1 ?>
    @foreach($entradas as $entrada)
        <tr>
            <td align="center"> {{$cont}}</td>
            <td align="center">{{$entrada->tipo}}</td>
            <td align="center">{{!empty($entrada->descricao) ? $entrada->descricao : '--'}}</td>
            <td align="center">{{$entrada->nome_igreja}}</td>
            <td align="center">{{$entrada->dt_entrada}}</td>
            <td align="center" style="color: #c9302c">R$ {{$entrada->val_entrada}}</td>
        </tr>
        <?php $cont ++ ?>
    @endforeach
</table>







</body>
</html>