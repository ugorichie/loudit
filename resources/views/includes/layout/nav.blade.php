<nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark ticky-top bg-body-tertiary"
data-bs-theme="dark">
<div class="container">
    <a class="navbar-brand fw-light" href="/"><span class="fas fa-brain me-1"> </span>{{config('app.name')}}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            @guest
                {{-- if there is no session caught, hence the persion is a guest, everything in this @guest is displayed --}}
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/login">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('user.registerpage')}}">Register</a>
            </li>
           
            @endguest

            @auth
                {{-- if the user is logged in (i.e session starts), everything in @auth is displayed --}}
            <li class="nav-item">
                <a class="nav-link" href="#"> Welcome. {{auth()->user()->name}} </a>
            </li> 
            &nbsp;
            <li class="nav-item">
                <a class="nav-link text-white" href="{{route('profile', auth()->id())}}"> <b> Profile </b> </a>
            </li>

            <form action="{{route('user.logout')}}" method="post">
                @csrf
                <button class="btn btn-danger btn-sm"> LOG OUT</button>
            </form>
            @endauth

        </ul>
    </div>
</div>
</nav>