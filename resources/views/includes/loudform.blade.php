<div class="row">
    <form action="{{route('loud.create')}}" method="POST">
        @csrf
    <div class="mb-3">

            <textarea class="form-control" id="idea" rows="3" name="loud"></textarea>
        </div>
        <div class="">
            <button class="btn btn-dark"> Loud it </button>
        </div>
    </form>
</div>