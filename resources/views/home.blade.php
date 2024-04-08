@extends('includes.layout.headerfoter')

    @section('content')
        
    
    @include('includes.leftsidebar')
    
            <div class="col-6">
                @if(session()->has('success'))
                    @include('includes.success')
                @endif

                @guest
                <h4> Welcome !, Here are some of the most liked Louds.</h4> 
                <h6> <a href="/register">Register</a> Now to <span class="text-muted">  LOUD YOUR IDEAS </span></h6> 
                @endguest

                @auth
               {{-- this checks that, only when you are logged in can you share a loud --}}
                <h4> Loud yours ideas </h4>
                @include('includes.loudform')
                <hr>
                @endauth

                @foreach($louds as $loud )
                <div class="mt-3">
                    <div class="card">
                        
                        <div class="px-3 pt-4 pb-2 ">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                                        src="https://api.dicebear.com/6.x/fun-emoji/svg?seed={{$loud->user->name}}" alt="Mario Avatar">
                                    <div>
                                        <h5 class="card-title mb-0"><a href="#"> {{$loud->user->name}}
                                            </a></h5>
                                    </div>
                                    
                                </div>
                                <div class="align-items-left">
                                   
                                    
                                    <form action="{{route("loud.delete",$loud->id)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <a href="{{route("loud.show",$loud->id)}}"  class="btn btn-info btn-sm"> view </a>
                                        @auth
                                        
                                        <button class="btn btn-danger btn-sm"> X </button>
                                        @endauth
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="fs-6 fw-light text-muted">
                                    {{$loud->loud}}
                            </p>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
                                        </span> {{$loud->likes}} </a>
                                </div>
                                <div>
                                    <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                                       {{$loud->created_at}}
                                    </span>
                                </div>
                            </div>
                           {{-- @include('includes.comment') --}}
                        </div>
                    </div>

                </div>
                 @endforeach
                 {{$louds->links()}}
                 {{-- NB: this above is for the paginate button, the $louds is the variable gotten from the controller in which 
                 the eloquent:model result from database is stored in --}}


            </div>
            

            <div class="col-3">
               @include('includes.searchbar')
               
                @include('includes.follow')             
            </div>
        </div>
    </div>
  
    @endsection
