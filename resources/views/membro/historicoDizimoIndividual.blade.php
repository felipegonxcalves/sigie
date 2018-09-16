@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1><strong>HISTÓRICO INDIVIDUAL DE DÍZIMO</strong></h1>
@stop

@section('content')
    <div class="box"></div>

    <div class="box-body">
            <table class="table table-responsive">
                <tr>
                    <th style="color: #9f191f"><strong>#</strong></th>
                    <th style="color: #9f191f"><strong>DATA DO DÍZIMO</strong></th>
                    <th style="color: #9f191f"><strong>VALOR DO DÍZIMO</strong></th>
                </tr>
                <?php $cont = 1;
                      $total = 0;
                ?>
                @if(!$dizimoDoMembro->isEmpty())
                    @foreach($dizimoDoMembro as $dizimista)
                        <tr>
                            <td><strong>{{$cont}}</strong></td>
                            <td><strong>{{date('d/m/Y', strtotime($dizimista->dt_dizimo))}}</strong></td>
                            <td><strong>{{' R$ '.$dizimista->val_dizimo}}</strong></td>
                        </tr>
                        <?php $cont ++;
                              $total = $total + $dizimista->val_dizimo;
                        ?>
                    @endforeach
                        <tr>
                            <td colspan="2"><strong>TOTAL</strong></td>
                            <td><strong>{{' R$ '.$total}}</strong></td>
                        </tr>
                @else
                    <tr>
                        <td align="center" style="color: red;">Ainda não foi registrado nenhum dízimo para esse Membro</td>
                    </tr>
                @endif
            </table>
    </div>

    <div class="form-group">
        <a class="btn btn-success" href="{{route('membro.index')}}">Voltar</a>
    </div>

    @if(isset($request))
        {!! $dizimoDoMembro->appends($request)->links() !!}
    @else
        {!! $dizimoDoMembro->links() !!}
    @endif

@stop