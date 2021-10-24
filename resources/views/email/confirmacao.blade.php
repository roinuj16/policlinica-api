<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tbody><tr>
                    <td align="center" style="font-size:25px;color:#333333;padding-top:30px;font-family:Helvetica,arial,sans-serif" class="">
                        Confirmação de Pagamento do site Policlinica Saúde e Vida
                    </td>
                </tr>
                <tr>
                    <td align="center" style="padding:20px 0 0 0;font-size:16px;line-height:25px;color:#666666;font-family:Helvetica,arial,sans-serif" class="">
                        <p>Ola {{ $dados['usuario']['nome'] }} recebemos seu pedido {{ $dados['pagamento']['code'] }}</p>
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
                    <td align="center" style="padding:25px 0 0 0" class="">
                        <table border="0" cellspacing="0" cellpadding="0" class="">
                            <tbody>
                            <tr>
                                <td align="center">
                                    @if ($dados['pagamento']['payment_link'] != null)
                                        <p> Você deve pagar o boleto em qualquer agência bancária, casa lotérica, ou através do seu internet banking.</p>
                                                                                                                                                                                                                                                                                <a href="{{ $dados['pagamento']['payment_link'] }}" style="font-size:16px;font-family:Helvetica,Arial,sans-serif;font-weight:normal;color:rgb(255,255,255);text-decoration:none;background-color:rgb(32,135,40);border-width:15px 25px;border-style:solid;border-color:rgb(32,135,40);border-radius:3px;display:inline-block" class="">Baixar Boleto →</a>
                                    @else
                                        <p>
                                            Assim que recebermos a confirmação do pagamento enviaremos os dados de acesso ao curso.
                                        </p>
                                    @endif
                                </td>
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