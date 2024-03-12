<div class="row">
    <form action="{{route('loud.create')}}" method="POST">
        @csrf
    <div class="mb-3">

            <textarea class="form-control" id="idea" rows="3" name="loud"></textarea>
            @error('loud') 
                {{-- this loud above here is the name of the input field --}}
                <span style="color: red" class="fs-15"> {{$message}} </span>
            @enderror
        </div>
        <div class="">
            <button class="btn btn-dark"> Loud it </button>
        </div>
    </form>

</div>