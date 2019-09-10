@extends('layouts.admin')

@section('content')

    <div class="text-right">
        <a class="btn btn-primary listagem">{!! trans('app.listagem') !!}</a>
        <hr/>
    </div>

    <section class="panel">
        <header class="panel-heading">{!! trans('app.registro') !!}</header>

        <div class="panel-body">
            <form method="POST" class="frm-ajax" action="{!! route('admin.produtos.save') !!}" enctype="multipart/form-data">
                @csrf
                @input(['type'=>'hidden', 'name'=>'id'])

                <div class="row">
                    <div class="col-md-6">
                        @include('components.form.text', ['name'=>'nome', 'label'=>trans('app.nome')])
                        <div class="row">
                            <div class="col-md-6">
                                @include('components.form.select', ['name'=>'categoria', 'label'=>trans('app.categoria'), 'options'=>(new App\Model\Categorias)->_lists()])
                            </div>
                            <div class="col-md-6">
                                @include('components.form.text', ['name'=>'preco', 'label'=>trans('app.preco'), 'class'=>'form-control decimal'])
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                @include('components.form.file', ['name'=>'imagem', 'label'=>trans('app.imagem')." (png, jpg)"])
                            </div>
                            <div class="col-md-4">
                                @include('components.form.select', ['name'=>'ativo', 'label'=>trans('app.status'), 'options'=> \App\Helpers\DataHelpers::Ativo()])
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        @include('components.form.textarea', ['name'=>'descricao', 'label'=>trans('app.descricao'),'rows'=>9])
                    </div>
                </div>


                <hr/>
                <button type="submit" class=" btn btn-success">{!! trans('app.gravar') !!}</button>
                <a type="button" class=" btn btn-default listagem">{!! trans('app.cancelar') !!}</a>
            </form>

        </div>
    </section>
@stop
