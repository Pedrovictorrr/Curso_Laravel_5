@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">
                        <div class="col">

                            <div class="small-box bg-success">
                            <div class="inner">
                            <h3>R$ {{number_format($amount,2,',','')}}</h3>
                            <p>New Orders</p>
                            </div>
                            <div class="icon">
                            <ion-icon name="cash-outline"></ion-icon>
                            </div>
                            <a href="#" class="small-box-footer">Histórico <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                            <a class="btn btn-danger">Sacar</a>
                            <a href="{{route('balance.deposito')}}" class="btn btn-primary">Depositar</a>
                            </div>
                            
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop
