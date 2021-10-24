<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Policlínica Saúde</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="{{url("template/resources/img/favicon.ico")}}" />
    <link rel="stylesheet" href="{{url("template/vendor/bootstrap/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{url("template/vendor/animate.css")}}">
    <link rel="stylesheet" href="{{url("template/resources/css/main-style.min.css")}}">
    <link rel="stylesheet" href="{{url("template/resources/css/skins/all-skins.min.css")}}">
    <link rel="stylesheet" href="{{url("template/resources/css/demo.css")}}">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112423372-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-112423372-1');
    </script>
</head>
<body class="skin-blue login-page">
<div class="box-login">
    <div class="box-login-body">
        <h3><span><b>Policlínica</b>&nbsp;Saúde</span></h3>
        <p class="box-login-msg">Acesso ao sistema</p>
        <form class="login-form" action="{{ route('login') }}" method="post">
            {{ csrf_field() }}
            @if ($errors->has('email'))
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Login ou Senha inválido.
                </div>
            @endif
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input class="form-control" type="text" name='email' placeholder="Usuário" autofocus/>
            </div>
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input class="form-control" type="password" name='password' placeholder="Senha" />
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>Login ou Senha inválido.</strong>
                    </span>
                @endif
            </div>
            <div class="form-group form-action">
                <button type="submit" class="btn btn-block btn-info"><span>Login</span></button>
            </div>
        </form>
    </div>
</div>
<!-- JS scripts -->
<script src="{{url("template/vendor/jQuery/jquery-2.2.3.min.js")}}"></script>
<script src="{{url("template/vendor/bootstrap/js/bootstrap.min.js")}}"></script>
</body>
</html>
