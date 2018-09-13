<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Comprovante</title>

    <!--Custon CSS (está em /public/assets/site/css/certificate.css)-->
    <!-- <link rel="stylesheet" href="{{ url('css/app.css') }}"> -->
</head>
<body>



<h1 align="center" style="color:#1e282c;">COMPROVANTE</h1>

    <div class="form-group">
        <p>Comprovante de <strong>{{$saida->tipo}}</strong>, realizado na <strong>{{$saida->nome_igreja}}</strong>, no valor de <strong>R$ {{$saida->val_saida}} reais</strong>, na data <strong>{{date('d/m/Y', strtotime($saida->dt_saida))}}</strong></p>
        <p>Descrição: <strong>{{$saida->descricao}}</strong></p>
    </div>
    <br/>
    <br/>
    <p>Assinatura tesoureiro(a):____________________________________________________________________________</p>
    <br/>
    <p>Assinatura responsável(a):___________________________________________________________________________</p>
    <br/>
    <br/>
    <p>---------------------------------------------------------------------------------------------------------------------------------------------</p>
    <br/>
    <h1 align="center" style="color:#1e282c;">COMPROVANTE</h1>

    <div class="form-group">
        <p>Comprovante de <strong>{{$saida->tipo}}</strong>, realizado na <strong>{{$saida->nome_igreja}}</strong>, no valor de <strong>R$ {{$saida->val_saida}} reais</strong>, na data <strong>{{$saida->dt_saida}}</strong></p>
        <p>Descrição: <strong>{{$saida->descricao}}</strong></p>
    </div>
    <br/>
    <br/>
    <p>Assinatura tesoureiro(a):____________________________________________________________________________</p>
    <br/>
    <p>Assinatura responsável(a):___________________________________________________________________________</p>





</body>
</html>