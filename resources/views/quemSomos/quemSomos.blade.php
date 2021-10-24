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
                <h3 class="box-title">Gerenciar página Quem Somos</h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class='row'>
                        <div class='col-md-6'>
                            <p class="text-danger">Campos com <span>*</span> são de preenchimento obrigatório!</p>
                        </div>
                    </div>
                    <form action="{{ url('/save-quem-somos') }}" method="post" id="fomInfo" enctype="multipart/form-data">
                        <input type="hidden" value="{{csrf_token()}}" name="_token" />
                        <input type="hidden" value="{{ $conteudo->id or '' }}" name="id" />

                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label class="required">Titulo</label>
                                    <input class="form-control" required id="titulo" name="titulo" type="text" value="{{ $conteudo->titulo or '' }}"/>
                                    <div class="errorTxt"></div>
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
                            <div class="col-xs-6 col-md-3">
                                    <img class="thumbnail" width="304" height="236" src="{{ $conteudo->img_path or '' }}" alt="">
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
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
@endsection
