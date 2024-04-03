@extends('includes.layout.headerfoter')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6">
            <form class="form mt-5" action="{{route('user.create')}}" method="POST">
                @csrf
                <h3 class="text-center text-dark">Register</h3>
                <div class="form-group">
                    <label for="fullname" class="text-dark">Full Name:</label><br>
                    <input type="text" name="fullname" id="fullname" placeholder="John Carmen" class="form-control">
                    @error('fullname') 
                    <span style="color: red" class="fs-15"> {{$message}} </span>
                @enderror
                </div>
                <div class="form-group">
                    <label for="username" class="text-dark">Username:</label><br>
                    <input type="text" name="username" id="username" placeholder="@john" class="form-control">
                    @error('username') 
                    <span style="color: red" class="fs-15"> {{$message}} </span>
                @enderror
                </div>
                <div class="form-group">
                    <label for="email" class="text-dark">Email:</label><br>
                    <input type="email" name="email" id="email" placeholder="john@gmail.com" class="form-control">
                    @error('email') 
                    <span style="color: red" class="fs-15"> {{$message}} </span>
                @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="password" class="text-dark">Password:</label><br>
                    <input type="password" name="password" id="password"  class="form-control">
                    @error('password') 
                    <span style="color: red" class="fs-15"> {{$message}} </span>
                @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="confirm-password" class="text-dark">Confirm Password:</label><br>
                    <input type="password" name="password_confirmation" id="confirm-password" class="form-control">
                    
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