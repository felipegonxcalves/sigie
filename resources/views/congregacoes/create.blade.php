@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="panel panel-primary">
                <div class="panel-heading"><h3 class="panel-title">Cadastro de Congregação</h3></div>
                <div class="panel-body">
                    <form method="post" action="/congregacoes">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="form-group col-md-7">
                                <label for="nome">Nome *</label>
                                <input type="text" required="required" placeholder="EX: Igreja Evangélica " name="nome" class="form-control col-md-7">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="nome_curto">Nome Curto (Opcional) </label>
                                <input type="text" placeholder="EX: ADESB" name="nome_curto" class="form-control col-md-3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label for="descricao">Descrição (Opcional) </label>
                                <input type="text" placeholder="Digite a descrição" name="descricao" class="form-control col-md-10">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label for="logradouro">Logradouro</label>
                                <input type="text" required="required" placeholder="Digite o Logradouro" name="logradouro" class="form-control col-md-10">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="cep">CEP</label>
                                <input type="number" required="required" placeholder="Ex: 40000045" name="cep" class="form-control col-md-3">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="nro">Nº</label>
                                <input type="number" required="required" placeholder="Ex: 508" name="nro" class="form-control col-md-3">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="bairro">Bairro</label>
                                <input type="text" required="required" placeholder="Digite o Bairro" name="bairro" class="form-control col-md-4">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="cidade">Cidade</label>
                                <input type="text" required="required" placeholder="Digite a cidade" name="cidade" class="form-control col-md-5">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="uf">UF</label>
                                <select class="form-control" name="uf">
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espírito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select>
                            </div>
                        </div>

                        <br/>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <button type="submit" class="btn btn-success">Cadastrar</button>
                            </div>
                        </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@stop