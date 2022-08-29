@if($errors->any())
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p>{{$error}}</p>
                            @endforeach
                        </div>
                            
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(session('success'))
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">
                        <div class="alert alert-success">
                           {{session('success')}}
                        </div>
                            
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">
                        <div class="alert alert-danger">
                           {{session('error')}}
                        </div>
                            
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif