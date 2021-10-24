@extends('layouts.main')

@section('styles')
    <style>
        .note-insert, .note-view {
            display: none
        }
    </style>
@endsection

@section('content')
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <h3 class="box-title">Página Especialidades</h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class='row'>
                        <div class='col-md-6'>
                            <p class="text-danger">Campos com <span>*</span> são de preenchimento obrigatório!</p>
                        </div>
                    </div>
                    <form action="{{ url('/save-especialidades') }}" method="post" id="fomEspecialidades" enctype="multipart/form-data">
                        <input type="hidden" value="{{csrf_token()}}" name="_token" />
                        <input type="hidden" value="{{ $especialidades->id or ''}}" name="id" />
                        <input type="hidden" value="{{ $especialidades->user_id or ''}}" name="user_id" />
                        <div class='row'>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class="required">Nome</label>
                                    <input class="form-control obrigatorio js-nome" id="nome" name="nome" type="text"
                                           value="{{$especialidades->nome or ''}}"/>
                                </div>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class="required">Conteúdo</label>
                                    <p class="text-danger countWord" style="display: none;"><strong>Atenção!</strong> Você atingiu o limite máximo de caracter.</p>
                                    <textarea rows="6" class="form-control js-conteudo" name="conteudo" >{{ $especialidades->conteudo or '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <input type='file' class="js-image" id="primaryImage" name="image" accept="image/*" />
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <img class="thumbnail" width="304" height="236" src="{{ $especialidades->img_path or '' }}" alt="">
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <button name="save_continue" class="btn btn-primary save_continue save_form">Salvar</button>
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
    <script src="{{url("js/helper/contador.js")}}"></script>
    <script src="{{url("js/especialidades/cad-especialidades.js")}}"></script>
@endsection
