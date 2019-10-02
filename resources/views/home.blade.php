@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card  border-dark border-rounded">
            
                <div class="card-header">
                    @if (Auth::user())
                        {{ Auth::user()->name }}
/
                        <a href="admin">Admin</a>
                    @endif

                </div>
                   

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @foreach ($items as $i)
                    <div class="card m-1" style="height: 465px; width:13rem; float:left;">
                      <img src="../storage/app/{{$i->picture}}" class="card-img-top" alt="No Image">
                      <div class="card-body">
                        <h5 class="card-title">{{$i->name}}</h5>
                        <p class="card-text">{{$i->info}}</p>
                        <p class="card-text">{{$i->price}} gold</p>
                        <a href="#" class="btn btn-primary" onclick="addItem({{$i->id}}, '{{$i->price}}', '{{$i->name}}')">Add to Cart</a>
                      </div>
                    </div>
                    @endforeach
                </div>

                
            </div>
        </div>
    </div>
</div>
@endsection
