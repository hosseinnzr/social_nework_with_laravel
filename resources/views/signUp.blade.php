@extends('layout')
@section('title', "home page")
@section('content')
    {{ csrf_field() }}
<main>
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-sm-10 col-md-8 col-lg-8 col-xl-7 col-xxl-6">
        <div class="card card-body rounded-3 p-4 p-sm-5">
          <form action="{{route('signup.post')}}" method="POST" class="mt-4">
              @csrf
                
                <!-- Title -->
                <h2 style="text-align: center" class="h1 mb-2">Sign Up</h2>
                <p style="text-align: center">Have an account?<a href="/signin"> sign in</a></p>
                <br>
                <div class="mb-3 input-group-lg">
                  <label for="user_name" class="form-label">user name : </label>
                  <input value="{{old('user_name')}}" type="text" class="form-control" name="user_name">

                  @error('user_name')
                  <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                  @enderror
                </div>
                
                <div class="mb-3 input-group-lg">
                  <label for="first_name" class="form-label">first name : </label>
                  <input value="{{old('first_name')}}" type="text" class="form-control" name="first_name">

                  @error('first_name')
                  <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                  @enderror
                </div>
                
                <div class="mb-3 input-group-lg">
                  <label for="last_name" class="form-label">last name : </label>
                  <input value="{{old('last_name')}}" type="text" class="form-control" name="last_name">

                  @error('last_name')
                  <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                  @enderror
                </div>
                
                <div class="mb-3 input-group-lg">
                  <label for="email" class="form-label">Email address : </label>
                  <input value="{{old('email')}}" type="email" class="form-control" name="email">

                  @error('email')
                  <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                  @enderror
                <div class="mb-3 input-group-lg">
                  
                  <label for="password" class="form-label">Password : </label>
                  <input value="{{old('password')}}" type="password" class="form-control" name="password">
                </div>
                
                <button type="submit" class="btn btn-primary">sign up</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection