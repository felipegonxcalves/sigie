@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1> Visualização </h1>
@stop

@section('content')
    <div class="box"></div>
    <div class="box-body">
    <div class="form-group col-md-10">
        <a href="/membro" class="btn btn-danger">Voltar</a>
    </div>

    <!-- <a href="/sede/create" class="btn btn-success">Cadastrar Nova Congregação</a> -->
    <div class="panel panel-success form-group col-md-10">
        <div class="panel-heading">DADOS PESSOAIS</div>
        <div class="panel-body">
            <table class="table table-bordered">
                <tbody>
                @foreach ($membros as $membro)

                    <tr>
                        <th scope="row">Matrícula</th>
                        <td>{{$membro->matricula}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nome</th>
                        <td>{{$membro->nome}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Sexo</th>
                        <td>{{$membro->sexo}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Data Nascimento</th>
                        <td>{{$membro->dt_nascimento}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Telefone</th>
                        <td>{{$membro->telefone}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Celular</th>
                        <td>{{$membro->celular}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Como se tornou Membro ?</th>
                        <td>{{$membro->flag_membro}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Igreja Anterior</th>
                        <td>{{!empty($membro->igreja_anterior_it) ? $membro->igreja_anterior_it : '--'}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nome Pastor Anterior</th>
                        <td>{{!empty($membro->nome_pastor_it) ? $membro->nome_pastor_it : '--'}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Tipo Membro</th>
                        <td>{{$membro->tipoMembro->destipo}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Grupo</th>
                        <td>{{!empty($membro->grupo->nome_grupo) ? $membro->grupo->nome_grupo : '--'}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Ofício do Membro</th>
                        <td>{{!empty($membro->membros_oficiais->cargo_oficial) ? $membro->membros_oficiais->cargo_oficial : 'Nenhum Ofício'}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Situação</th>
                        <td>{{$membro->situacao}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Congregação</th>
                        <td>{{$membro->igrejaCongregacao->nome_igreja}}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>

    <div class="panel panel-success form-group col-md-10">
        <div class="panel-heading">ENDEREÇO</div>
        <div class="panel-body">
            <table class="table table-bordered">
                <tbody>
            @foreach ($membros as $membro)
                <tr>
                    <th scope="row">Cep</th>
                    <td>{{$membro->endereco_membro->cep}}</td>
                </tr>
                <tr>
                    <th scope="row">Logradouro</th>
                    <td>{{$membro->endereco_membro->logradouro}}</td>
                </tr>
                <tr>
                    <th scope="row">Nº</th>
                    <td>{{$membro->endereco_membro->nro}}</td>
                </tr>
                <tr>
                    <th scope="row">Bairro</th>
                    <td>{{$membro->endereco_membro->bairro}}</td>
                </tr>
                <tr>
                    <th scope="row">Complemento</th>
                    <td>{{$membro->endereco_membro->complemento}}</td>
                </tr>
                <tr>
                    <th scope="row">Cidade</th>
                    <td>{{$membro->endereco_membro->cidade}}</td>
                </tr>
                <tr>
                    <th scope="row">UF</th>
                    <td>{{$membro->endereco_membro->uf}}</td>
                </tr>

                </tbody>
                @endforeach
            </table>
        </div>
    </div>

    </div>
@stop