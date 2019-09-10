@extends('layouts.admin')

@section('content')

    <div class="text-right">
        <a class="btn btn-primary novo-registro" href="" title="Bootstrap 3 themes generator">{!! trans('app.novo-registro') !!}</a>

        <hr/>
    </div>

    <section class="panel">
        <header class="panel-heading">{!! trans('app.listagem') !!}</header>

        <div class="panel-body">
            @if(!empty($grid->items()))
                <table class="table">
                    <thead>
                    <tr>
                        <th class="w-64">#</th>
                        <th>{!! trans('app.categoria') !!}</th>
                        <th>{!! trans('app.nome') !!}</th>
                        <th class="w-120">{!! trans('app.preco') !!}</th>
                        <th class="w-200">{!! trans('app.action') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($grid->items() AS $row)
                        <tr class="delete-{!! $row->ativo !!}">
                            <td class="text-center">{!! \App\Helpers\UtilHelpers::clearFields($row->imagem, 'produto-imagem') !!}</td>
                            <td>{!! $row->categorias->nome !!}</td>
                            <td>{!! $row->nome !!}</td>
                            <td>{!! \App\Helpers\UtilHelpers::clearFields($row->preco, 'money') !!}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a class="btn btn-info visualizar" href="{!! route('admin.produtos.visualizar', ['id'=>$row->id]) !!}"><i class="icon_search"></i></a>
                                    <a class="btn btn-success" href="{!! route('admin.produtos.edicao', ['id'=>$row->id]) !!}"><i class="icon_pencil-edit"></i></a>
                                    <a class="btn btn-danger delete" href="{!! route('admin.produtos.delete', ['id'=>$row->id]) !!}"><i
                                            class="icon_trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-right">
                    {!! $grid->render() !!}
                </div>
            @else
                <div class="alert alert-block alert-danger fade in">
                    {!! trans('app.nenhum-registro-encontrado') !!}
                </div>
            @endif
        </div>
    </section>
@stop
