@extends('layouts.main')

@section('styles')
    <style>
        .input-group-addon {
            padding: 6px 12px !important;
            font-size: 14px !important;
            font-weight: 400 !important;
            line-height: 1 !important;
            color: #555 !important;
            text-align: center !important;
            background-color: #eee !important;
            border: 1px solid #ccc !important;
            border-radius: 4px 0 0 4px !important;
        }

    </style>
@endsection

@section('content')
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <h3 class="box-title">Cadastro de Cursos</h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class='row'>
                        <div class='col-md-6'>
                            <p class="text-danger">Campos com <span>*</span> são de preenchimento obrigatório!</p>
                        </div>
                    </div>
                    <form action="{{ url('/save-cursos') }}" method="post" id="fomCursos" enctype="multipart/form-data">
                        <input type="hidden" value="{{csrf_token()}}" name="_token" />
                        <input type="hidden" value="{{ $curso->id or ''}}" name="id" />
                        <div class='row'>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class="required">Nome</label>
                                    <input class="form-control js-nome" maxlength="100" required id="nome" name="nome" type="text"
                                           value="{{$curso->nome or ''}}"/>
                                </div>
                            </div>

                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class="required">Tipo do Curso</label>
                                    <select class="form-control js-tipo-curso" name="tipo_curso">
                                        <option value="0">Selecione</option>
                                        <option value="1" {{ isset($curso->tipo_curso) && ($curso->tipo_curso === 1) ? 'selected' : '' }}>EAD</option>
                                        <option value="2" {{ isset($curso->tipo_curso) &&($curso->tipo_curso === 2) ? 'selected' : '' }}>Semipresencial</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-3'>
                                <div class='form-group'>
                                    <label class="required">Valor</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text"
                                               class="form-control js-valor obrigatorio"
                                               id="valor"
                                               name="valor"
                                               value="{{ $curso->valor or '' }}"
                                               maxlength="10"
                                               data-thousands="."
                                               data-decimal=",">
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='form-group'>
                                    <label class="required">Status do Curso</label>
                                    <select class="form-control js-status" name="status">
                                        <option value="0">Selecione</option>
                                        <option value="1" {{ isset($curso->status) && ($curso->status === 1) ? 'selected' : '' }}>Ativo</option>
                                        <option value="2" {{ isset($curso->status) && ($curso->status === 2) ? 'selected' : '' }}>Inativo</option>
                                    </select>
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class="required">Url Vídeo</label>
                                    <input class="form-control js-url-video" maxlength="100" required id="url-video" name="url_video" type="text"
                                           value="{{$curso->url_video or ''}}"/>
                                </div>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label class="required">Descrição</label>
                                    <textarea class="form-control js-desc01 obrigatorio" required name="descricao" maxlength="191"  id="summernote">
                                        {{ $curso->descricao or '' }}
                                    </textarea>
                                </div>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class="required">Imagem Curso</label>
                                    <input type='file' class="js-image" id="primaryImage" name="path_image" accept="image/*" />
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <div class='form-group'>
                                    <label class="required">Matérial do Curso</label>
                                    <input type='file' class="js-file" id="secondImage" name="path_file" accept="application/pdf" />
                                </div>
                            </div>

                        </div>
                        @if (isset($curso->path_image) && count($curso->path_image) >= 0)
                            <div class='row'>
                                <div class="col-xs-6 col-md-3">
                                    <img class="thumbnail" width="304" height="236" src="{{ $curso->path_image or '' }}"
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
    <script src="{{url("js/helper/editor.js")}}"></script>
    <script src="{{url("js/cursos/cad-cursos.js")}}"></script>
@endsection
