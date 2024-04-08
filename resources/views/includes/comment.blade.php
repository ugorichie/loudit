<div>
    
    <form action="{{route('comment.create',$loud->id)}}" method="POST" >
        @csrf
        <div class="mb-3 mt-2">
            <textarea name='comment' class="fs-6 form-control" rows="1"></textarea>
        </div>
        <div>
            <button type='submit' class="btn btn-primary btn-sm btn-primary"> Comment </button>
        </div>
    </form>

    @foreach ($comments as $comment )
        
   
    <hr>
    <div class="d-flex align-items-start">
        <img style="width:35px" class="me-2 avatar-sm rounded-circle"
            src="https://api.dicebear.com/6.x/fun-emoji/svg?seed={{$comment->name}}"
            alt="Luigi Avatar">
        <div class="w-100">
            <div class="d-flex justify-content-between">
                <div>
                    <span><a href="#">{{$comment->username}}</a></span>
                </div>
                <small class="fs-6 fw-light text-dark"> {{$comment->created_at}} </small>
            </div>
            <p class="fs-6 mt-3 fw-light">
                {{$comment->comments}}
            </p>
        </div>
    </div>
    @endforeach
</div>