<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Relatório de Membros</title>

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
<h2 align="center">Relatório de Membros</h2>

<table align="center">
    <tr>
        <td align="center"><strong>Nº</strong></td>
        <td align="center"><strong>MATRÍCULA</strong></td>
        <td align="center"><strong>NOME</strong></td>
        <td align="center"><strong>LOCALIDADE</strong></td>
        <td align="center"><strong>TIPO MEMBRO</strong></td>
    </tr>
    <?php $CONT = 1; ?>
    @foreach($membros as $membro)
        <tr>
            <td>{{$CONT}}</td>
            <td>{{empty($membro->matricula) ? '--' : $membro->matricula}}</td>
            <td>{{$membro->nome}}</td>
            <td>{{$membro->igrejaCongregacao->nome_igreja}}</td>
            <td>{{$membro->tipoMembro->destipo}}</td>
        </tr>
        <?php $CONT ++ ?>
    @endforeach
</table>

</body>
</html>