@extends('layouts.main')

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <div class='row'>
                    <div class='col-md-4'>
                        <h3 class="box-title">Lista de Pacientes Cadastrados</h3>
                    </div>
                    <div class='col-md-8 text-right'>
                         <a href="/export-csv" class="btn btn-default"><i class="fa fa-cloud-download"></i> Baixar Arquivo CSV</a>
                        <a href="/cad-paciente" class="btn btn-success"> <i class="fa fa-plus"></i> Novo</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class='row'>
                        <div class='col-md-12'>
                            <table id="example" class="table responsive table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Local da consulta</th>
                                    <th align="right">Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pacientes as $paciente)
                                    <tr>
                                        <td>{{$paciente->nome}}</td>
                                        <td>{{$paciente->email}}</td>
                                        <td>{{$paciente->telefone}}</td>
                                        <td>{{$paciente->local_cadastro == 1 ? 'Policlínica' : 'Santa Maria'}}</td>
                                        <td align="left" width="200">
                                            <a href="/edit-paciente/{{ $paciente->id }}" data-toggle="tooltip" data-placement="top" title="Editar"
                                               class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                                            <a href="/dados-paciente/{{ $paciente->id }}" data-toggle="tooltip" data-placement="top" title="Ver Detalhes"
                                               class="btn btn-info btn-xs"><i class="fa fa-search"></i></a>

                                            <button class="btn btn-danger btn-xs js-btn-delete" data-toggle="tooltip" data-placement="top" title="Excluir"
                                                    data-paciente="{{ $paciente->id }}"><i class="fa fa-trash"></i>
                                            </button>
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
    <script src="{{url("js/pacientes/listar-pacientes.js")}}"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
