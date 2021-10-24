@extends('layouts.main')

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <h3 class="box-title">Detalhes da página principal</h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class='row'>
                        <div class='col-md-6'>
                            <p class="text-danger">Campos com <span>*</span> são de preenchimento obrigatório!</p>
                        </div>
                    </div>
                    <form action="{{ url('/updateInfos') }}" method="post" id="fomInfo">
                        <input type="hidden" value="{{csrf_token()}}" name="_token" />
                            <input type="hidden" value="{{$dados->id}}" name="id" />
                            <div class='row'>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class="required">Titulo</label>
                                        <input class="form-control" required id="titulo" name="titulo" type="text"
                                               value="{{$dados->titulo}}"/>
                                        <div class="errorTxt"></div>
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class="required">Descrição</label>
                                        <textarea class="form-control" required name="descricao" rows="5"
                                                  id="js-descricao">{{ $dados->descricao }}</textarea>


                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <label class="required">icone 01</label>
                                        <input class="form-control" id="" name="classe_css_1" required type="text"
                                               value="{{ $dados->classe_css_1 }}" maxlength="20" placeholder="Classe do icone"/>
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <label class="required">icone 02</label>
                                        <input class="form-control" id="" required name="classe_css_2" type="text"
                                               value="{{ $dados->classe_css_2 }}" maxlength="20" placeholder="Classe do icone"/>
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <label class="required">icone 03</label>
                                        <input class="form-control" id=""required name="classe_css_3" type="text"
                                               value="{{ $dados->classe_css_3 }}" maxlength="20" placeholder="Classe do icone"/>
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <label class="required">icone 04</label>
                                        <input class="form-control" id="" required name="classe_css_4" type="text"
                                               value="{{ $dados->classe_css_4 }}" maxlength="20" placeholder="Classe do icone"/>
                                    </div>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <label class="required">Titulo 01</label>
                                        <input class="form-control" id="" required name="label_1" type="text"
                                               value="{{ $dados->label_1 }}" maxlength="25" placeholder="Classe do icone"/>
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <label class="required">Titulo 02</label>
                                        <input class="form-control" id="" required name="label_2" type="text"
                                               value="{{ $dados->label_2 }}" maxlength="25" placeholder="Classe do icone"/>
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <label class="required">Titulo 03</label>
                                        <input class="form-control" id="" required name="label_3" type="text"
                                               value="{{ $dados->label_3 }}" maxlength="25" placeholder="Classe do icone"/>
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <label class="required">Titulo 04</label>
                                        <input class="form-control" id="" required name="label_4" type="text"
                                               value="{{ $dados->label_4 }}" maxlength="25" placeholder="Classe do icone"/>
                                    </div>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <label class="required">Descrição 1</label>
                                        <textarea class="form-control js-desc01" id="js-desc01" required name="info_label_1" rows="5"
                                                  id="">{{ $dados->info_label_1 }}</textarea>
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <label class="required">Descrição 2</label>
                                        <textarea class="form-control js-desc02" required name="info_label_2" rows="5"
                                                  id="">{{ $dados->info_label_2 }}</textarea>
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <label class="required">Descrição 3</label>
                                        <textarea class="form-control js-desc03" required name="info_label_3" rows="5"
                                                  id="">{{ $dados->info_label_3 }}</textarea>
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <label class="required">Descrição 4</label>
                                        <textarea class="form-control js-desc04" required name="info_label_4" rows="5"
                                                  id="">{{ $dados->info_label_4 }}</textarea>
                                    </div>
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
<script src="{{url("js/infoHome/infoHome.js")}}"></script>
@endsection
