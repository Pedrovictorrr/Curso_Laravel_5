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
                            <table class="table">
                                <thead class="thead-dark">
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Sender_id</th>
                                    <th scope="col">Data</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @forelse($historico as $historico)
                                  <tr>
                                    <th scope="row">{{$historico->id}}</th>
                                    <td>{{number_format($historico->amount,2,',','.')}}</td>
                                    <td>{{$historico->type($historico->type)}}</td>
                                    <td>
                                        @if($historico->user_id_transaction)
                                        {{$historico->userSender->name}}
                                        @else
                                        -    
                                        @endif
                                    </td>
                                    <td>{{$historico->date}}</td>
                                  </tr>
                                  @empty
                                      
                                  @endforelse
                                </tbody>

                              </table>
                              
                              
                              
                            
                    </p>
                </div>
            </div>
        </div>
    </div>
    @include('admin.includes.alert')
@stop
