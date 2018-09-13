<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Relatório De Ofertas</title>
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

<h1 align="center" style="color:#1e282c;">Relátorio De Ofertas</h1>
<table align="center">
    <tr>
        <td align="center"><strong>#</strong></td>
        <td align="center"><strong>Nome da Congregação</strong></td>
        <td align="center"><strong>Data da Oferta</strong></td>
        <td align="center"><strong>Valor da Oferta</strong></td>
    </tr>
    <?php $cont = 1 ?>
    @foreach($ofertas as $oferta)
        <tr>
            <td align="center"> {{$cont}}</td>
            <td>{{$oferta->nome_igreja}}</td>
            <td align="center">{{$oferta->dt_oferta}}</td>
            <td align="center" style="color: #c9302c">R$ {{$oferta->val_oferta}}</td>
        </tr>
        <?php $cont ++ ?>
    @endforeach
</table>







</body>
</html>