@extends('layouts.main')

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <div class='row'>
                    <div class='col-md-4'>
                        <h3 class="box-title">Lista de Pedidos</h3>
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
                                    <th>Código</th>
                                    <th>Código Pagamento</th>
                                    <th>Forma de Pagamento</th>
                                    <th>Status</th>
                                    <th>Data Compra</th>
                                    <th align="right">Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($resultados as $resultado)
                                    <tr>
                                        <td width="20">{{$resultado->cod_pedido}}</td>
                                        <td>{{$resultado->cod_pagamento}}</td>
                                        <td>{{$resultado->pagamento}}</td>
                                        <td>
                                            @switch($resultado->cod_status)
                                                @case(3)
                                                <span class="label label-success">{{$resultado->status}}</span>
                                                @break

                                                @case(7)
                                                <span class="label label-danger">{{$resultado->status}}</span>
                                                @break

                                                @default
                                                <span class="label label-primary">{{$resultado->status}}</span>
                                            @endswitch
                                        </td>
                                        <td>{{ date('d/m/Y', strtotime($resultado->data_compra)) }}</td>
                                        <td align="center">
                                            <a href="/detalhe-pedido/{{ $resultado->cod_pedido }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
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
@endsection
