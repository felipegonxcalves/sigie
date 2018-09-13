@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="panel panel-primary">
                <div class="panel-heading"><h3 class="panel-title">Atualizar Dados</h3></div>
                <div class="panel-body">
                    <form method="post" action="/sede/{{$igrejaCongregacao->id}}">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="row">
                            <div class="form-group col-md-7">
                                <label for="nome">Nome *</label>
                                <input type="text" required="required" placeholder="EX: Igreja Evangélica" value="{{$igrejaCongregacao->nome_igreja}}" name="nome" class="form-control col-md-7">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="nome_curto">Nome Curto (Opcional) </label>
                                <input type="text" placeholder="EX: ADESB" value="{{$igrejaCongregacao->nome_curto}}" name="nome_curto" class="form-control col-md-3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label for="descricao">Descrição (Opcional) </label>
                                <input type="text" placeholder="Digite a descrição" value="{{$igrejaCongregacao->descricao}}" name="descricao" class="form-control col-md-10">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label for="logradouro">Logradouro</label>
                                <input type="text" required="required" placeholder="Digite o Logradouro" value="{{$igrejaCongregacao->logradouro}}" name="logradouro" class="form-control col-md-10">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="cep">CEP</label>
                                <input type="number" required="required" placeholder="Ex: 40000045" value="{{$igrejaCongregacao->cep}}" name="cep" class="form-control col-md-3">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="nro">Nº</label>
                                <input type="number" required="required" placeholder="Ex: 508" value="{{$igrejaCongregacao->nro}}" name="nro" class="form-control col-md-3">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="bairro">Bairro</label>
                                <input type="text" required="required" placeholder="Digite o Bairro" value="{{$igrejaCongregacao->bairro}}" name="bairro" class="form-control col-md-4">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="cidade">Cidade</label>
                                <input type="text" required="required" placeholder="Digite a cidade" value="{{$igrejaCongregacao->cidade}}" name="cidade" class="form-control col-md-5">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="uf">UF</label>
                                <select class="form-control" name="uf">
                                    <option value="AC"{{$igrejaCongregacao->uf == 'AC' ? 'selected' : ''}}> Acre</option>
                                    <option value="AL"{{$igrejaCongregacao->uf == 'AL' ? 'selected' : ''}}> Alagoas</option>
                                    <option value="AP"{{$igrejaCongregacao->uf == 'AP' ? 'selected' : ''}}>Amapá</option>
                                    <option value="AM"{{$igrejaCongregacao->uf == 'AM' ? 'selected' : ''}}>Amazonas</option>
                                    <option value="BA"{{$igrejaCongregacao->uf == 'BA' ? 'selected' : ''}}>Bahia</option>
                                    <option value="CE"{{$igrejaCongregacao->uf == 'CE' ? 'selected' : ''}}>Ceará</option>
                                    <option value="DF"{{$igrejaCongregacao->uf == 'DF' ? 'selected' : ''}}>Distrito Federal</option>
                                    <option value="ES"{{$igrejaCongregacao->uf == 'ES' ? 'selected' : ''}}>Espírito Santo</option>
                                    <option value="GO"{{$igrejaCongregacao->uf == 'GO' ? 'selected' : ''}}>Goiás</option>
                                    <option value="MA"{{$igrejaCongregacao->uf == 'MA' ? 'selected' : ''}}>Maranhão</option>
                                    <option value="MT"{{$igrejaCongregacao->uf == 'MT' ? 'selected' : ''}}>Mato Grosso</option>
                                    <option value="MS"{{$igrejaCongregacao->uf == 'MS' ? 'selected' : ''}}>Mato Grosso do Sul</option>
                                    <option value="MG"{{$igrejaCongregacao->uf == 'MG' ? 'selected' : ''}}>Minas Gerais</option>
                                    <option value="PA"{{$igrejaCongregacao->uf == 'PA' ? 'selected' : ''}}>Pará</option>
                                    <option value="PB"{{$igrejaCongregacao->uf == 'PB' ? 'selected' : ''}}>Paraíba</option>
                                    <option value="PR"{{$igrejaCongregacao->uf == 'PR' ? 'selected' : ''}}>Paraná</option>
                                    <option value="PE"{{$igrejaCongregacao->uf == 'PE' ? 'selected' : ''}}>Pernambuco</option>
                                    <option value="PI"{{$igrejaCongregacao->uf == 'PI' ? 'selected' : ''}}>Piauí</option>
                                    <option value="RJ"{{$igrejaCongregacao->uf == 'RJ' ? 'selected' : ''}}>Rio de Janeiro</option>
                                    <option value="RN"{{$igrejaCongregacao->uf == 'RN' ? 'selected' : ''}}>Rio Grande do Norte</option>
                                    <option value="RS"{{$igrejaCongregacao->uf == 'RS' ? 'selected' : ''}}>Rio Grande do Sul</option>
                                    <option value="RO"{{$igrejaCongregacao->uf == 'RO' ? 'selected' : ''}}>Rondônia</option>
                                    <option value="RR"{{$igrejaCongregacao->uf == 'RR' ? 'selected' : ''}}>Roraima</option>
                                    <option value="SC"{{$igrejaCongregacao->uf == 'SC' ? 'selected' : ''}}>Santa Catarina</option>
                                    <option value="SP"{{$igrejaCongregacao->uf == 'SP' ? 'selected' : ''}}>São Paulo</option>
                                    <option value="SE"{{$igrejaCongregacao->uf == 'SE' ? 'selected' : ''}}>Sergipe</option>
                                    <option value="TO"{{$igrejaCongregacao->uf == 'TO' ? 'selected' : ''}}>Tocantins</option>
                                </select>
                            </div>
                        </div>
                        <br/>
                        <div class="row">

                            <div class="form-group col-md-5">
                                <a href="/sede" class="btn btn-danger">Voltar</a>
                                <button type="submit" class="btn btn-success">Atualizar</button>
                            </div>
                        </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@stop