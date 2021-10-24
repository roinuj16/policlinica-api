@extends('layouts.main')

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <h3 class="box-title">Logo</h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <form action="{{ url('/save-logo') }}" method="post" id="" enctype="multipart/form-data">
                        <input type="hidden" value="{{csrf_token()}}" name="_token" />
                        <input type="hidden" value="{{ $img->id or ''}}" name="id" />
                        <div class='row'>
                            <div class="col-xs-6 col-md-4">
                                <img class="thumbnail" width="254" height="136" src="{{ $img->path_image or '' }}" alt="">
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-4'>
                                <div class='form-group'>
                                    <input type='file' class="js-image" id="primaryImage" name="path_image" accept="image/*" />
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <button name="save_continue" class="btn btn-primary js-submit">Salvar</button>
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
    <script src="{{url("js/logo/form-logo.js")}}"></script>
    @include('helper.messages');
@endsection
