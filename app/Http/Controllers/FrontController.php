<?php

namespace App\Http\Controllers;

use App\Model\Alunos;
use App\Model\Banner;
use App\Model\Blog;
use App\Model\Convenio;
use App\Model\Cursos;
use App\Model\Ebook;
use App\Model\Especialidades;
use App\Model\InfoHome;
use App\Model\Logo;
use App\Model\QuemSomos;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarEmail;

class FrontController extends Controller
{
    /**
     * Carrega logo do Site
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiLogo()
    {
        $dados = Logo::first();
        return response()->json(compact('dados'));
    }

    /**
     * Lista todas as especialidades
     * @param Especialidades $especialidades
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiEspecialidades(Especialidades $especialidades)
    {
        $dados = Especialidades::all();
        return response()->json(compact('dados'));
    }

    /**
     * Carrega dados da pagina Especialidades
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiEspecialidadesDetalhes($id)
    {
        $dados = Especialidades::find($id);
        return response()->json(compact('dados'));
    }

    /**
     * Carrega dados da pagina Informativo
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiPosts()
    {
        $dados = Blog::orderBy('id', 'desc')->with('user')->get();
        return response()->json(compact('dados'));
    }

    /**
     * Carrega os posts mais recentes. Os 4 últimos
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiPostsRecentes()
    {
        $dados = Blog::orderBy('id', 'desc')->with('user')->take(4)->get();
        return response()->json(compact('dados'));
    }

    /**
     * Carrega detalhes de um post
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiPostsDetalhes($id)
    {
        $posts = Db::table('blogs')
            ->join('users', 'users.id', '=', 'blogs.user_id')
            ->where('blogs.id', '=', $id)->get();
        return response()->json(compact('posts'));
    }

    /**
     * Carrega dados da pagina Quem somos
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiQuemSomos()
    {
        $dados = DB::table('quem_somos')->first();
        return response()->json(compact('dados'));
    }

    /**
     * Retorna os cursos ativos em ordem decrescente.
     * @param $tipo
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiCursos($tipo)
    {
        //Carrega todos os cursos.
        if($tipo == 3) {
            $dados = DB::table('cursos')->select(
                'id',
                'nome',
                'descricao',
                'valor',
                'status',
                'tipo_curso',
                'url_video',
                'path_image')
                ->whereRaw("(cursos.status = 1 )")
                ->orderByRaw('id DESC')
                ->get();
            return response()->json(compact('dados'));
        }

        $dados = DB::table('cursos')->select(
            'id',
            'nome',
            'descricao',
            'valor',
            'status',
            'tipo_curso',
            'url_video',
            'path_image')
            ->whereRaw("(cursos.tipo_curso = " . $tipo . ") AND (cursos.status = 1 )")
            ->orderByRaw('id DESC')
            ->get();
        return response()->json(compact('dados'));
    }

    /**
     * Carrega dados da página de E-Books
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiEbook()
    {
        $dados = Ebook::orderBy('id', 'desc')
            ->whereRaw('ebooks.status = 1')->get();
        return response()->json(compact('dados'));
    }

    /**
     * @param Request $request
     * @param Alunos $alunos
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiSendEbook(Request $request, Alunos $alunos)
    {
        $dados = [
            'codigo' => 1,
            'msg' => 'Enviamos o E-Book para o E-mail informado.'
        ];
        $ebook = Ebook::find($request->idEbook);

        $dadosEnvio = [
            'nome' => $request->nome,
            'email' => $request->email,
            'nome_ebook' => $ebook->nome,
            'path_file' => $ebook->path_file,
        ];

        try {
             Mail::send('email.ebook', $dadosEnvio, function ($message) use($dadosEnvio) {
                 $message->to($dadosEnvio['email']);
                 $message->subject('Dados do E-Book');
                 $message->attach($dadosEnvio['path_file'], ['as' => $dadosEnvio['nome_ebook'], 'mime' => 'application/pdf']);
             });

             //Atualiza o tabela ebooks para incrementar o contador de downloads
            $ebook->num_download = ++$ebook->num_download;
            $ebook->save();

            //Cadastra Quem esta fazendo o download se não estiver cadastrado
            $alunos->saveDownloadEbook($request->nome, $request->email);

        } catch (\Swift_TransportException $exception) {
            $dados = [
                'codigo' => 2,
                'msg' => 'Erro ao enviar e-mail. Tente novamente mais tarde.'
            ];
        }
        return response()->json(compact('dados'));
    }

    /**
     * Carrega dados da página de Convenios
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiConvenios()
    {
        $dados = Convenio::orderBy('id', 'desc')
            ->whereRaw('convenios.status = 1 ')->get();

        return response()->json(compact('dados'));
    }

    /**
     * Gerencia página de contato
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiContato(Request $request)
    {
        $dados = [
            'codigo' => 1,
            'msg' => 'Email enviado com sucesso...'
        ];

        try {
            Mail::to('contato.policlinicasaude@gmail.com')->send(new EnviarEmail($request, 'email.contato'));

        } catch (\Swift_TransportException $exception) {
            $dados = [
                'codigo' => 2,
                'msg' => 'Erro ao enviar e-mail. Tente novamente mais tarde.'
            ];
        }
        return response()->json(compact('dados'));
    }

    public function apiBanner()
    {
        $dados = Banner::orderBy('id', 'desc')
            ->whereRaw('banners.status = 1 ')->get();
        return response()->json(compact('dados'));
    }
}
