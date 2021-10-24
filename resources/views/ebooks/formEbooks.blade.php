@extends('layouts.main')

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <h3 class="box-title">Cadastro de Ebooks</h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class='row'>
                        <div class='col-md-6'>
                            <p class="text-danger">Campos com <span>*</span> são de preenchimento obrigatório!</p>
                        </div>
                    </div>
                    <form action="{{ url('/save-ebook') }}" method="post" id="fomEbooks" enctype="multipart/form-data">
                        <input type="hidden" value="{{csrf_token()}}" name="_token" />
                        <input type="hidden" value="{{ $ebook->id or ''}}" name="id" />
                        <div class='row'>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class="required">Titulo</label>
                                    <input class="form-control js-titulo" maxlength="100" required id="nome" name="nome" type="text"
                                           value="{{$ebook->nome or ''}}"/>
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class="required">Status</label>
                                    <select class="form-control js-status" name="status">
                                        <option value="1" {{ isset($ebook->status) && ($ebook->status === 1) ? 'selected' : '' }}>Ativo</option>
                                        <option value="2" {{ isset($ebook->status) && ($ebook->status === 2) ? 'selected' : '' }}>Inativo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class="required">Url Vídeo</label>
                                    <input class="form-control js-url-video" maxlength="100" required id="url-video" name="url_video" type="text"
                                           value="{{$ebook->url_video or ''}}"/>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label class="required">Descrição</label>
                                    <textarea class="form-control js-desc01 obrigatorio" required name="descricao" maxlength="191"  id="summernote">
                                        {{ $ebook->descricao or '' }}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class="required">Imagem E-book</label>
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

                        <div class='row'>
                            <div class="col-xs-6 col-md-3">
                                @if (isset($ebook->path_image) && count($ebook->path_image) >= 0)
                                    <img class="thumbnail" width="304" height="236" src="{{ $ebook->path_image or '' }}"
                                         alt="">
                                @endif
                            </div>
                        </div>
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
    <script src="{{url("js/ebooks/cad-ebooks.js")}}"></script>
@endsection
