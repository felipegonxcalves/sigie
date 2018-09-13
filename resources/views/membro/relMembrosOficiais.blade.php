<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Relatório Oficiais</title>

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
<h2 align="center">Relatório Oficiais da Igreja</h2>

<table align="center">
    <tr>
        <td align="center"><strong>Nº</strong></td>
        <td align="center"><strong>Nome</strong></td>
        <td align="center"><strong>LOCALIDADE</strong></td>
        <td align="center"><strong>Função Ofício</strong></td>
    </tr>
    <?php $CONT = 1; ?>
    @foreach($membrosOficiais as $oficiais)
        <tr>
            <td>{{$CONT}}</td>
            <td>{{$oficiais->nome}}</td>
            <td>{{$oficiais->nome_igreja}}</td>
            <td>{{$oficiais->cargo_oficial}}</td>
        </tr>
        <?php $CONT ++ ?>
    @endforeach
</table>

</body>
</html>