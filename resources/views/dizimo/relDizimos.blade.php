<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Relatório De Dízimos</title>
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

<h1 align="center" style="color:#1e282c;">{{$title}}</h1>
<table border="1">
    <tr>
        <td align="center"><strong>#</strong></td>
        <td align="center"><strong>Nome da Congregação</strong></td>
        <td align="center"><strong>Nome Dizimista</strong></td>
        <td align="center"><strong>Data do Dízimo</strong></td>
        <td align="center"><strong>Valor do Dízimo</strong></td>
    </tr>
    <?php $cont = 1;
          $total = 0;
    ?>
    @foreach($dizimos as $dizimo)
        <tr>
            <td align="center">{{$cont}}</td>
            <td>{{$dizimo->nome_igreja}}</td>
            <td>{{$dizimo->nome}}</td>
            <td align="center">{{date('d/m/Y', strtotime($dizimo->dt_dizimo))}}</td>
            <td align="center" style="color: #c9302c">R$ {{$dizimo->val_dizimo}}</td>
        </tr>
        <?php $cont ++;
              $total = $total + $dizimo->val_dizimo;
        ?>
    @endforeach
        <tr>
            <td colspan="4" align="center"><strong>TOTAL</strong></td>
            <td align="center" style="color: #9f191f">R$ {{$total}}</td>
        </tr>
</table>
</body>
</html>