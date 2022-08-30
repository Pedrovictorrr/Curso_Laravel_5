@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Transferir para remetente</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">
                        <div class="col">
                            <form method="POST" action="{{route('balance.deposito.transferir')}}">
                                {!!csrf_field()!!}
                                <div class="form-group">
                                    <input type="text" class="form-control" name="sender" placeholder="Email do destinatário">
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button class="btn btn-primary me-md-2" type="submit">Proximo</button>
                                   
                                  </div>
                            </form>
                            
                    </p>
                </div>
            </div>
        </div>
    </div>
    @include('admin.includes.alert')
@stop
