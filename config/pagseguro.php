<?php
/**
 * Created by PhpStorm.
 * User: edson junior
 * Date: 08/05/18
 * Time: 20:53
 */

$environment = env('PAGSEGURO_ENVIRONMENT');
$isSandbox = ($environment == 'sandbox') ? true : false;

$urlSessionTranparent = ($isSandbox) ? 'https://ws.sandbox.pagseguro.uol.com.br/v2/sessions' : 'https://ws.pagseguro.uol.com.br/v2/sessions';
$urlPaymentTransparent = ($isSandbox) ? 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions' : 'https://ws.pagseguro.uol.com.br/v2/transactions';
$urlNotification = ($isSandbox) ? 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications' : 'https://ws.pagseguro.uol.com.br/v3/transactions/notifications';

return [

    'environment' => $environment,
    'email' => env('PAGSEGURO_EMAIL'),
    'token' => env('PAGSEGURO_TOKEN'),
    'url_transparent_session' => $urlSessionTranparent,
    'url_payment_transparent' => $urlPaymentTransparent,
    'url_notification' => $urlNotification
];