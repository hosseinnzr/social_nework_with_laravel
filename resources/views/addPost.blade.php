@extends('layout')
@section('title', "home page")
@section('content')
    @auth
    {{ csrf_field() }}

    <form action="{{route('addPost.post')}}" method="POST" class="ms-auto me-auto mt-3" style="width: 500px">
        @csrf
          <h3>Add Post :</h3>
          <br>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">first name</label>
            <input type="text" class="form-control" name="first_name">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">last name</label>
            <input type="text" class="form-control" name="last_name">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="text" class="form-control" name="email">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">phone</label>
            <input type="text" class="form-control" name="phone">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">address</label>
            <input type="text" class="form-control" name="address">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">gender</label>
            <input type="text" class="form-control" name="gender">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    @endauth
@endsection