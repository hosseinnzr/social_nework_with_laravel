@extends('layout')
@section('title', "home page")
@section('content')
    {{ csrf_field() }}
<main>
  <div class="container">
    <div class="row justify-content-center align-items-center vh-100 py-5">
      <div class="col-sm-10 col-md-8 col-lg-8 col-xl-7 col-xxl-6">
        <div class="card card-body rounded-3 p-4 p-sm-5">
          <form action="{{route('signup.post')}}" method="POST" class="mt-4">
              @csrf
                <h3>Sign Up :</h3>
                <br>
                <div class="mb-3 input-group-lg">
                  <label for="user_name" class="form-label">user name : </label>
                  <input value="{{old('user_name')}}" type="text" class="form-control" name="user_name">
                </div>
                
                <div class="mb-3 input-group-lg">
                  <label for="first_name" class="form-label">first name : </label>
                  <input value="{{old('first_name')}}" type="text" class="form-control" name="first_name">
                </div>
                
                <div class="mb-3 input-group-lg">
                  <label for="last_name" class="form-label">last name : </label>
                  <input value="{{old('last_name')}}" type="text" class="form-control" name="last_name">
                </div>
                
                <div class="mb-3 input-group-lg">
                  <label for="email" class="form-label">Email address : </label>
                  <input value="{{old('email')}}" type="text" class="form-control" name="email">
                <div class="mb-3 input-group-lg">
                  
                  <label for="password" class="form-label">Password : </label>
                  <input value="{{old('password')}}" type="password" class="form-control" name="password">
                </div>
                
                <button type="submit" class="btn btn-primary">signup</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection