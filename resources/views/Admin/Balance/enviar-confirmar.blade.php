@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Confirmar Transferencia de saldo</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">
                        <div class="col">
                            <p><strong>Recebedor: </strong> {{$sender->name}}</p>
                            <p><strong>Seu saldo atual: </strong> R$ {{number_format($balance->amount,2,',','')}}</p>
                            <form method="POST" action="{{route('balance.deposito.transferir.store')}}">
                                {!!csrf_field()!!}
                                <input type="hidden" name='sender_id' value='{{$sender->id}}'>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="value" placeholder="Valor:">
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button class="btn btn-primary me-md-2" type="submit">Transferir</button>
                                   
                                  </div>
                            </form>
                            
                    </p>
                </div>
            </div>
        </div>
    </div>
    @include('admin.includes.alert')
@stop
