<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Relatório De Dízimos</title>
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

<h1 align="center" style="color:#1e282c;">Relátorio de Dízimos por Congregação e Perído</h1>
<table>
    <tr>
        <td align="center"><strong>Nome da Congregação</strong></td>
        <td align="center"><strong>Nome Dizimista</strong></td>
        <td align="center"><strong>Data do Dízimo</strong></td>
        <td align="center"><strong>Valor do Dízimo</strong></td>
    </tr>
    @foreach($dizimos as $dizimo)
        <tr>
            <td>{{$dizimo->nome_igreja}}</td>
            <td>{{$dizimo->nome}}</td>
            <td align="center">{{$dizimo->dt_dizimo}}</td>
            <td align="center" style="color: #c9302c">R$ {{$dizimo->val_dizimo}}</td>
        </tr>
    @endforeach
</table>







</body>
</html>