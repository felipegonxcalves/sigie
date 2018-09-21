<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>RELATÓRIO</title>
    <style>
        table {

            padding-right: 10px;
            border-collapse: collapse;
            border: 2px solid #ccc;
            border-radius: 5px;
        }
        table td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>

    <!--Custon CSS (está em /public/assets/site/css/certificate.css)-->
<!-- <link rel="stylesheet" href="{{ url('css/app.css') }}"> -->
</head>
<body>

<h3 align="center" style="color:#1e282c;"> <strong>RELATÓRIO GERAL ENTRADAS E SAÍDAS</strong></h3>
<table align="center">
    <tr>
        <td align="center" colspan="4"><strong>ENTRADAS</strong></td>
    </tr>
    <tr>
        <td align="center"><strong>LOCALIDADE</strong></td>
        <td align="center"><strong>TIPO ENTRADA</strong></td>
        <td align="center"><strong>DATA ENTRADA</strong></td>
        <td align="center"><strong>VALOR ENTRADA</strong></td>
    </tr>
    <?php $cont = 1;
    $totalEntrada = 0;
    ?>
    @foreach($entradas as $entrada)
        <tr>
            <td align="center">{{$entrada->nome_igreja}}</td>
            <td align="center">{{$entrada->tipo}}</td>
            <td align="center">{{date('d/m/Y', strtotime($entrada->dt_entrada)) }}</td>
            <td align="center" style="color: #c9302c">R$ {{$entrada->valorEntrada}}</td>
        </tr>
        <?php
        $totalEntrada = $totalEntrada + $entrada->valorEntrada;
        ?>
    @endforeach
    <tr>
        <td align="center" colspan="3"><strong>TOTAL</strong></td>
        <td align="center" style="color: #9f191f">R$ {{$totalEntrada}}</td>
    </tr>
</table>

<br/>
<table align="center">
    <tr>
        <td align="center" colspan="5"><strong>SAÍDAS</strong></td>
    </tr>
    <tr>
        <td align="center"><strong>LOCALIDADE</strong></td>
        <td align="center"><strong>TIPO SAÍDA</strong></td>
        <td align="center"><strong>DESCRIÇÃO</strong></td>
        <td align="center"><strong>DATA SAÍDA</strong></td>
        <td align="center"><strong>VALOR SAÍDA</strong></td>
    </tr>
    <?php $cont = 1;
    $totalSaida = 0;
    ?>
    @foreach($saidas as $saida)
        <tr>
            <td align="center">{{$saida->nome_igreja}}</td>
            <td align="center">{{$saida->tipo}}</td>
            <td align="center">{{$saida->descricao}}</td>
            <td align="center">{{date('d/m/Y', strtotime($saida->dt_saida)) }}</td>
            <td align="center" style="color: #c9302c">R$ {{$saida->totalSaida}}</td>
        </tr>
        <?php
        $totalSaida = $totalSaida + $saida->totalSaida;
        ?>
    @endforeach
    <tr>
        <td align="center" colspan="4"><strong>TOTAL</strong></td>
        <td align="center" style="color: #9f191f">R$ {{$totalSaida}}</td>
    </tr>
</table>

<br/>
<table align="center">
    <tr>
        <td align="center" colspan="2"><strong>PARCIAL</strong></td>
    </tr>
    <?php
        $soma = $totalEntrada - $totalSaida;
    ?>
    <tr>
        <td align="center"><strong>SOMA</strong></td>
        <td align="center" style="color: #c9302c"> <strong style="color: #141a1d">(Valor de Entrada)</strong> R$ {{$totalEntrada}} - R$ {{$totalSaida}} <strong style="color: #141a1d">(Valor de Saída)</strong> =  <strong style="color: #141a1d">(Resultado)</strong> R$ {{$soma}}</td>
    </tr>
</table>

</body>
</html>