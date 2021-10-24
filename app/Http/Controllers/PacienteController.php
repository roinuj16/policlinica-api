<?php

namespace App\Http\Controllers;


use App\Model\Pacientes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PacienteController extends MainController
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allPacientes()
    {
        $pacientes = Pacientes::orderBy('id', 'desc')->get();
        return view('pacientes.allPacientes',compact('pacientes'));
    }

    public function editPaciente($id)
    {
        $paciente = Pacientes::find($id);
        return view('pacientes.formPacientes', compact('paciente'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function formPacientes()
    {
        return view('pacientes.formPacientes');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function savePacientes(Request $request)
    {
        $data     = $request->all();
        $paciente = new Pacientes();
        $result   = $paciente->savePacientes($data);

        if ($result) {
            $notification = array(
                'message'    => 'Paciente cadastrado com sucesso!',
                'alert-type' => 'success'
            );

            //1 = Salvar e sair
            if($data['acao'] == 1) {
                return redirect('/pacientes')->with($notification);
            }

            //2 = Salvar e cadastrar novo
            if($data['acao'] == 2) {
                return redirect('/cad-paciente')->with($notification);
            }
        }
    }

    public function showPaciente($id)
    {
        $paciente = Pacientes::find($id);
        return view('pacientes.showPaciente', compact('paciente'));
    }

    public function deletePaciente($id)
    {
        $paciente = Pacientes::destroy($id);
        return response()->json($paciente);
    }

    /**
     * @return StreamedResponse
     */
    public function export()
    {
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=pacientes.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $tableHeaders = [
            'Nome',
            'Email',
            'Telefone',
            'Data de Nascimento',
            'Sexo',
            'Local da Consulta',
            'Endereço',
            'Bairro',
            'Cidade',
            'Estado',
            'CEP'
        ];
        $pacientes = Pacientes::all();

        $pacientes->map(function ($item, $key) {
            if ($item->local_cadastro === 1) {
                $item->local_cadastro = 'Policlínica';
            }
            if ($item->local_cadastro === 2) {
                $item->local_cadastro = 'Santa Maria';
            }

            if ($item->sexo === 1) {
                $item->sexo = 'Masculino';
            }
            if ($item->sexo === 2) {
                $item->sexo = 'Feminino';
            }
        });

        $callback = function () use ($pacientes, $tableHeaders) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $tableHeaders,';');

            foreach ($pacientes as $paciente) {
                fputcsv($file, [
                    $paciente['nome'],
                    $paciente['email'],
                    $paciente['telefone'],
                    $paciente['dt_nascimento'],
                    $paciente['sexo'],
                    $paciente['local_cadastro'],
                    $paciente['endereco'],
                    $paciente['bairro'],
                    $paciente['cidade'],
                    $paciente['estado'],
                    $paciente['cep']
                ], ';');
            }
            fclose($file);
        };

         return (new StreamedResponse($callback, 200, $headers))->sendContent();
    }
}
