@extends('layouts.main')

@section('content')
    <div class="row">

        @if (Auth::user()->role_id === 1)
            <div class="col-sm-6 col-lg-3">
                <div class="info-box">
                    <div class="info-box-content">
                        <i class="fa fa-user-plus text-navy"></i>
                        <div class="text-center value">{{  $resultados['cursos'] }}</div>
                        <div class="text-muted text-uppercase text-center">Cursos Vendido</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="info-box">
                    <div class="info-box-content">
                        <i class="fa fa-user-plus text-navy"></i>
                        <div class="text-center value">{{  $resultados['cursos'] }}</div>
                        <div class="text-muted text-uppercase text-center">Cursos Vendido</div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-sm-6 col-lg-3">
                <div class="info-box">
                    <div class="info-box-content">
                        <i class="fa fa-user-plus text-navy"></i>
                        <div class="text-center value">{{  $resultados['pacientes'] }}</div>
                        <div class="text-muted text-uppercase text-center">Pacientes Cadastrados</div>
                    </div>
                </div>
            </div>
        @endif



    </div>
@endsection
