<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="File Upload widget with multiple file selection, drag&amp;drop support, progress bars, validation and preview images, audio and video for jQuery. Supports cross-domain, chunked and resumable file uploads and client-side image resizing. Works with any server-side platform (PHP, Python, Ruby on Rails, Java, Node.js, Go etc.) that supports standard HTML form file uploads.">
    <title>Policlínica Saúde</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="{{url("template/resources/img/favicon.ico")}}" />
    <link rel="stylesheet" href="{{url("template/vendor/bootstrap/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{url("template/vendor/animate.css")}}">
    <link rel="stylesheet" href="{{url("template/resources/css/main-style.min.css")}}">
    <link rel="stylesheet" href="{{url("template/resources/css/skins/all-skins.min.css")}}">
    <link rel="stylesheet" href="{{url("template/resources/css/demo.css")}}">

    <link rel="stylesheet" type="text/css" href="{{url("plugins/DataTables/DataTables/datatables.min.css")}}"/>
    <link rel="stylesheet" href="{{url("plugins/jquery-confirm/dist/jquery-confirm.min.css")}}">

    {{--@TODO: Verificar o editor de texto a ser usado --}}
    {{--<link rel="stylesheet" href="{{url("template/vendor/wysihtml5/lib/css/prettify.css")}}">--}}
    {{--<link rel="stylesheet" href="{{url("template/vendor/wysihtml5/src/bootstrap-wysihtml5.css")}}">--}}
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">

    <link rel="stylesheet" href="{{url('css/styles.css')}}"/>
    @yield('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css" rel="stylesheet">
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112423372-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-112423372-1');
    </script>
</head>

<body class="skin-blue sidebar-mini">
<div class="page-loader-wrapper" >
    <div class="loader">
        <div class="preloader">
            <svg class='part' x="0px" y="0px" viewBox="0 0 256 256" style="enable-background:new 0 0 256 256;" xml:space="preserve">
                    <path class="svgpath" id="playload" d="M189.5,140.5c-6.6,29.1-32.6,50.9-63.7,50.9c-36.1,0-65.3-29.3-65.3-65.3
                          c0,0,17,0,23.5,0c10.4,0,6.6-45.9,11-46c5.2-0.1,3.6,94.8,7.4,94.8c4.1,0,4.1-92.9,8.2-92.9c4.1,0,4.1,83,8.1,83
                          c4.1,0,4.1-73.6,8.1-73.6c4.1,0,4.1,63.9,8.1,63.9c4.1,0,4.1-53.9,8.1-53.9c4.1,0,4.1,44.1,8.2,44.1c4.1,0,3.1-34.5,7.2-34.5
                          c4.1,0,3.1,24.6,7.2,24.6c4.1,0,2.5-14.5,5.2-14.5c2.2,0,0.8,5.1,4.2,4.9c0.4,0,13.1,0,13.1,0c0-34.4-27.9-62.3-62.3-62.3
                          c-27.4,0-50.7,17.7-59,42.3" />
                <path class="svgbg" d="M61,126c0,0,16.4,0,23,0c10.4,0,6.6-45.9,11-46c5.2-0.1,3.6,94.8,7.4,94.8c4.1,0,4.1-92.9,8.2-92.9
                          c4.1,0,4.1,83,8.1,83c4.1,0,4.1-73.6,8.1-73.6c4.1,0,4.1,63.9,8.1,63.9c4.1,0,4.1-53.9,8.1-53.9c4.1,0,4.1,44.1,8.2,44.1
                          c4.1,0,3.1-34.5,7.2-34.5c4.1,0,3.1,24.6,7.2,24.6c4.1,0,2.5-14.5,5.2-14.5c2.2,0,0.8,5.1,4.2,4.9c0.4,0,22.5,0,23,0" />
                    </svg>
        </div>
    </div>
</div>
<div class="wrapper">
    <header class="top-menu-header">
        <a href="{{ url('/') }}" class="logo">
            <span class="logo-mini"><img src="{{url("template/resources/img/logo-mini.png")}}" class="img-circle" alt="Logo Mini"/></span>
            <span class="logo-lg"><b>Policlínica</b> Saúde</span>
        </a>
        <nav class="navbar navbar-static-top">
            <a class="sidebar-toggle fa-icon" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-top-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" data-toggle="dropdown" aria-expanded="false">
                            <span class="hidden-xs">{{ Auth::user()->name }}<i class="fa fa-angle-down pull-right"></i></span>
                            <img src="{{url("template/resources/img/icons/icon-user.png")}}" class="user-image" alt="User Image">
                        </a>
                        <ul class="dropdown-menu user-menu animated flipInY">
                            {{--<li><a href="{{url('/perfil/'. Auth::user()->id)}}"><i class="ti-user"></i> Perfil</a></li>--}}
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="ti-power-off"></i> Sair
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    @if (Auth::user()->role_id === 1)
        @include('layouts.adminMenu')
    @else
        @include('layouts.clerkMenu')
    @endif

    <div class="content-wrapper">
        <section class="content-title">
            <h1>
                Painel Principal
                <small></small>
            </h1>
        </section>
        <section class="content">
            @yield('content')
        </section>
        <span class="return-up"><i class="fa fa-chevron-up"></i></span>
    </div>
    <footer class="main-footer">

    </footer>
</div>

<script src="{{url("template/vendor/wysihtml5/lib/js/wysihtml5-0.3.0.js")}}"></script>
<script src="{{url("template/vendor/jQuery/jquery-2.2.3.min.js")}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{url("template/vendor/wysihtml5/lib/js/prettify.js")}}"></script>
<script src="{{url("template/vendor/bootstrap/js/bootstrap.min.js")}}"></script>
<script src="{{url("template/vendor/jquery-validation/dist/jquery.validate.js")}}"></script>
<script src="{{url("js/helper/contador.js")}}"></script>
<script src="{{url("js/custom-jquery-validate.js")}}"></script>
<script src="{{url("template/vendor/jquery-fullscreen/jquery.fullscreen-min.js")}}"></script>
<script src="{{url("template/vendor/slimScroll/jquery.slimscroll.min.js")}}"></script>
<script src="{{url("template/vendor/fastclick/fastclick.min.js")}}"></script>
<script src="{{url("template/vendor/chartjs/Chart.min.js")}}"></script>
<script src="{{url("template/resources/js/app.min.js")}}"></script>
<script src="{{url("template/vendor/sparkline/jquery.sparkline.min.js")}}"></script>
<script src="{{url("plugins/jquery-confirm/dist/jquery-confirm.min.js")}}"></script>

<script src="{{url("plugins/DataTables/DataTables/datatables.min.js")}}"></script>
<script src="{{url("template/vendor/wysihtml5/src/bootstrap-wysihtml5.js")}}"></script>
<script src="{{url("plugins/mask-money/jquery.maskMoney.min.js")}}"></script>
<script src="{{url("plugins/jquery.maskedinput/jquery.maskedinput.min.js")}}"></script>

<script src="{{url("plugins/tinymce/js/tinymce/tinymce.min.js")}}"></script>
<script src="{{url("plugins/tinymce/js/tinymce/jquery.tinymce.min.js")}}"></script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script>
    table =  $('#example').DataTable(
        {
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
        }
    );
</script>

@yield('scripts')

</body>
</html>
