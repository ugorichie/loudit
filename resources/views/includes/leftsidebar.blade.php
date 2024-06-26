<div class="container py-4">
    <div class="row">
        <div class="col-3">
            <div class="card overflow-hidden">
                <div class="card-body pt-3">
                    <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
                        <li class="nav-item">
                            <a class=" {{(Route::is('loud.index')) ? 'bg-primary text-white' : 'bg-light text-dark'}} nav-link text-dark" href="{{route('loud.index')}}">
                                <span>Home</span></a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span>Explore</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span>Feed</span></a> --}}
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('terms')}}">
                                <span>Terms</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span>Support</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span>Settings</span></a>
                        </li>
                    </ul>
                </div>
                @auth
                    
                <div class="card-footer text-center py-2">
                    <a class="btn btn-link btn-sm" href="{{route('profile', Auth::id())}}">View Profile </a>
                </div>
                @endauth
            </div>
        </div>