@extends('layouts.main')

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <div class='row'>
                    <div class='col-md-4'>
                        <h3 class="box-title">Lista de E-Books Cadastrados</h3>
                    </div>
                    <div class='col-md-8 text-right'>
                        <a href="/cad-ebooks" class="btn btn-success"> <i class="fa fa-plus"></i> Novo</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class='row'>
                        <div class='col-md-12'>
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Titulo</th>
                                    <th>Url</th>
                                    <th>Status</th>
                                    <th align="right">Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ebooks as $ebook)
                                    <tr>
                                        <td>{{$ebook->nome}}</td>
                                        <td>{{$ebook->url_video}}</td>
                                        <td>{{$ebook->status == 1 ? 'Ativo' : 'Inativo'}}</td>
                                        <td align="right">
                                            <a href="/edit-ebook/{{ $ebook->id }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                                            <button class="btn btn-danger btn-xs js-btn-delete" data-ebook="{{ $ebook->id }}"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @include('helper.messages');
    <script src="{{url("js/ebooks/listar-ebooks.js")}}"></script>
@endsection
