@extends('layouts.main')

@section('styles')
@endsection

@section('content')
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <h3 class="box-title">Cadastro de Pacientes</h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class='row'>
                        <div class='col-md-6'>
                            <p class="text-danger">Campos com <span>*</span> são de preenchimento obrigatório!</p>
                        </div>
                    </div>
                    <form class="form-horizontal" action="{{ url('/save-paciente') }}" method="post" id="formPacientes">
                        <input type="hidden" value="{{csrf_token()}}" name="_token" />
                        <input type="hidden" value="{{ $paciente->id or ''}}" name="id" />
                        <input type="hidden" value="" name="acao" class="js-acao" />

                        <div class='form-group'>
                            <label class="col-md-4 control-label required">Nome</label>
                            <div class="col-md-4">
                                <input class="form-control js-nome" maxlength="100" required id="nome" name="nome" maxlength="100"
                                       type="text" value="{{$paciente->nome or ''}}"/>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label class="col-md-4 control-label required">Email</label>
                            <div class="col-md-4">
                                <input class="form-control js-email" required id="email" name="email" maxlength="100"
                                       type="email" value="{{$paciente->email or ''}}"/>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class="col-md-4 control-label required">Data Nacimento</label>
                            <div class="col-md-4">
                                <input class="form-control js-dt-nascimento" required id="dt_nascimento" name="dt_nascimento" maxlength="100"
                                       type="text" value="{{$paciente->dt_nascimento or ''}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="perfil" class="col-md-4 control-label required">Sexo</label>
                            <div class="col-md-4">
                                <select class="form-control js-sexo" id="sexo" name="sexo">
                                    <option value="0">Selecione</option>
                                    <option value="1" {{ isset($paciente->sexo) && ($paciente->sexo == 1) ? 'selected' : ''}}>Masculino</option>
                                    <option value="2" {{ isset($paciente->sexo) && ($paciente->sexo == 2) ? 'selected' : ''}}>Feminino</option>
                                </select>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class="col-md-4 control-label required">Telefone</label>
                            <div class="col-md-4">
                                <input class="form-control js-telefone" required id="telefone" name="telefone"
                                       type="text" value="{{$paciente->telefone or ''}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="perfil" class="col-md-4 control-label required">Local da Consulta</label>
                            <div class="col-md-4">
                                <select class="form-control js-local-cadastro" id="local_cadastro" name="local_cadastro">
                                    <option value="0">Selecione</option>
                                    <option value="1" {{ isset($paciente->local_cadastro) && ($paciente->local_cadastro == 1) ? 'selected' : ''}}>Policlínica</option>
                                    <option value="2" {{ isset($paciente->local_cadastro) && ($paciente->local_cadastro == 2) ? 'selected' : ''}}>Santa Maria</option>
                                </select>
                            </div>
                        </div>

                        <div class="box-header">
                            <h3 class="box-title">Dados do Endereço</h3>
                        </div>

                        <div class='form-group'>
                            <label class="col-md-4 control-label required">Endereço</label>
                            <div class="col-md-4">
                                <input class="form-control js-endereco" required id="endereco" name="endereco" maxlength="150"
                                       type="text" value="{{$paciente->endereco or ''}}"/>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class="col-md-4 control-label required">Bairro</label>
                            <div class="col-md-3">
                                <input class="form-control js-bairro" required id="bairro" name="bairro" maxlength="100"
                                       type="text" value="{{$paciente->bairro or ''}}"/>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class="col-md-4 control-label required">Cidade</label>
                            <div class="col-md-3">
                                <input class="form-control js-cidade" required id="cidade" name="cidade" maxlength="100"
                                       type="text" value="{{$paciente->cidade or ''}}"/>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label class="col-md-4 control-label required">Estado</label>
                            <div class="col-md-2">
                                <input class="form-control js-estado" required id="estado" name="estado" maxlength="2"
                                       type="text" value="{{$paciente->estado or ''}}"/>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label class="col-md-4 control-label">CEP</label>
                            <div class="col-md-2">
                                <input class="form-control" required id="cep" name="cep"
                                       type="text" value="{{$paciente->cep or ''}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary js-submit-sair">
                                    Salvar e Sair
                                </button>
                                <button type="submit" class="btn btn-primary js-submit-novo">
                                    Salvar e Cadastrar Novo
                                </button>
                                <input type="button" class="btn btn-danger js-cancelar-paciente" value="Cancelar" >
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
    <script src="{{url("js/pacientes/cad-pacientes.js")}}"></script>
@endsection
