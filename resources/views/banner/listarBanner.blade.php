@extends('layouts.main')

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <div class='row'>
                    <div class='col-md-4'>
                        <h3 class="box-title">Lista de Cursos Cadastrados</h3>
                    </div>
                    <div class='col-md-8 text-right'>
                        <a href="/cad-cursos" class="btn btn-success"> <i class="fa fa-plus"></i> Novo</a>
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
                                    <th>Tipo</th>
                                    <th>Valor</th>
                                    <th>Status</th>
                                    <th align="right">Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cursos as $cursos)
                                    <tr>
                                        <td>{{$cursos->nome}}</td>
                                        <td>{{$cursos->tipo_curso == 1 ? 'EAD' : 'Semipresencial'}}</td>
                                        <td>{{ 'R$ '.number_format($cursos->valor, 2, ',', '.') }}</td>
                                        <td>{{$cursos->status == 1 ? 'Ativo' : 'Inativo'}}</td>

                                        <td align="right">
                                            <a href="/edit-curso/{{ $cursos->id }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                                            <button class="btn btn-danger btn-xs js-btn-delete" data-curso="{{ $cursos->id }}"><i class="fa fa-trash"></i></button>
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
    <script src="{{url("js/cursos/listar-cursos.js")}}"></script>
@endsection
