<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Bens da Igreja</title>

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
<h2 align="center">Relação de Bens da Congregação</h2>

<table align="center">
    <tr>
        <td align="center"><strong>Nº</strong></td>
        <td align="center"><strong>CONGREGAÇÃO</strong></td>
        <td align="center"><strong>ITEM</strong></td>
        <td align="center"><strong>QUANTIDADE</strong></td>
        <td align="center"><strong>MARCA</strong></td>
    </tr>
    <?php $CONT = 1; ?>
    @foreach($bensCongregacao as $bens)
        <tr>
            <td>{{$CONT}}</td>
            <td>{{$bens->nome_igreja}}</td>
            <td>{{$bens->nome_item}}</td>
            <td align="center">{{$bens->qtd_item}}</td>
            <td>{{$bens->marca_item}}</td>
        </tr>
        <?php $CONT ++ ?>
    @endforeach
</table>
</body>
</html>