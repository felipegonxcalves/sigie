<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Ficha Ministerial</title>

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
<h2 align="center"><strong>FICHA MINISTERIAL DE: </strong> {{$membro->nome}}  </h2>
<br/>

<table align="center">
    <tr>
        <td align="center"><strong>#</strong></td>
        <td align="center"><strong>EXPERIÊNCIA CAMPO</strong></td>
        <td align="center"><strong>OBSERVAÇÃO</strong></td>
    </tr>
    <?php $CONT = 1; ?>
    @foreach($fichaMembro as $ministerio)
        <tr>
            <td>{{$CONT}}</td>
            <td>{{$ministerio->experiencias_campo}}</td>
            <td>{{!empty($ministerio->observacao) ? $ministerio->observacao : '-----'}}</td>
        </tr>
        <?php $CONT ++ ?>
    @endforeach
</table>

</body>
</html>