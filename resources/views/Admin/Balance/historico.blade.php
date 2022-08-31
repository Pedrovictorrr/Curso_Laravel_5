@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Histórico</h1>
  <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="mb-0">
                    <div class="col">
                      <h4 class="m-0 text-dark">Search</h4>
                      <form action="{{route('historico.pesquisa')}}" method="POST">
                        {!!csrf_field()!!}
                      <div class="form-group row">
                          <div class="">
                          <input type="search" name='id'class="form-control" />
                          </div>
                          <div class="">
                            <input type="date" name="date" class="form-control" />
                            </div>
                          <div class="">
                            <select class="form-control" name="type" placeholder="Tipo">
                              @foreach ($types as $key => $type)
                                 <option value="{{$key}}">{{$type}}</option> 
                              @endforeach
                              
                              
                            </select>
                          </div>
                          <div class="">
                        <button type="submit" class="btn btn-dark">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                      
                    </div>
                    </form>
                          
                          
                        
                </p>
            </div>
        </div>
    </div>
</div>
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
                                    @forelse($historicos as $historico)
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
                              @if (isset($dataform))
                                  {{$historicos->appends($dataform)->links()}}
                              @else
                            {{ $historicos->links() }}
                             @endif 
                              
                            
                    </p>
                </div>
            </div>
        </div>
    </div>
    @include('admin.includes.alert')
@stop
