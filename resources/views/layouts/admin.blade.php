<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/layout/nice/img/favicon.png">
    <title>Administrador</title>

    <link href="/layout/nice/css/bootstrap.min.css" rel="stylesheet">
    <link href="/layout/nice/css/bootstrap-theme.css" rel="stylesheet">
    <link href="/layout/nice/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="/layout/nice/css/font-awesome.min.css" rel="stylesheet" />
    <link href="/layout/nice/css/widgets.css" rel="stylesheet">
    <link href="/layout/nice/css/style.css" rel="stylesheet">
    <link href="/layout/nice/css/style-responsive.css" rel="stylesheet" />
    <link href="/layout/nice/css/jquery-ui-1.10.4.min.css" rel="stylesheet">
    <link href="/css/admin.css" rel="stylesheet">

    <meta name="csrf-token" content="{!! csrf_token() !!}" />

</head>

<body>

<section id="container" class="">
    <header class="header dark-bg">
        <div class="toggle-nav">
            <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
        </div>
        <a href="/layout/nice/index.html" class="logo">Dev <span class="lite">Squad</span></a>
    </header>

    <aside>
        <div id="sidebar" class="nav-collapse ">
            <ul class="sidebar-menu">
                @include('includes.admin.menu')
            </ul>
        </div>
    </aside>

    <section id="main-content">
        <section class="wrapper">
            @yield('content')
        </section>

    </section>
</section>

<script src="/layout/nice/js/jquery.js"></script>
<script src="/layout/nice/js/jquery-ui-1.10.4.min.js"></script>
<script src="/layout/nice/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/layout/nice/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/layout/nice/js/bootstrap.min.js"></script>
<script src="/layout/nice/js/jquery.scrollTo.min.js"></script>
<script src="/layout/nice/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="/layout/nice/assets/jquery-knob/js/jquery.knob.js"></script>
<script src="/layout/nice/js/jquery.sparkline.js" type="text/javascript"></script>
<script src="/layout/nice/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>

<script src="/layout/nice/js/jquery.rateit.min.js"></script>

<script src="/layout/nice/js/scripts.js"></script>

<script src="/layout/nice/js/jquery.autosize.min.js"></script>
<script src="/layout/nice/js/jquery.placeholder.min.js"></script>
<script src="/layout/nice/js/jquery.slimscroll.min.js"></script>

<script src="/src/plugins/maskmoney/dist/jquery.maskMoney.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript" src="/src/plugins/jquery/jquery.form.js"></script>
<script src="/js/admin.js"></script>


</body>

</html>
