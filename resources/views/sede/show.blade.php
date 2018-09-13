@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1> {{$igrejaCongregacao->nome_igreja}}</h1>
@stop

@section('content')
    <div class="box"></div>
    <a href="/sede" class="btn btn-danger">Voltar</a>
    <!-- <a href="/sede/create" class="btn btn-success">Cadastrar Nova Congregação</a> -->
    <div class="box-body">
        <div class="">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$igrejaCongregacao->nome_igreja}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome Curto</th>
                    <td>{{!empty($igrejaCongregacao->nome_curto) ? $igrejaCongregacao->nome_curto : '--'}}</td>
                </tr>
                <tr>
                    <th scope="row">Descrição</th>
                    <td>{{!empty($igrejaCongregacao->descricao) ? $igrejaCongregacao->descricao : '--'}}</td>
                </tr>
                <tr>
                    <th scope="row">Logradouro</th>
                    <td>{{$igrejaCongregacao->logradouro}}</td>
                </tr>
                <tr>
                    <th scope="row">CEP</th>
                    <td>{{$igrejaCongregacao->cep}}</td>
                </tr>
                <tr>
                    <th scope="row">Nº</th>
                    <td>{{$igrejaCongregacao->nro}}</td>
                </tr>
                <tr>
                    <th scope="row">Bairro</th>
                    <td>{{$igrejaCongregacao->bairro}}</td>
                </tr>
                <tr>
                    <th scope="row">Cidade</th>
                    <td>{{$igrejaCongregacao->cidade}}</td>
                </tr>
                <tr>
                    <th scope="row">Estado</th>
                    <td>{{$igrejaCongregacao->uf}}</td>
                </tr>
                <tr>
                    <th scope="row">Tipo</th>
                    <td>{{$igrejaCongregacao->tp_igreja == 's' ? 'Sede' : 'Congregação'}}</td>
                </tr>
                <tr>
                    <th scope="row">Dirigente</th>
                    <td>{{!empty($igrejaCongregacao->membro->nome) ? $igrejaCongregacao->membro->nome : '--'}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop