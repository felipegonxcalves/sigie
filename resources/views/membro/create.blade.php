@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1></h1>
@stop


@section('content')
    <!--<div class="box">-->
        <div class="box-body">
            <div class="panel panel-primary">
                <div class="panel-heading"><h3 class="panel-title">CADASTRO DE MEMBRO</h3></div>
                <div class="panel-body">
                    <form method="post" action="/membro">
                        {{csrf_field()}}

                        <h4 align="center">DADOS PESSOAIS</h4>

                        <div class="row">
                            <div class="alert alert-danger hidden">
                                <strong>Atenção: </strong> Mátricula já cadastrada.
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="nome">Matrícula (Opcional)</label>
                                <input type="text" placeholder="Digite a matrícula" name="matricula" class="form-control col-md-7">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nome">Nome do Membro *</label>
                                <input type="text" required="required" placeholder="Digite o nome completo" name="nome" class="form-control col-md-7">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="sexo">Sexo *</label>
                                <select required="required" name="sexo" class="form-control">
                                    <option value="Masculino">Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="dt_nascimento">Data Nascimento</label>
                                <input type="date" required="required" name="dt_nascimento" class="form-control col-md-5">
                            </div>
                            <div class="form-group col-md-3">
                                <label style="color: #9f191f" for="sexo">Como se tornou Membro ?</label>
                                <select id="flag_membro" onchange="igrejaAnterior()" required="required" name="flag_membro" class="form-control">
                                    <option value="Batismo">Batismo</option>
                                    <option value="Transferência de Igreja">Transferência de Igreja</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label style="color: #9f191f" for="sexo">Grupo pertencente</label>
                                <select id="id_grupo" name="id_grupo" class="form-control">
                                    <option value="">Nenhum</option>
                                    @foreach($grupos as $grupo)
                                        <option value="{{$grupo->id}}">{{$grupo->nome_grupo}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row" id="igrejaAnterior" style="display: none">
                            <div class="form-group col-md-5">
                                <label style="color: #9f191f" for="igreja_anterior_it">Igreja anterior</label>
                                <input type="text" id="igreja_anterior_it" name="igreja_anterior_it" class="form-control col-md-5">
                            </div>
                            <div class="form-group col-md-5">
                                <label style="color: #9f191f" for="nome_pastor_it">Nome do Pastor (Da igreja anterior)</label>
                                <input type="text" id="nome_pastor_it" name="nome_pastor_it" class="form-control col-md-5">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="tp_membros">Tipo de Membro</label>
                                <select required="required" name="tp_membros" class="form-control">
                                    @foreach($tipoMembros as $tipoMembro)
                                        <option value="{{$tipoMembro->id}}">{{$tipoMembro->destipo}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-7">
                                <label for="membro_congregacao">Selecione onde o Membro vai congregar</label>
                                <select required="required" id="membro_congregacao" name="membro_congregacao" class="form-control">
                                    @foreach($igrejaCongregacoes as $igrejaCongregacao)
                                        <option value="{{$igrejaCongregacao->id}}">{{$igrejaCongregacao->nome_igreja}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="telefone">Telefone(Fixo)</label>
                                <input type="text" placeholder="Digite o telefone" name="telefone" class="form-control col-md-5">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="celular">Celular</label>
                                <input type="text" placeholder="Digite o celular" name="celular" class="form-control col-md-5">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-7">
                                <label for="id_membro_oficio" style="color: #9f191f">Selecione o Ofício do Membro</label>
                                <select name="id_membro_oficio" id="id_membro_oficio" class="form-control">
                                    <option value="">NENHUM</option>
                                    @foreach($membroOficio as $oficio)
                                        <option value="{{$oficio->id}}">{{$oficio->cargo_oficial}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="box"></div>
                        <h4 align="center">ENDEREÇO</h4>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label for="logradouro">Logradouro *</label>
                                <input type="text" required="required" placeholder="Digite o Logradouro" name="logradouro" class="form-control col-md-10">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="cep">CEP</label>
                                <input type="number" placeholder="Ex: 40000045" name="cep" class="form-control col-md-3">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="nro">Nº *</label>
                                <input type="number" required="required" placeholder="Ex: 508" name="nro" class="form-control col-md-3">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="bairro">Bairro *</label>
                                <input type="text" required="required" placeholder="Digite o Bairro" name="bairro" class="form-control col-md-4">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label for="complemento">Complemento</label>
                                <input type="text" placeholder="Digite o Complemento" name="complemento" class="form-control col-md-10">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="cidade">Cidade *</label>
                                <input type="text" required="required" placeholder="Digite a cidade" name="cidade" class="form-control col-md-5">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="uf">UF *</label>
                                <select required="required" class="form-control" name="uf">
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
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="situacao" style="color: #9f191f">Situação</label>
                                <select required="required" name="situacao" class="form-control">
                                    <option value="Ativo">Ativo</option>
                                    <option value="Inativo">Inativo</option>
                                </select>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <a href="/membro" class="btn btn-danger">Cancelar</a>
                                <button type="submit" class="btn btn-success">Cadastrar</button>
                            </div>
                        </div>


            </form>
            </div>
        </div>

        </div>
    <!--</div>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        //SELECT 2
        $(document).ready(function(){
            $('#id_grupo').select2();
        });
        $(document).ready(function(){
            $('#id_membro_oficio').select2();
        });
        $(document).ready(function(){
            $('#membro_congregacao').select2();
        });


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

            $("input[name='matricula']").blur( function(){

                var matricula = $("input[name='matricula']").val();
                var token = $("input[type=hidden][name=_token]").val();

                $.post('{{route("membro.matricula")}}',{matricula: matricula, _token: token},function(data){

                    if( data === 'existe' ){

                        $(".alert").html("<strong>Atenção: </strong> Mátricula já existe").removeClass("hidden");
                        $("input[name='matricula']").val(''); //APAGA O VALOR DO INPUT
                    }else {
                        $(".alert").html("<strong> </strong> ").addClass("hidden");
                    }

                });
            });
        });
    </script>
@stop