<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        .btn-download {
            font-size: 11px;
            font-family: Helvetica, Arial, sans-serif;
            font-weight: normal;
            color: rgb(255, 255, 255);
            text-decoration: none;
            background-color: rgb(32, 135, 40);
            border-width: 15px 25px;
            border-style: solid;
            border-color: rgb(32, 135, 40);
            border-radius: 3px;
            display: inline-block;
            margin: 2px;
        }
    </style>

</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td align="left" style="font-size:25px;color:#333333;padding-top:30px;font-family:Helvetica,arial,sans-serif" class="">
                        Dados de acesso
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:16px;color:#333333;padding-top:30px;font-family:Helvetica,arial,sans-serif" class="">
                        Olá {{ $comprador->nome }}, obrigado por ter escolhido a Policlínica Saúde e Vida, esperamos contribuir o máximo
                        com seu aprendizado. Segue abaixo os materiais do(s) curso(s) e também os dados de acesso para realizar a avaliação final:
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:16px;color:#333333;padding-top:30px;font-family:Helvetica,arial,sans-serif" class="">
                        <p>Para fazer a avaliação final é necessário acessar nosso site através do link
                            <a href="https://www.policlinicasaudeevida.com.br/#/cursos-online">www.policlinicasaudeevida.com.br</a> e realizar o login com seu
                            e-mail e cpf.
                        </p>
                        <p>
                            <strong>login:</strong> {{ $comprador->email }} <br />
                            <strong>senha:</strong> {{ $comprador->cpf }}
                        </p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="">
                <tbody>
                <tr>
                    <td align="left" style="padding:25px 0 0 0" class="">
                        <table border="0" cellspacing="0" cellpadding="0" class="">
                            <tbody>
                            <tr>
                                @foreach($pedidos as $pedido)
                                    <td align="left" style="padding:20px;font-size:16px;line-height:25px;color:#666666;font-family:Helvetica,arial,sans-serif" class="">
                                        <img src="{{ $pedido->path_image}}" alt="">

                                    </td>
                                    <td align="left" style="padding:20px;font-size:16px;line-height:25px;color:#666666;font-family:Helvetica,arial,sans-serif" class="">
                                        <p>Curso: {{ $pedido->nome_curso }} </p>
                                        <p>
                                            <a href="{{$pedido->path_file}}" class="btn-download">Baixar Apostila →</a>
                                            <a href="{{$pedido->url_video}}" class="btn-download">Vídeo Aula </a><br />
                                        </p>
                                    </td>
                                @endforeach
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>