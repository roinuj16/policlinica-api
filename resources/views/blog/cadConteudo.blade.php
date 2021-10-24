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
                <h3 class="box-title">Cadastro de Conteúdo Blog</h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class='row'>
                        <div class='col-md-6'>
                            <p class="text-danger">Campos com <span>*</span> são de preenchimento obrigatório!</p>
                        </div>
                    </div>
                    <form action="{{ url('/save-conteudo') }}" method="post" id="fomInfo" enctype="multipart/form-data">
                        <input type="hidden" value="{{csrf_token()}}" name="_token" />
                        <input type="hidden" value="{{ $conteudo->id or ''}}" name="id" />
                        <input type="hidden" value="{{ $conteudo->user_id or ''}}" name="user_id" />
                        <div class='row'>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class="required">Titulo</label>
                                    <input class="form-control js_titulo" id="" name="titulo" type="text"
                                           value="{{ $conteudo->titulo or ''}}" maxlength="100" placeholder="Titulo"/>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class="form-group">
                                    <label>Status:</label>
                                    <select class="form-control" name="status">
                                        @if (isset($conteudo->status))
                                            <option value="1" {{$conteudo->status == 1 ? 'selected' : ''}}>Ativo</option>
                                            <option value="0" {{$conteudo->status == 0 ? 'selected' : ''}}>Inativo</option>
                                        @else
                                            <option value="1">Ativo</option>
                                            <option value="0">Inativo</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label class="required">Conteúdo</label>
                                    <textarea class="form-control js-desc01" required name="conteudo"  id="summernote">
                                        {{ $conteudo->conteudo or '' }}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <input type='file' class="" id="primaryImage" name="image" accept="image/*" />
                                </div>
                            </div>
                        </div>
                        @if (isset($conteudo->img_path) && count($conteudo->img_path) >= 0)
                            <div class='row'>
                                <div class="col-xs-6 col-md-3">
                                    <img class="thumbnail" width="304" height="236" src="{{ $conteudo->img_path or '' }}"
                                         alt="">
                                </div>
                            </div>
                        @endif
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <button type="submit" class="btn btn-primary js-submit">Salvar</button>
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
    <script src="{{url("js/blog/cad-conteudo.js")}}"></script>
@endsection
