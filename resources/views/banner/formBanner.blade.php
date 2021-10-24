@extends('layouts.main')

@section('styles')


@endsection

@section('content')

    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <h3 class="box-title">Banner</h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class='row'>
                        <div class='col-md-6'>
                            <p class="text-danger">Campos com <span>*</span> são de preenchimento obrigatório!</p>
                        </div>
                    </div>
                    <form action="{{ url('/save-banner') }}" method="post" id="" enctype="multipart/form-data">
                        <input type="hidden" value="{{csrf_token()}}" name="_token" />

                        <div class='row'>
                            <div class="col-xs-6 col-md-4">
                                <img class="thumbnail" width="254" height="136" src="{{ $images[1]->path_image or '' }}" alt="">
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <img class="thumbnail" width="254" height="136" src="{{ $images[2]->path_image or '' }}" alt="">
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <img class="thumbnail" width="254" height="136" src="{{ $images[3]->path_image or '' }}" alt="">
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-4'>
                                <div class='form-group'>
                                    <label>Imagem 01</label>
                                    <input type='file' class="js-image_01" id="path_image_01" name="path_image[0][file]" accept="image/*" />
                                    <input type="hidden" name="path_image[0][id]" value="{{ $images[1]->id or '' }}"/>
                                    <input type="hidden" name="path_image[0][nome]" value="img_1"/>
                                    <br />
                                    @if(array_key_exists(1, $images))
                                        @if($images[1]->status == 1)
                                            <label>Status: <span class="label label-success">Ativo</span></label><br />
                                            <a class="btn btn-xs btn-warning js-btn " data-id="{{ $images[1]->id or '' }}" data-status="{{ $images[1]->status or ''  }}">
                                            <span class="glyphicon glyphicon-eye-close"></span>
                                                Inativar
                                            </a>
                                        @else
                                            <label>Status: <span class="label label-warning">Inativo</span></label><br />
                                            <a class="btn btn-xs btn-success js-btn" data-id="{{ $images[1]->id or '' }}" data-status="{{ $images[1]->status or ''  }}">
                                            <span class="glyphicon glyphicon-eye-open"></span>
                                                Ativar
                                            </a>
                                        @endif
                                    @endif
                                    <hr>
                                </div>
                            </div>
                            <div class='col-md-4'>
                                <div class='form-group'>
                                    <label class="required">Imagem 02</label>
                                    <input type='file' class="js-image_02" id="path_image_02" name="path_image[1][file]" accept="image/*" />
                                    <input type="hidden" name="path_image[1][id]" value="{{ $images[2]->id or '' }}"/>
                                    <input type="hidden" name="path_image[1][nome]" value="img_2"/>
                                    <br />
                                    @if(array_key_exists(2, $images))
                                        @if($images[2]->status and $images[2]->status == 1)
                                            <label>Status: <span class="label label-success">Ativo</span></label><br />
                                            <a class="btn btn-xs btn-warning js-btn " data-id="{{ $images[2]->id or '' }}" data-status="{{ $images[1]->status or ''}}">
                                                <span class="glyphicon glyphicon-eye-close"></span>
                                                Inativar
                                            </a>
                                        @elseif($images[2]->status and $images[2]->status == 2)
                                            <label>Status: <span class="label label-warning">Inativo</span></label><br />
                                            <a class="btn btn-xs btn-success js-btn" data-id="{{ $images[2]->id or '' }}" data-status="{{ $images[1]->status or ''}}">
                                                <span class="glyphicon glyphicon-eye-open"></span>
                                                Ativar
                                            </a>
                                        @endif
                                    @endif

                                    <hr>
                                </div>
                            </div>
                            <div class='col-md-4'>
                                <div class='form-group'>
                                    <label class="required">Imagem 03</label>
                                    <input type='file' class="js-image_03" id="path_image_03" name="path_image[2][file]" accept="image/*" />
                                    <input type="hidden" name="path_image[2][id]" value="{{ $images[3]->id or '' }}"/>
                                    <input type="hidden" name="path_image[2][nome]" value="img_3"/>
                                    <br />
                                    @if(array_key_exists(3, $images))
                                        @if($images[3]->status == 1)
                                            <label>Status: <span class="label label-success">Ativo</span></label><br />
                                            <a class="btn btn-xs btn-warning js-btn " data-id="{{ $images[3]->id or '' }}" data-status="{{ $images[1]->status or ''  }}">
                                            <span class="glyphicon glyphicon-eye-close"></span>
                                                Inativar
                                            </a>
                                        @else
                                            <label>Status: <span class="label label-warning">Inativo</span></label><br />
                                            <a class="btn btn-xs btn-success js-btn" data-id="{{ $images[3]->id or '' }}" data-status="{{ $images[1]->status or ''  }}">
                                            <span class="glyphicon glyphicon-eye-open"></span>
                                                Ativar
                                            </a>
                                        @endif
                                    @endif
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class='row'>
                            <div class="col-xs-6 col-md-4">
                                <img class="thumbnail" width="254" height="136" src="{{ $images[4]->path_image or '' }}" alt="">
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <img class="thumbnail" width="254" height="136" src="{{ $images[5]->path_image or '' }}" alt="">
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <img class="thumbnail" width="254" height="136" src="{{ $images[6]->path_image or '' }}" alt="">
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-4'>
                                <div class='form-group'>
                                    <label class="required">Imagem 04</label>
                                    <input type='file' class="js-image_04" id="path_image_04" name="path_image[3][file]" accept="image/*" />
                                    <input type="hidden" name="path_image[3][id]" value="{{ $images[4]->id or '' }}"/>
                                    <input type="hidden" name="path_image[3][nome]" value="img_4"/>
                                    <br />
                                    @if(array_key_exists(4, $images))
                                        @if($images[4]->status == 1)
                                            <label>Status: <span class="label label-success">Ativo</span></label><br />
                                            <a class="btn btn-xs btn-warning js-btn " data-id="{{ $images[4]->id or '' }}" data-status="{{ $images[1]->status or ''  }}">
                                           <span class="glyphicon glyphicon-eye-close"></span>
                                                Inativar
                                            </a>
                                        @else
                                            <label>Status: <span class="label label-warning">Inativo</span></label><br />
                                            <a class="btn btn-xs btn-success js-btn" data-id="{{ $images[4]->id or '' }}" data-status="{{ $images[1]->status or ''  }}">
                                           <span class="glyphicon glyphicon-eye-open"></span>
                                                Ativar
                                            </a>
                                        @endif
                                    @endif
                                    <hr>
                                </div>
                            </div>
                            <div class='col-md-4'>
                                <div class='form-group'>
                                    <label class="required">Imagem 05</label>
                                    <input type='file' class="js-image_05" id="path_image_04" name="path_image[4][file]" accept="image/*" />
                                    <input type="hidden" name="path_image[4][id]" value="{{ $images[5]->id or '' }}"/>
                                    <input type="hidden" name="path_image[4][nome]" value="img_5"/>
                                    <br />
                                    @if(array_key_exists(5, $images))
                                        @if($images[5]->status == 1)
                                            <label>Status: <span class="label label-success">Ativo</span></label><br />
                                            <a class="btn btn-xs btn-warning js-btn " data-id="{{ $images[5]->id or '' }}" data-status="{{ $images[1]->status or ''  }}">
                                            <span class="glyphicon glyphicon-eye-close"></span>
                                                Inativar
                                            </a>
                                        @else
                                            <label>Status: <span class="label label-warning">Inativo</span></label><br />
                                            <a class="btn btn-xs btn-success js-btn" data-id="{{ $images[5]->id or '' }}" data-status="{{ $images[1]->status or ''  }}">
                                            <span class="glyphicon glyphicon-eye-open"></span>
                                                Ativar
                                            </a>
                                        @endif
                                    @endif
                                    <hr>
                                </div>
                            </div>
                            <div class='col-md-4'>
                                <div class='form-group'>
                                    <label class="required">Imagem 06</label>
                                    <input type='file' class="js-image_06" id="path_image_06" name="path_image[5][file]" accept="image/*" />
                                    <input type="hidden" name="path_image[5][id]" value="{{ $images[6]->id or '' }}"/>
                                    <input type="hidden" name="path_image[5][nome]" value="img_6"/>
                                    <br />
                                    @if(array_key_exists(6, $images))
                                        @if($images[6]->status == 1)
                                            <label>Status: <span class="label label-success">Ativo</span></label><br />
                                            <a class="btn btn-xs btn-warning js-btn " data-id="{{ $images[6]->id or '' }}" data-status="{{ $images[1]->status or ''  }}">
                                            <span class="glyphicon glyphicon-eye-close"></span>
                                                Inativar
                                            </a>
                                        @else
                                            <label>Status: <span class="label label-warning">Inativo</span></label><br />
                                            <a class="btn btn-xs btn-success js-btn" data-id="{{ $images[6]->id or '' }}" data-status="{{ $images[1]->status or ''  }}">
                                            <span class="glyphicon glyphicon-eye-open"></span>
                                                Ativar
                                            </a>
                                        @endif
                                    @endif
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <button name="save_continue" class="btn btn-primary js-submit">Salvar</button>
                                    <input type="button" class="btn btn-warning js-cancelar" value="Voltar" >
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
    <script src="{{url("js/banner/form-banner.js")}}"></script>
@endsection
