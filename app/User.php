<?php

namespace App;

use App\Model\Blog;
use App\Model\Roles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blog()
    {
        return $this->hasMany(Blog::class);
    }

    /**
     * @param $data
     * @return array|string
     */
    public function saveUser($data)
    {
        try {
            if ($this->validatePassWord($data['password'], $data['password_confirmation'])) {
                if (is_null($data['id'])) {
                    $email = $this->where('email', $data['email'])->first();
                    if($email != null && count($email) > 0 ) {
                        return [
                            'error'      => true,
                            'message'    => 'E-mail já cadastrado',
                            'alert-type' => 'error'
                        ];
                    }

                    User::create([
                        'name'     => $data['name'],
                        'email'    => $data['email'],
                        'password' => bcrypt($data['password']),
                        'role_id'  => $data['role'],
                    ]);

                    return [
                        'error' => false,
                        'message' => 'Usuário cadastrado com sucesso!',
                        'alert-type' => 'success'
                    ];

                } else {
                    $user           = $this->find($data['id']);
                    $user->name     = $data['name'];
                    $user->email    = $data['email'];
                    $user->password = bcrypt($data['password']);
                    $user->role_id  = $data['role'];
                    $user->save();

                    return [
                        'error' => false,
                        'message' => 'Usuário Alterado com sucesso!',
                        'alert-type' => 'success'
                    ];
                }
            }

            return [
                'message' => 'Senhas não confere. Favor informar senhas iguais!',
                'alert-type' => 'error'
            ];

        }catch (Exption $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Valida se password e igual a passwordConfirm
     * @param $password
     * @param $passwordConfirm
     * @return bool
     */
    private function validatePassWord($password, $passwordConfirm)
    {
        if($password === $passwordConfirm) {
            return true;
        }
        return false;
    }

    public function roles()
    {
        return $this->belongsTo(Roles::class);
    }
}
