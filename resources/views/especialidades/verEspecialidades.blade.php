@extends('layouts.main')

@section('styles')
@endsection

@section('content')
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <div class='row'>
                    <div class='col-md-4'>
                        <h3 class="box-title">Lista de Especialidades</h3>
                    </div>
                    <div class='col-md-8 text-right'>
                        <a href="/cad-especialidades" class="btn btn-success"> <i class="fa fa-plus"></i> Novo</a>
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
                                    <th align="right">Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($especialidades as $especialidade)
                                    <tr>
                                        <td>{{$especialidade->nome}}</td>
                                        <td align="right">
                                            <a href="/edit-especialidades/{{ $especialidade->id }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                                            <button class="btn btn-danger btn-xs js-btn-delete" data-conteudo="{{ $especialidade->id }}"><i class="fa fa-trash"></i></button>
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

    <script>
        $('.js-btn-delete').on('click', function () {
            var el = $(this).data('conteudo');
            $.confirm({
                title: 'EXCLUIR',
                content: 'Confirmar Exclusão?',
                buttons: {
                    confirm: {
                        text: 'Sim',
                        btnClass: 'btn-green',
                        keys: [
                            'enter',
                            'shift'
                        ],
                        action: function () {
                            var url = window.location.origin +'/delete-especialidades';
                            $.ajax({
                                type: "get",
                                url: url + '/' + el,
                                success: function (data) {
                                    if(data == 1) {
                                        //TODO: Melhorar isso aqui...
                                        toastr.success("Registro deletado com sucesso!");
                                        setTimeout(function(){
                                            location.reload();
                                        }, 1000);
                                    }
                                },
                                error: function (data) {
                                    console.log('Error:', data);
                                }
                            });
                        }
                    },
                    cancel: {
                        text: 'Cancelar',
                        btnClass: 'btn-red',
                        keys: [
                            'enter',
                            'shift'
                        ],
                        action: function () {}
                    }
                }
            });
        });
    </script>

@include('helper.messages');

@endsection
