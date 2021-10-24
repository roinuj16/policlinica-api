<?php

namespace App\Http\Controllers;

use App\Model\Roles;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Lista todos os usuários cadastrado
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUser()
    {
        $users = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->select(['users.*', 'roles.name as role_name'])
            ->get();

        return view('user.listProfile',compact('users'));

    }

    /**
     * Busca uma usuário para edição e chama tela de formulário.
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editProfile($id)
    {
        $user = User::find($id);
        $roles = Roles::all();

        $result = [];
        $result['user'] = $user;
        $result['roles'] = $roles;

        return view('user.formNewUser',compact('result'));
    }

    /**
     * Formulário para cadastro e edição de usuário.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function formNewUser()
    {
        $roles = Roles::all();
        $result['roles'] = $roles;
        return view('user.formNewUser', compact('result'));
    }

    /**
     * Metodo responsável para salvar um usuário.
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveUser(Request $request, User $user)
    {
        $data = $request->all();
        $result = $user->saveUser($data);
        $notification = $result;
        return back()->with($notification);
    }

    public function deleteUser($id)
    {
        $user = User::destroy($id);
        return response()->json($user);
    }
}
