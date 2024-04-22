@extends('layout')
@section('title', "home page")
@section('content')
    {{ csrf_field() }}

    <form action="{{route('signup.post')}}" method="POST" class="ms-auto me-auto mt-3" style="width: 500px">
        @csrf
          <h3>Create Admin :</h3>
          <br>
          <div class="mb-2">
            <label for="user_name" class="form-label">user name : </label>
            <input value="{{old('user_name')}}" type="text" class="form-control" name="user_name">
          </div>
          <div class="mb-2">
            <label for="first_name" class="form-label">first name : </label>
            <input value="{{old('first_name')}}" type="text" class="form-control" name="first_name">
          </div>
          <div class="mb-2">
            <label for="last_name" class="form-label">last name : </label>
            <input value="{{old('last_name')}}" type="text" class="form-control" name="last_name">
          </div>
          <div class="mb-2">
            <label for="email" class="form-label">Email address : </label>
            <input value="{{old('email')}}" type="text" class="form-control" name="email">
          <div class="mb-2">
            <label for="password" class="form-label">Password : </label>
            <input value="{{old('password')}}" type="password" class="form-control" name="password">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection