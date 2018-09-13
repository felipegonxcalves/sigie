@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Ofícios</h1>
@stop

@section('content')
    <div class="box"></div>
    <table class="table table-responsive">
        <tbody>
        <tr>
            <td><strong>Nome do Ofício</strong></td>
            <td><strong>Ações</strong></td>
        </tr>
        </tbody>
        @if(!$oficios->isEmpty())
            @foreach($oficios as $oficio)
                <tr>
                    <td>{{$oficio->cargo_oficial}}</td>
                    <td><a class="btn btn-primary btn-xs" href="" data-toggle="modal" data-target="#exampleModal" data-whatever="{{$oficio->id}}"
                           data-nomeoficio="{{$oficio->cargo_oficial}}"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
                </tr>
            @endforeach
        @else
            <tr>
                <td align="center" style="color: #c9302c">Nenhum ofício cadastrado</td>
            </tr>
        @endif
    </table>

    {{ $oficios->links() }}

    <div class="modal fade bs-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Atualizar Ofício</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="/oficiais-igreja/{{!empty($oficio->id) ? $oficio->id : ''}}">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="row">
                            <input type="hidden" name="form" value="index">
                            <input type="hidden" name="id_oficio" id="id_oficio" >

                            <div class="form-group col-md-6">
                                <label for="">Tipo de Oficial</label>
                                <input type="text" placeholder="Ex: Porteiro, Levita, Dirigente de Círculo de Oração, etc.." class="form-control" id="cargo_oficial" name="cargo_oficial">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <a href="/oficiais-igreja" class="btn btn-default" data-dismiss="modal">Cancelar</a>
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
        var nomeoficio = button.data('nomeoficio')

        var modal = $(this)
        modal.find('.modal-title').text('Editar oferta de: ' + nomeoficio)
        modal.find('#id_oficio').val(recipient)
        modal.find('#cargo_oficial').val(nomeoficio)
    })
</script>
@stop