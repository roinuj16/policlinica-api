@extends('layouts.main')

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <h3 class="box-title">Cadastro de Convênio</h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class='row'>
                        <div class='col-md-6'>
                            <p class="text-danger">Campos com <span>*</span> são de preenchimento obrigatório!</p>
                        </div>
                    </div>
                    <form action="{{ url('/convenios') }}" method="post" id="fomConvenio" enctype="multipart/form-data">
                        <input type="hidden" value="{{csrf_token()}}" name="_token" />
                        <input type="hidden" value="{{ $convenio->id or ''}}" name="id" />
                        <div class='row'>
                            <div class='col-md-8'>
                                <div class='form-group'>
                                    <label class="required">Nome</label>
                                    <input class="form-control js-nome" maxlength="100" required id="nome" name="nome" type="text"
                                           value="{{$convenio->nome or ''}}"/>
                                </div>
                            </div>
                            <div class='col-md-4'>
                                <div class='form-group'>
                                    <label class="required">Status do Curso</label>
                                    <select class="form-control js-status" name="status">
                                        <option value="0">Selecione</option>
                                        <option value="1" {{ isset($convenio->status) && ($convenio->status === 1) ? 'selected' : '' }}>Ativo</option>
                                        <option value="2" {{ isset($convenio->status) && ($convenio->status === 2) ? 'selected' : '' }}>Inativo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class="required">Logo do Convênio</label>
                                    <input type='file' class="js-image" id="primaryImage" name="path_image" accept="image/*" />
                                </div>
                            </div>
                        </div>
                        @if (isset($convenio->path_image) && count($convenio->path_image) >= 0)
                            <div class='row'>
                                <div class="col-xs-6 col-md-3">
                                    <img class="thumbnail" width="304" height="236" src="{{ $convenio->path_image or '' }}"
                                         alt="">
                                </div>
                            </div>
                        @endif
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <button name="save_continue" class="btn btn-primary js-submit">Salvar</button>
                                    <input type="button" class="btn btn-danger js-cancelar" value="Voltar" >
                                </div>
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
    <script src="{{url("js/convenio/cad-convenio.js")}}"></script>
@endsection
