<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client as Guzzle;
use Illuminate\Support\Facades\DB;

class Pagseguro extends Model
{
    use PagseguroTrait;

    private $courses = [];
    private $reference;
    private $currency = 'BRL';

    public function __construct()
    {
        $this->reference = uniqid(date('YmdHis'));
    }


    /**
     * Metodo responsável por iniciar a sessão com pagseguro
     * @return \SimpleXMLElement[]
     */
    public function generateSession()
    {
        $params = [
            'email' => config('pagseguro.email'),
            'token' => config('pagseguro.token')
        ];

        $params = http_build_query($params);

        $guzzle = new Guzzle();
        $response = $guzzle->request('POST', config('pagseguro.url_transparent_session'), ['query' => $params]);
        $body = $response->getBody();
        $content = $body->getContents();
        $xml = simplexml_load_string($content);

        return $xml->id;
    }

    /**
     * Logica para Pagamento com Cartão de crédito
     * @param $data
     * @return \SimpleXMLElement[]
     */
    public function paymentCard($data)
    {
        list($parcela, $valor) = explode('-', $data->qtd_parcela);
        $valor = number_format($valor, 2, '.', '');

        $dados = [
            'senderHash'=>$data->car_senderHash,
            'paymentMode'=>'default',
            'paymentMethod'=>'creditCard',
            'currency' => $this->currency,
            'reference' => $this->reference,
            'notificationURL'=>'http://requestbin.fullcontact.com/1egsltd1',
            'creditCardToken'=>$data->creditCardToken,
            'installmentQuantity'=> trim($parcela), // Quantidade de parcelas
            'installmentValue'=> $valor, // Valor das parcelas
            'noInterestInstallmentQuantity'=>10, // Quantidade de parcelas sem juros
            'shippingAddressRequired' => 'false',
        ];

        $dados = array_merge($dados, $this->getConfigs());
        $dados = array_merge($dados, $this->getItems($data->listaCursos));
        $dados = array_merge($dados, $this->getSender($data->nome,$data->num_telefone, $data->email, $data->num_cpf ));
        $dados = array_merge($dados, $this->getCreditCard($data->nome, $data->num_cpf));
        $dados = array_merge($dados, $this->billingAddress());

        try {
            $guzzle = new Guzzle;
            $response = $guzzle->request('POST', config('pagseguro.url_payment_transparent'), [
                'form_params' => $dados,
            ]);
            $body = $response->getBody();
            $contents = $body->getContents();
            $xml = simplexml_load_string($contents);
            return [
                'success'       => true,
                'payment_link'  => (string)$xml->paymentLink,
                'reference'     => $this->reference,
                'status'          => (string)$xml->status,
                'code'          => (string)$xml->code,
            ];

        }catch (\Exception $e) {
            return [
                'success'       => false,
                'reference'     => (string)$e->getMessage(),
                'code'          => (string)$e->getCode(),
            ];
        }
    }

    /**
     * Logica para Pagamento com boleto
     * @param $data
     * @return array
     */
    public function paymentBillet($data)
    {
        $params = [
            'senderHash' => $data->senderHash,
            'paymentMode' => 'default',
            'paymentMethod' => 'boleto',
            'currency' => $this->currency,
            'reference' => $this->reference,
        ];
        $params = array_merge($params, $this->getConfigs());
        $params = array_merge($params, $this->getItems($data->listaCursos));
        $params = array_merge($params, $this->getSender($data->nome,$data->num_telefone, $data->email, $data->num_cpf ));
        $params = array_merge($params, $this->getShipping());

        try {
            $guzzle = new Guzzle;
            $response = $guzzle->request('POST', config('pagseguro.url_payment_transparent'), [
                'form_params' => $params,
            ]);
            $body = $response->getBody();
            $contents = $body->getContents();

            $xml = simplexml_load_string($contents);

            return [
                'success'       => true,
                'payment_link'  => (string)$xml->paymentLink,
                'reference'     => $this->reference,
                'status'          => (string)$xml->status,
                'code'          => (string)$xml->code,
            ];
        } catch (\Exception $e) {
            return [
                'success'       => false,
                'reference'     => (string)$e->getMessage(),
                'code'          => (string)$e->getCode(),
            ];
        }

    }

    /**
     * Recebe notificação do pageseguro e busca dados de atualização do pedido.
     * @param $notificationCode
     * @return array
     */
    public function getStatusTransaction($notificationCode)
    {
        $configs = $this->getConfigs();
        $params = http_build_query($configs);

        $guzzle = new Guzzle;
        $response = $guzzle->request('GET', config('pagseguro.url_notification'). "/{$notificationCode}", [
            'query' => $params,
        ]);
        $body = $response->getBody();
        $contents = $body->getContents();

        $xml = simplexml_load_string($contents);

        return [
            'status' => (string) $xml->status,
            'reference' => (string) $xml->reference
        ];
    }

    /**
     * Retorna os dados do comprador
     * @param $codReference
     * @return mixed
     */
    public function detalhesComprador($codReference)
    {
        $resultQuery = DB::select("
            SELECT
               a.nome,
                a.telefone,
                a.cpf,
                a.email
            FROM alunos a
            INNER JOIN pedidos p 
              ON a.id = p.aluno_id
            WHERE p.reference = '". $codReference . "' ");

        return $resultQuery;
    }

    /**
     * Dados do pedido
     * @param $codReference
     * @return mixed
     */
    public function detalhesPedido($codReference)
    {
        $resultQuery = DB::select("
          SELECT
                p.id as 'cod_pedido',
                p.code,
                p.valor_total,
                p.date as date_compra,
                c.path_file,
                c.path_image,
                c.nome as 'nome_curso',
                c.url_video
          FROM pedidos p 
          
          INNER JOIN curso_pedido cp
              ON p.id = cp.pedidos_id
          
          INNER JOIN cursos c 
              ON cp.cursos_id = c.id
          
          WHERE p.reference = '". $codReference . "' ");

        return $resultQuery;
    }
}
