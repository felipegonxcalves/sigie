<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Relatório De Saídas</title>
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
    <?php $cont = 1;
          $total = 0;
    ?>
    @foreach($saidas as $saida)
        <tr>
            <td align="center"> {{$cont}}</td>
            <td align="center">{{$saida->tipo}}</td>
            <td align="center">{{!empty($saida->descricao) ? $saida->descricao : '--'}}</td>
            <td align="center">{{$saida->nome_igreja}}</td>
            <td align="center">{{date('d/m/Y', strtotime($saida->dt_saida))}}</td>
            <td align="center" style="color: #c9302c">R$ {{$saida->val_saida}}</td>
        </tr>
        <?php $cont ++;
              $total = $total + $saida->val_saida;
        ?>
    @endforeach
        <tr>
            <td colspan="5" align="center"><strong>TOTAL</strong></td>
            <td align="center" style="color: #9f191f">R$ {{$total}}</td>
        </tr>
</table>
</body>
</html>