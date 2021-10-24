@extends('layouts.main')

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="invoice-box">
            <div class='row'>
                <div class='col-md-12'>
                    <div class="panel panel-default">
                        <div class="panel-heading">Comprador</div>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Name</td>
                                <td>{{ $resultados['dados']->nome }}</td>
                            </tr>
                            <tr>
                                <td>CPF</td>
                                <td>{{ $resultados['dados']->cpf }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $resultados['dados']->email }}</td>
                            </tr>
                            <tr>
                                <td>Telefone</td>
                                <td>{{ $resultados['dados']->telefone }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-12'>
                    <div class="panel panel-default">
                        <div class="panel-heading">Pedido</div>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Código do Pedido</td>
                                <td>{{ $resultados['dados']->cod_pedido }}</td>
                            </tr>
                            <tr>
                                <td>Código do Pagamento</td>
                                <td>{{ $resultados['dados']->code }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    @switch($resultados['dados']->cod_status)
                                        @case(3)
                                        <span class="label label-success">{{$resultados['dados']->status }}</span>
                                        @break

                                        @case(7)
                                        <span class="label label-danger">{{$resultados['dados']->status}}</span>
                                        @break

                                        @default
                                        <span class="label label-primary">{{$resultados['dados']->status}}</span>
                                    @endswitch
                                </td>
                            </tr>
                            <tr>
                                <td>Forma de Pagamento</td>
                                <td>{{ $resultados['dados']->forma_pagamento }}</td>
                            </tr>
                            <tr>
                                <td>Parcelas</td>
                                <td>{{ $resultados['dados']->qtd_parcela }}</td>
                            </tr>
                            <tr>
                                <td>Valor do Pedido</td>
                                <td>{{ 'R$ '.number_format($resultados['dados']->valor_total, 2, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Data da Compra</td>
                                <td>
                                    {{ date('d/m/Y', strtotime($resultados['dados']->date_compra)) }}
                                </td>
                            </tr>
                            <tr>
                                <td>Data da Autorização</td>
                                <td>
                                    {{ date('d/m/Y', strtotime($resultados['dados']->date_refresh_status)) }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-12'>
                    <div class="panel panel-default">
                        <div class="panel-heading">Lista de Curso do Pedido</div>
                        <table class="table table-bordered table-responsive">
                            <thead>
                            <tr>
                                <th>Curso</th>
                                <th>Formato</th>
                                <th>Valor</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($resultados['cursos'] as $curso)
                                    <tr>
                                        <td>{{ $curso->nome_curso }}</td>
                                        <td>{{ $curso->tipo_curso }}</td>
                                        <td>{{ 'R$ '.number_format($curso->valor, 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
