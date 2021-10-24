@extends('layouts.main')

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <h3 class="box-title">Dados do Paciente</h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <form class="form-horizontal">


                        <div class='form-group'>
                            <label class="col-md-4 control-label required">Nome</label>
                            <div class="col-md-4">
                                <input class="form-control js-nome" maxlength="100" required id="nome" name="nome"
                                       type="text" value="{{$paciente->nome or ''}}" disabled/>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label class="col-md-4 control-label required">Email</label>
                            <div class="col-md-4">
                                <input class="form-control js-email" required id="email" name="email"
                                       type="email" value="{{$paciente->email or ''}}" disabled/>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class="col-md-4 control-label required">Data de Nascimento</label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" value="{{$paciente->dt_nascimento or ''}}" disabled/>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class="col-md-4 control-label required">Sexo</label>
                            <div class="col-md-4">
                                @if ($paciente->sexo == 1)
                                    <input class="form-control" type="text" value="Masculino" disabled/>
                                @else
                                    <input class="form-control" type="text" value="Feminino" disabled/>
                                @endif

                            </div>
                        </div>

                        <div class='form-group'>
                            <label class="col-md-4 control-label required">Telefone</label>
                            <div class="col-md-4">
                                <input class="form-control js-telefone" required id="telefone" name="telefone"
                                       type="text" value="{{$paciente->telefone or ''}}" disabled/>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label class="col-md-4 control-label required">Local da Consulta</label>
                            <div class="col-md-4">
                                @if ($paciente->local_cadastro == 1)
                                    <input class="form-control" required id="telefone" name="telefone"
                                           type="text" value="Policlínica" disabled/>
                                @else
                                    <input class="form-control js-telefone" required id="telefone" name="telefone"
                                           type="text" value="Santa Maria" disabled/>
                                @endif

                            </div>
                        </div>

                        <div class="box-header">
                            <h3 class="box-title">Dados do Endereço</h3>
                        </div>

                        <div class='form-group'>
                            <label class="col-md-4 control-label required">Endereço</label>
                            <div class="col-md-4">
                                <input class="form-control" required id="endereco" name="endereco"
                                       type="text" value="{{$paciente->endereco or ''}}" disabled/>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class="col-md-4 control-label required">Bairro</label>
                            <div class="col-md-3">
                                <input class="form-control" required id="bairro" name="bairro"
                                       type="text" value="{{$paciente->bairro or ''}}" disabled/>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class="col-md-4 control-label required">Cidade</label>
                            <div class="col-md-3">
                                <input class="form-control" required id="cidade" name="cidade"
                                       type="text" value="{{$paciente->cidade or ''}}" disabled/>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label class="col-md-4 control-label required">Estado</label>
                            <div class="col-md-2">
                                <input class="form-control" required id="estado" name="estado"
                                       type="text" value="{{$paciente->estado or ''}}" disabled/>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label class="col-md-4 control-label required">CEP</label>
                            <div class="col-md-2">
                                <input class="form-control" required id="cep" name="cep"
                                       type="text" value="{{$paciente->cep or ''}}" disabled/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <input type="button" class="btn btn-danger js-voltar" value="Voltar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $('.js-voltar').click((e) => {
            e.preventDefault();
            window.location.href = '/pacientes';
        })
    </script>
@endsection
