<h2>{!! $model->nome !!}</h2>
<hr/>

<div class="row">
    <div class="col-md-5">
        @php
            $imagem = App\Helpers\UploadHelper::getImagemProduto($model->imagem);
        @endphp

        @if(!empty($imagem))
            <img src='{!! $imagem !!}' width='250px' class='img-thumbnail'>
        @endif
    </div>
    <div class="col-md-7">
        <div class="row">
            <div class="col-md-4 text-right"><strong>{!! trans('app.categoria') !!}</strong></div>
            <div class="col-md-8 text-left">{!! $model->categorias->nome !!}</div>
            <div class="col-md-4 text-right"><strong>{!! trans('app.preco') !!}</strong></div>
            <div class="col-md-8 text-left">R$ {!! number_format($model->preco, 2, ',','.') !!}</div>

        </div>
        <br />
        <br />
        <div class="row">
            <div class="col-md-12 text-left">
                <div class="well well-sm">{!! $model->descricao !!}</div>
            </div>
        </div>
    </div>
</div>

<hr/>
