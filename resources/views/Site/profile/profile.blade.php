@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Perfil</h1>
  

@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">
                        <div class="col">
                            <form action="{{route('profile.Update')}}" method="POST" enctype="multipart/form-data">
                                {!!csrf_field()!!}
                                <div class="form-group">
                                  <label for="">Nome:</label>
                                  <input type="text" class="form-control" name="nome" value="{{auth()->user()->name}}">
                                </div>
                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Endereço de email</label>
                                  <input type="email" class="form-control" name="email" value="{{auth()->user()->email}}"    placeholder="nome@exemplo.com">
                                </div>
                                <div class="form-group">
                                  <label for="exampleFormControlSelect2">Senha</label>
                                  <input type="password" name="password" id="" class="form-control col-md-3"> 
                                </div>
                                <div class="form-group">
                                    
                                    <label for="exampleFormControlFile1">Upload foto de perfil</label>
                                    <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1">
                                    @if (auth()->user()->image != null)
                                        <img src="{{url('storage/users'.auth()->user()->image)}}" alt="{{auth()->user()->name}}" style="max-width: 50px;">
                                    @endif
                                  </div>
                                  <button type="submit" class="btn btn-dark">Salvar</button>
                              </form>
                         
                    </p>
                </div>
            </div>
        </div>
    </div>
    @include('admin.includes.alert')
@stop
