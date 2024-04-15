@extends('includes.layout.headerfoter')


    @section('content')

       
        @include('includes.leftsidebar')

        @if ($editing ?? false)
            <div class="col-6">
                <div class="card">
                <div class="px-3 pt-4 pb-2">
                    <div class="d-flex align-items-left">
                        <a href="{{route('profile', $user->id)}}" class="btn btn-sm btn-dark">view</a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <form enctype="multipart/form-data" action="{{route('profile.update', auth()->id())}}" method="post"> 
                                @csrf
                                
                        
                            <img style="width:150px" class="me-2 avatar-sm rounded-circle"
                                src='{{$user->getImage()}}' alt="Mario Avatar">

                                <label for="Name" class="fs-5"> Image :</label>
                                <input name="image" type="file" class="card-title mb-0 form-controlphp arti">
                            <div>
                                <label for="Name" class="fs-5"> Name :</label>
                                <input name="name" class="card-title mb-0 form-control mb-1" value="{{$user->name}}">

                                <label for="username" class="fs-5"> Username:</label>
                                <input name='username' class="card-title mb-0 form-control" value="{{$user->username}}"> 
                                
                            </div>
                        </div>
                    </div>
                    <div class="px-2 mt-4">
                        <h5 class="fs-5"> About : </h5>
                        <textarea name="about" rows="3" cols="55" > {{$user->about}}</textarea>
                        <div class="d-flex justify-content-start mt-2">
                           <button type="subit" class="btn btn-sm btn-secondary"> UPDATE </button>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
            
        </div>
        @else
        <div class="col-6">
            <div class="card">
               <div class="px-3 pt-4 pb-2">
                   <div class="d-flex align-items-center justify-content-between">
                       <div class="d-flex align-items-center">
                           <img style="width:150px" class="me-2 avatar-sm rounded-circle"
                               src="{{$user->getImage()}}" alt="Mario Avatar">
                           <div>

                               <h3 class="card-title mb-0"><a href="#">{{$user->name}}</a></h3>
                               <span class="fs-6 text-muted"> {{$user->username}}</span>
                               @auth
                               @if (Auth::id() == $user->id )
                                   
                               <div class="mt-3">
                                   <form action="{{route('profile.edit',$user->id )}}" method="post">
                                        @csrf
                                       <button class="btn btn-sm btn-info"> EDIT PROFILE </button>
                                   </form>
                                   
                               </div>
                               @endif
                           @endauth
                           </div>
                       </div>
                   </div>
                   <div class="px-2 mt-4">
                       <h5 class="fs-5"> About : </h5>
                       <p class="fs-6 fw-light">
                         {{$user->about}}
                       </p>
                       <div class="d-flex justify-content-start">
                           <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                               </span> 120 Followers </a>
                           <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
                               </span> {{$user->loud->count()}} </a>
                           <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
                               </span> {{$user->comment->count()}} </a>
                       </div>

                       @auth
                           @if (Auth::id() !== $user->id )
                               
                           <div class="mt-3">
                               <button class="btn btn-primary btn-sm"> Follow </button>
                           </div>
                           @endif
                       @endauth
                   </div>
               </div>
           </div>
          
       </div>
        @endif

      


        <div class="col-3">
            @include('includes.follow')
        </div>

   


    @endsection