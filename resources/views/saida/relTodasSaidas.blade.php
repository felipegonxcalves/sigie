<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Relatório De Saídas</title>
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

<h1 align="center" style="color:#1e282c;">Relátorio De Saídas(Pagamentos)</h1>
<table align="center">
    <tr>
        <td align="center"><strong>#</strong></td>
        <td align="center"><strong>Tipo de Saída</strong></td>
        <td align="center"><strong>Descrição</strong></td>
        <td align="center"><strong>Congregação</strong></td>
        <td align="center"><strong>Data</strong></td>
        <td align="center"><strong>Valor</strong></td>
    </tr>
    <?php $cont = 1 ?>
    @foreach($saidas as $saida)
        <tr>
            <td align="center"> {{$cont}}</td>
            <td align="center">{{$saida->tipo}}</td>
            <td align="center">{{!empty($saida->descricao) ? $saida->descricao : '--'}}</td>
            <td align="center">{{$saida->nome_igreja}}</td>
            <td align="center">{{$saida->dt_saida}}</td>
            <td align="center" style="color: #c9302c">R$ {{$saida->val_saida}}</td>
        </tr>
        <?php $cont ++ ?>
    @endforeach
</table>







</body>
</html>