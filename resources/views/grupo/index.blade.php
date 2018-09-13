@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Grupos</h1>
@stop

@section('content')
    <div class="box"></div>
    <table class="table table-responsive">
        <tbody>
            <tr>
                <td><strong>Nome do Grupo</strong></td>
                <td><strong>Ações</strong></td>
            </tr>
        </tbody>
        @if(!$grupos->isEmpty())
            @foreach($grupos as $grupo)
                <tr>
                    <td>{{$grupo->nome_grupo}}</td>
                    <td><a class="btn btn-primary btn-xs" href="" data-toggle="modal" data-target="#exampleModal" data-whatever="{{$grupo->id}}"
                           data-nomegrupo="{{$grupo->nome_grupo}}"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
                        <a class="btn btn-success btn-xs" href="grupo-filtro/{{$grupo->id}}"> ver componentes</a></td>
                </tr>
            @endforeach
        @else
            <tr>
                <td align="center" style="color: #c9302c">Nenhum grupo cadastrado</td>
            </tr>
        @endif
    </table>

    {{ $grupos->links() }}

    <div class="modal fade bs-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Atualizar Grupo</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="/grupo/{{!empty($grupo->id) ? $grupo->id : ''}}">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="row">
                            <input type="hidden" name="form" value="create">
                            <input type="hidden" name="id_grupo" id="id_grupo" >

                            <div class="form-group col-md-6">
                                <label for="">Nome da Igreja:</label>
                                <input type="text" id="nome_grupo" name="nome_grupo" class="form-control col-md-4">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <a href="/grupo" class="btn btn-default" data-dismiss="modal">Cancelar</a>
                            <!--<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button> -->
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@stop

@section ('js')console
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>
<script src="{{asset('js/jquery.maskMoney.js')}}" ></script>
<script src="{{asset('js/jquery.mask.js')}}" ></script>
<script src="{{asset('js/jquery.inputmask.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>

<script type="text/javascript">
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var nomegrupo = button.data('nomegrupo')

        var modal = $(this)
        modal.find('.modal-title').text('Editar oferta de: ' + nomegrupo)
        modal.find('#id_grupo').val(recipient)
        modal.find('#nome_grupo').val(nomegrupo)
    })
</script>
@stop