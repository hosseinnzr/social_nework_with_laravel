@extends('layout')
@section('title', "home page")
@section('content')
    {{ csrf_field() }}

    <form action="{{route('signup.post')}}" method="POST" class="ms-auto me-auto mt-3" style="width: 500px">
        @csrf
          <h3>Create Admin :</h3>
          <br>
          <div class="mb-2">
            <label for="username" class="form-label">user name : </label>
            <input type="text" class="form-control" name="username">
          </div>
          <div class="mb-2">
            <label for="username" class="form-label">first name : </label>
            <input type="text" class="form-control" name="firstname">
          </div>
          <div class="mb-2">
            <label for="username" class="form-label">last name : </label>
            <input type="text" class="form-control" name="lastname">
          </div>
          <div class="mb-2">
            <label for="email" class="form-label">Email address : </label>
            <input type="text" class="form-control" name="email">
          <div class="mb-2">
            <label for="password" class="form-label">Password : </label>
            <input type="password" class="form-control" name="password">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection