@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1></h1>
@stop


@section('content')
    <!--<div class="box">-->
    <div class="box-body">
        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title">Atualização de Membro</h3></div>
            <div class="panel-body">
                <form method="post" action="/membro/{{$membros->id_membro}}">
                    {{csrf_field()}}
                    {{method_field('PUT')}}

                    <h4 align="center"><strong>DADOS PESSOAIS</strong></h4>
                    <div class="row">
                        <div class="form-group col-md-7">
                            <label for="nome">Nome do Membro *</label>
                            <input type="text" required="required" placeholder="Digite o nome completo" name="nome" class="form-control col-md-7" value="{{$membros->nome}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="sexo">Sexo</label>
                            <select required="required" name="sexo" class="form-control">
                                <option {{ $membros->sexo == 'Masculino' ? 'selected' : '' }} value="Masculino">Masculino</option>
                                <option {{ $membros->sexo == 'Feminino' ? 'selected' : '' }} value="Feminino">Feminino</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="dt_nascimento">Data Nascimento</label>
                            <input type="date" required="required" name="dt_nascimento" value="{{$membros->dt_nascimento}}" class="form-control col-md-5">
                        </div>
                        <div class="form-group col-md-3">
                            <label style="color: #9f191f" for="sexo">Como se tornou Membro ?</label>
                            <select id="flag_membro" onchange="igrejaAnterior()" required="required" name="flag_membro" class="form-control">
                                <option {{ $membros->flag_membro == 'Batismo' ? 'selected' : '' }} value="Batismo">Batismo</option>
                                <option {{ $membros->flag_membro == 'Transferência de Igreja' ? 'selected' : '' }} value="Transferência de Igreja">Transferência de Igreja</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label style="color: #9f191f" for="sexo">Grupo pertencente</label>
                            <select id="id_grupo" name="id_grupo" class="form-control">
                                <option value="">Nenhum</option>
                                @foreach($grupos as $grupo)
                                    <option {{$grupo->id == $membros->id_grupo ? 'selected' : ''}} value="{{$grupo->id}}">{{$grupo->nome_grupo}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row" id="igrejaAnterior" style="display: none">
                        <div class="form-group col-md-5">
                            <label style="color: #9f191f" for="igreja_anterior_it">Igreja anterior</label>
                            <input type="text" id="igreja_anterior_it" name="igreja_anterior_it" value="{{!empty($membros->igreja_anterior_it) ? $membros->igreja_anterior_it : '' }}" class="form-control col-md-5">
                        </div>
                        <div class="form-group col-md-5">
                            <label style="color: #9f191f" for="nome_pastor_it">Nome do Pastor (Da igreja anterior)</label>
                            <input type="text" id="nome_pastor_it" name="nome_pastor_it" value="{{!empty($membros->nome_pastor_it) ? $membros->nome_pastor_it : '' }}" class="form-control col-md-5">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="tp_membros">Tipo de Membro</label>
                            <select required="required" name="tp_membros" class="form-control">
                                @foreach($tipoMembros as $tipoMembro)
                                    <option {{ $tipoMembro->id == $membros->id_tipomembros ? 'selected' : '' }} value="{{$tipoMembro->id}}">{{$tipoMembro->destipo}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="membro_congregacao">Selecione onde o Membro vai congregar</label>
                            <select required="required" name="membro_congregacao" class="form-control">
                                @foreach($igrejaCongregacoes as $igrejaCongregacao)
                                    <option {{ $igrejaCongregacao->id == $membros->id_igrejacongregacoes ? 'selected' : '' }}  value="{{$igrejaCongregacao->id}}">{{$igrejaCongregacao->nome_igreja}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="telefone">Telefone(Fixo)</label>
                            <input type="text" placeholder="Digite o telefone" name="telefone" value="{{$membros->telefone}}" class="form-control col-md-5">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="celular">Celular</label>
                            <input type="text" placeholder="Digite o celular" name="celular" value="{{$membros->celular}}" class="form-control col-md-5">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-7">
                            <label for="id_membro_oficio" style="color: #9f191f">Selecione o Ofício do Membro</label>
                            <select required="required" name="id_membro_oficio" class="form-control">
                                @if($membros->id_membro_oficio == null)
                                    <option value="">NENHUM</option>
                                    @foreach($membroOficio as $oficio)
                                        <option {{ $oficio->id == $membros->id_membro_oficio ? 'selected' : '' }} value="{{$oficio->id}}">{{$oficio->cargo_oficial}}</option>
                                    @endforeach
                                @else
                                    @foreach($membroOficio as $oficio)
                                        <option {{ $oficio->id == $membros->id_membro_oficio ? 'selected' : '' }} value="{{$oficio->id}}">{{$oficio->cargo_oficial}}</option>
                                    @endforeach
                                    <option value="">NENHUM</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="box"></div>
                    <h4 align="center"><strong>ENDEREÇO</strong></h4>
                    <div class="row">
                        <div class="form-group col-md-10">
                            <label for="logradouro">Logradouro</label>
                            <input type="text" required="required" placeholder="Digite o Logradouro" name="logradouro" value="{{$membros->log_membro}}" class="form-control col-md-10">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="cep">CEP</label>
                            <input type="number" placeholder="Ex: 40000045" name="cep" value="{{$membros->cep_membro}}" class="form-control col-md-3">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="nro">Nº</label>
                            <input type="number" required="required" placeholder="Ex: 508" name="nro" value="{{$membros->nro_membro}}" class="form-control col-md-3">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="bairro">Bairro</label>
                            <input type="text" required="required" placeholder="Digite o Bairro" name="bairro" value="{{$membros->bairro_membro}}" class="form-control col-md-4">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-10">
                            <label for="complemento">Complemento</label>
                            <input type="text" placeholder="Digite o Complemento" name="complemento" value="{{$membros->complemento_membro}}" class="form-control col-md-10">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="cidade">Cidade</label>
                            <input type="text" required="required" placeholder="Digite a cidade" name="cidade" value="{{$membros->cidade_membro}}" class="form-control col-md-5">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="uf">UF</label>
                            <select required="required" class="form-control" name="uf">
                                <option {{ $membros->uf_membro == 'AC' ? 'selected' : '' }} value="AC">Acre</option>
                                <option {{ $membros->uf_membro == 'AL' ? 'selected' : '' }} value="AL">Alagoas</option>
                                <option {{ $membros->uf_membro == 'AP' ? 'selected' : '' }} value="AP">Amapá</option>
                                <option {{ $membros->uf_membro == 'AM' ? 'selected' : '' }} value="AM">Amazonas</option>
                                <option {{ $membros->uf_membro == 'BA' ? 'selected' : '' }} value="BA">Bahia</option>
                                <option {{ $membros->uf_membro == 'CE' ? 'selected' : '' }} value="CE">Ceará</option>
                                <option {{ $membros->uf_membro == 'DF' ? 'selected' : '' }} value="DF">Distrito Federal</option>
                                <option {{ $membros->uf_membro == 'ES' ? 'selected' : '' }} value="ES">Espírito Santo</option>
                                <option {{ $membros->uf_membro == 'GO' ? 'selected' : '' }} value="GO">Goiás</option>
                                <option {{ $membros->uf_membro == 'MA' ? 'selected' : '' }} value="MA">Maranhão</option>
                                <option {{ $membros->uf_membro == 'MT' ? 'selected' : '' }} value="MT">Mato Grosso</option>
                                <option {{ $membros->uf_membro == 'MS' ? 'selected' : '' }} value="MS">Mato Grosso do Sul</option>
                                <option {{ $membros->uf_membro == 'MG' ? 'selected' : '' }} value="MG">Minas Gerais</option>
                                <option {{ $membros->uf_membro == 'PA' ? 'selected' : '' }} value="PA">Pará</option>
                                <option {{ $membros->uf_membro == 'PB' ? 'selected' : '' }} value="PB">Paraíba</option>
                                <option {{ $membros->uf_membro == 'PR' ? 'selected' : '' }} value="PR">Paraná</option>
                                <option {{ $membros->uf_membro == 'PE' ? 'selected' : '' }} value="PE">Pernambuco</option>
                                <option {{ $membros->uf_membro == 'PI' ? 'selected' : '' }} value="PI">Piauí</option>
                                <option {{ $membros->uf_membro == 'RJ' ? 'selected' : '' }} value="RJ">Rio de Janeiro</option>
                                <option {{ $membros->uf_membro == 'RN' ? 'selected' : '' }} value="RN">Rio Grande do Norte</option>
                                <option {{ $membros->uf_membro == 'RS' ? 'selected' : '' }} value="RS">Rio Grande do Sul</option>
                                <option {{ $membros->uf_membro == 'RO' ? 'selected' : '' }} value="RO">Rondônia</option>
                                <option {{ $membros->uf_membro == 'RR' ? 'selected' : '' }} value="RR">Roraima</option>
                                <option {{ $membros->uf_membro == 'SC' ? 'selected' : '' }} value="SC">Santa Catarina</option>
                                <option {{ $membros->uf_membro == 'SP' ? 'selected' : '' }} value="SP">São Paulo</option>
                                <option {{ $membros->uf_membro == 'SE' ? 'selected' : '' }} value="SE">Sergipe</option>
                                <option {{ $membros->uf_membro == 'TO' ? 'selected' : '' }} value="TO">Tocantins</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="situacao" style="color: #9f191f">Situação</label>
                            <select required="required" name="situacao" class="form-control">
                                <option {{ $membros->situacao == 'Ativo' ? 'selected' : '' }} value="Ativo">Ativo</option>
                                <option {{ $membros->situacao == 'Inativo' ? 'selected' : '' }} value="Inativo">Inativo</option>
                            </select>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <a href="/membro" class="btn btn-danger">Voltar</a>
                            <button type="submit" class="btn btn-success">Atualizar</button>
                        </div>
                    </div>
            </div>
        </div>
        </form>
    </div>
    <!--</div>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
    <script>
        //       function igrejaAnterior() {
        //            var flag_membroo = document.getElementById("flag_membro");
        //            if(flag_membroo == "Transferência de Igreja"){
        //               document.getElementById('igrejaAnterior').style.visibility = "visible";
        //           }
        //      }
        $(document).ready(function() {
            //OCULTA O CONTEÚDO DA DIV
            $('#igrejaAnterior').hide();
            $('#flag_membro').change(function() {
                if ($('#flag_membro').val() == 'Transferência de Igreja') {
                    $('#igrejaAnterior').show();
                } else {
                    $("#igreja_anterior_it").val("");
                    $("#nome_pastor_it").val("");
                    $('#igrejaAnterior').hide();
                }
            });
        });
    </script>
@stop