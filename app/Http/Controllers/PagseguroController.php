<?php

namespace App\Http\Controllers;

use App\Mail\EnviarEmail;
use App\Model\Alunos;
use App\Model\Pagseguro;
use App\Model\PagseguroTrait;
use App\Model\Pedidos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


class PagseguroController extends Controller
{
    /**
     * Metodo responsável por iniciar a sessão com pagseguro
     * @param Pagseguro $pagseguro
     * @return \Illuminate\Http\JsonResponse
     */
    public function initSessionPs(Pagseguro $pagseguro)
    {
        $idSession = $pagseguro->generateSession();
        return response()->json(compact('idSession'));
    }

    /**
     * Realiza o pagamento com Cartão de Crédito.
     * @param Request $request
     * @param Pagseguro $pagseguro
     * @return \Illuminate\Http\JsonResponse
     */
    public function paymentCreditCard(Request $request, Pagseguro $pagseguro, Pedidos $pedido, Alunos $aluno)
    {
        $result = $pagseguro->paymentCard($request);

        if (isset($result) && $result['success'] === true) {

            $dadosPedido = [
                'valorTotal' => $request->valor_total,
                'cursos' => $request->listaCursos,
                'paymentMode' => ($request->paymentMode == 'cartao' ? 1 : 2),
                'qtd_parcela' => explode('-', $request->qtd_parcela)[0],
                'vlr_parcela' => explode('-', $request->qtd_parcela)[1],
            ];

            //Envia email
            $this->enviaEmailPagamento($request, $result, 'email.confirmacao' );

            $objAluno = $aluno->newAluno($request->nome, $request->num_telefone, $request->num_cpf, $request->email);
            $dados = $pedido->newCursoPedidos($dadosPedido, $objAluno, $result);

            if (isset($dados)) {
                return response()->json(compact('result'), 200);
            }
        }
        return response()->json(compact('result'));
    }

    /**
     * Gerencia pagamento com Boleto
     * @param Request $request
     * @param Pagseguro $pagseguro
     * @param Pedidos $pedido
     * @param Alunos $aluno
     * @return \Illuminate\Http\JsonResponse
     */
    public function paymentBillet(Request $request, Pagseguro $pagseguro, Pedidos $pedido, Alunos $aluno)
    {
        $result = $pagseguro->paymentBillet($request);
        $dadosPedido = [
            'valorTotal' => $request->valor_total,
            'cursos' => $request->listaCursos,
            'paymentMode' => ($request->paymentMode == 'cartao' ? 1 : 2),
            'qtd_parcela' => 1,
            'vlr_parcela' => $request->valor_total,
        ];

        if (isset($result) && $result['success'] === true) {

            //Envia email
            $this->enviaEmailPagamento($request, $result, 'email.confirmacao' );

            $objAluno = $aluno->newAluno($request->nome, $request->num_telefone, $request->num_cpf, $request->email);
            $dados = $pedido->newCursoPedidos($dadosPedido, $objAluno, $result);
            if (isset($dados)) {
                return response()->json(compact('result'), 200);
            }
        }
        return response()->json(compact('result'));
    }

    /**
     * Metodo para envios de email
     * @param $request
     * @param $result
     * @param $tpl
     */
    protected function enviaEmailPagamento($request, $result, $tpl)
    {
        $dadosUsuario = [
            'nome' => $request->nome,
            'email' => $request->email,
            'assunto' => 'Confirmação de Pedido'
        ];

        $dados = [
            'usuario' => $dadosUsuario,
            'pagamento' => $result
        ];

        Mail::to($request->email)->send(new EnviarEmail($dados, $tpl));
    }

    /**
     * Recebe notificação do pagseguro e atualiza status do pedido.
     * @param Request $request
     * @param Pagseguro $pagseguro
     * @param Pedidos $pedidos
     * @return \Illuminate\Http\JsonResponse
     */
    public function initPsTransaction(Request $request, Pagseguro $pagseguro, Pedidos $pedidos)
    {
//        @TODO: URL DE NOTIFICAÇÃO PARA COLOCAR NO SITE PAGSEGURO https://admin.policlinicasaudeevida.com.br/api/init-ps-transaction
        if (!$request->notificationCode) {
            return response()->json(['error' => 'Código de notificação não enviado'], 404);
        }

        $response = $pagseguro->getStatusTransaction($request->notificationCode);

        $comprador = current($pagseguro->detalhesComprador($response['reference']));
        $dadosPedido = $pagseguro->detalhesPedido($response['reference']);


        $pedidos->changeStatus($dadosPedido[0]->cod_pedido, $response['status']);

//        dd($dadosPedido);
        $arrAluno = [
            'comprador' => $comprador,
            'pedidos' => $dadosPedido,
        ];

        try {
            Mail::send('email.acesso', $arrAluno, function ($message) use($arrAluno) {
                $message->to($arrAluno['comprador']->email);
                $message->subject('Dados de Acesso');
            });


        } catch (\Swift_TransportException $exception) {
            $dados = [
                'codigo' => 2,
                'msg' => 'Erro ao enviar e-mail. Tente novamente mais tarde.'
            ];
        }

        return response()->json(['success' => true]);
    }

    /**
     * Baixa o matérial do curso.
     * @param $file
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($file)
    {
        $filePath = '/'.str_replace('-','/', $file);
        return response()->download($filePath);
    }
}
