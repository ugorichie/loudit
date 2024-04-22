@extends('includes.layout.headerfoter')


    @section('content')

        @include('includes.leftsidebar')

            <div class="col-6">
                @if(session()->has('success'))
                    @include('includes.success')
                @endif
                @foreach($louds as $loud )
                <div class="mt-3">
                    <div class="card">
                        
                        <div class="px-3 pt-4 pb-2 ">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                                        src="https://api.dicebear.com/6.x/fun-emoji/svg?seed={{$loud->name}}" alt="Mario Avatar">
                                    <div>
                                        <h5 class="card-title mb-0">{{$loud->name}}</h5>
                                        <span><a href="#">{{$loud->username}}</a></span>
                                    </div>
                                    
                                </div>
                                <div class="align-items-left">
                                    @auth
                                        @if (auth()->id() == $loud->user_id)
                                            
                                        <form action='{{route("loud.delete",$loud->id)}}' method="POST">
                                            @csrf
                                            <a href="{{route("loud.edit",$loud->id)}}"  class="btn btn-dark btn-sm"> EDIT </a>
    
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm"> X </button>
                                        </form>
                                        @endif
                                        
                                    @endauth
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($editing ?? false)
                            <form action="{{route('loud.update',$loud->id)}}" method="POST">
                                @csrf
                            <div class="mb-3">
                        
                                    <textarea class="form-control" id="idea" rows="3" name="loud">{{$loud->loud}} </textarea>
                                    @error('loud') 
                                        {{-- this loud above here is the name of the input field --}}
                                        <span style="color: red" class="fs-15"> {{$message}} </span>
                                    @enderror
                                </div>
                                <div class="">
                                    <button class="btn btn-secondary btn-sm"> Update Loud </button>
                                </div>
                            </form>
                            @endif
                            <p class="fs-6 fw-light text-muted mt-3">
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
                            <div>
                                @include('includes.comment')
                                <hr>
                                
                            </div>
                        </div>
                    </div>

                </div>
                 @endforeach


            </div>
            

            <div class="col-3">
               
                @include('includes.searchbar')
               
                @include('includes.follow')
            </div>

        </div>
    </div>
    @endsection