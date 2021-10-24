<?php
/**
 * Created by PhpStorm.
 * User: edson
 * Date: 15/05/18
 * Time: 22:17
 */

namespace App\Model;

use GuzzleHttp\Client as Guzzle;

trait PagseguroTrait
{
    /**
     * Retorna configuração de acesso do pagseguro
     * @return array
     */
    public function getConfigs()
    {
        return [
            'email' => config('pagseguro.email'),
            'token' => config('pagseguro.token')
        ];
    }

    /**
     * Altera o tipo da moeda caso necessário
     * @param $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * Prepara os items do carinho para enviar para o pagseguro
     * @param $arItens
     * @return array
     */
    public function getItems($arItens)
    {
        $items = [];
        $position = 1;
        foreach ($arItens as $item) {
           $items["itemId{$position}"] = $item['id'];
           $items["itemDescription{$position}"] = $item['nome'];
           $items["itemAmount{$position}"] = number_format($item['valor'], 2, '.', '');
           $items["itemQuantity{$position}"] = 1;

           $position++;
        }

        return $items;
    }

    /**
     * Retorna os dados do comprador
     * @param $nome
     * @param $telefone
     * @param $email
     * @param $cpf
     * @return array
     */
    public function getSender($nome, $telefone, $email, $cpf)
    {
        return [
            'senderName' => $nome,
            'senderAreaCode' => substr($telefone, 0, 2),
            'senderPhone' => substr($telefone, 2),
//            @TODO: Descomentar essa linha para produção
//            'senderEmail' => $email,
//            'senderEmail' => 'c43800789043173653428@sandbox.pagseguro.com.br',
            'senderEmail' => 'c48852857890542334587@sandbox.pagseguro.com.br',
            'senderCPF' => $cpf
        ];
    }

    /**
     * Esta fixo com valores ficticios, caso seja necessário e so adicionar a entrada de dados no formulário
     * na parte de dados pessoais
     * @return array
     */
    public function getShipping()
    {
        return [
            'shippingType' => '1',
            'shippingAddressStreet' => 'Av. PagSeguro',
            'shippingAddressNumber' => '9999',
            'shippingAddressComplement' => '99o andar',
            'shippingAddressDistrict' => 'Jardim Internet',
            'shippingAddressPostalCode' => '99999999',
            'shippingAddressCity' => 'Cidade Exemplo',
            'shippingAddressState' => 'SP',
            'shippingAddressCountry' => 'ATA'
        ];
    }

    /**
     * Retorna os dados do cartão de crédito
     * @return array
     */
    public function getCreditCard($cNome, $cCpf)
    {
        return [
            'creditCardHolderName'=>$cNome,
            'creditCardHolderCPF'=>$cCpf,
            'creditCardHolderBirthDate'=>'01/01/1900',
            'creditCardHolderAreaCode'=>'99',
            'creditCardHolderPhone'=>'99999999',
        ];
    }

    /**
     * Endereço de entrega. Também será fixo caso necessário informar no formulário de compras
     * @return array
     */
    public function billingAddress()
    {
        return [
            'billingAddressStreet'=>'Av. PagSeguro',
            'billingAddressNumber'=>9999,
            'billingAddressComplement'=>'99o andar',
            'billingAddressDistrict'=>'Jardim Internet',
            'billingAddressPostalCode'=>99999999,
            'billingAddressCity'=>'Cidade Exemplo',
            'billingAddressState'=>'SP',
            'billingAddressCountry' => 'BRL',
        ];
    }
}