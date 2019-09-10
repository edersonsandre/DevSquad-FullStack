<li class="active">
    <a class="" href="layout/nice/index.html">
        <i class="icon_house_alt"></i>
        <span>{!! trans('app.painel-controle') !!}</span>
    </a>
</li>
<li class="sub-menu">
    <a href="javascript:;" class="">
        <i class="icon_document_alt"></i>
        <span>{!! trans('app.cadastro') !!}</span>
        <span class="menu-arrow arrow_carrot-right"></span>
    </a>
    <ul class="sub">
        <li><a class="" href="{!! route('admin.produtos.index') !!}">{!! trans('app.produto') !!}</a></li>
    </ul>
</li>
