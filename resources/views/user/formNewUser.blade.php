@extends('layouts.main')

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <h3 class="box-title">Cadastro de Usuário</h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class='row'>
                        <div class='col-md-6'>
                            <p class="text-danger">Campos com <span>*</span> são de preenchimento obrigatório!</p>
                        </div>
                    </div>
                    <form class="form-horizontal" action="{{ url('/save-user') }}" method="post" id="fomUser">
                        <input type="hidden" value="{{csrf_token()}}" name="_token" />
                        <input type="hidden" value="{{ $result['user']->id or ''}}" name="id" />

                        <div class='form-group'>
                            <label class="col-md-4 control-label required">Nome</label>
                            <div class="col-md-6">
                                <input class="form-control js-nome" maxlength="100" required id="name" name="name"
                                       type="text" value="{{$result['user']->name or ''}}"/>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label class="col-md-4 control-label required">Email</label>
                            <div class="col-md-6">
                                <input class="form-control js-email" required id="email" name="email"
                                       type="email" value="{{$result['user']->email or ''}}"/>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label class="col-md-4 control-label">Senha</label>
                            <div class="col-md-6">
                                <input class="form-control js-password" id="password" name="password" type="password" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Senha</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control js-password-confirm" name="password_confirmation">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="perfil" class="col-md-4 control-label">Perfil</label>
                            <div class="col-md-6">
                                <select class="form-control js-perfil" id="perfil" name="role">
                                    <option value="0">Selecione</option>
                                    @foreach ($result['roles'] as $role)
                                        <option
                                            value="{{ $role->id }}"
                                            {{ array_key_exists('user', $result) && $result['user']->role_id === $role->id ? 'selected' : ''}}
                                        >
                                            {{ $role->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary js-submit">
                                    Salvar
                                </button>
                                <input type="button" class="btn btn-danger js-cancelar" value="Cancelar" >
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @include('helper.messages');
    <script src="{{url("js/helper/editor.js")}}"></script>
    <script src="{{url("js/user/cad-user.js")}}"></script>
@endsection
