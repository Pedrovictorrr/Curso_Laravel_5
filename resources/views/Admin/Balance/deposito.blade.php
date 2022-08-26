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
                        <form method="POST" action="{{route('balance.deposito.store')}}">
                            {!!csrf_field()!!}
                            <div class="form-group">
                                <input type="text" name="value" placeholder="Valor do deposito">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Depositar</button>
                            </div>
                        </form>
                            
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop
