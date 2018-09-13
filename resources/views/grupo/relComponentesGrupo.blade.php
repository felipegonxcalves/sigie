<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Componentes</title>

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
<h2 align="center"></h2>

<table align="center">
    <tr>
        <td align="center"><strong>Nº</strong></td>
        <td align="center"><strong>COMPONENTES</strong></td>
        <td align="center"><strong>CONGREGAÇÃO</strong></td>
        <td align="center"><strong>GRUPO</strong></td>
    </tr>
    <?php $CONT = 1; ?>
    @foreach($componentes as $componente)
        <tr>
            <td>{{$CONT}}</td>
            <td>{{$componente->nome}}</td>
            <td>{{$componente->nome_igreja}}</td>
            <td>{{$componente->nome_grupo}}</td>
        </tr>
        <?php $CONT ++ ?>
    @endforeach
</table>
</body>
</html>