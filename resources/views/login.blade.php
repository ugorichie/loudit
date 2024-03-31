@extends('includes.layout.headerfoter')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6">
            <form class="form mt-5" action="" method="post">
                @csrf
                <h3 class="text-center text-dark">LOGIN</h3>
                {{-- <div class="form-group">
                    <label for="username" class="text-dark">Username:</label><br>
                    <input type="username" name="username" id="username" placeholder="@johnC" class="form-control">
                </div> --}}
                <div class="form-group">
                    <label for="email" class="text-dark">Email:</label><br>
                    <input type="email" name="email" id="email" placeholder="john@gmail.com" class="form-control">
                </div>
                <div class="form-group mt-3">
                    <label for="password" class="text-dark">Password:</label><br>
                    <input type="text" name="password" id="password"  class="form-control">
                </div>
               
                <div class="form-group">
                    <label for="remember-me" class="text-dark"></label><br>
                    <input type="submit" name="submit" class="btn btn-dark btn-md" value="submit">
                </div>
                <div class="text-right mt-2">
                    <a href="/login" class="text-dark">Login here</a>
                </div>
            </form>
        </div>
    </div>

    @endsection