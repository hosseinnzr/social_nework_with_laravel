@extends('layout')
@section('title', "sign up")
@section('content')
    {{ csrf_field() }}

    <form action="{{route('edit.post', ['user' => $user['id']])}}" method="POST" class="ms-auto me-auto mt-3" style="width: 500px">
        @csrf
          <h3>Create Admin :</h3>
          <br>
          <div class="mb-2">
            <label for="user_name" class="form-label">user name : </label>
            <input value="{{ $user['user_name'] ?? old('user_name')}}" type="text" class="form-control" name="user_name">
          </div>
          <div class="mb-2">
            <label for="first_name" class="form-label">first name : </label>
            <input value="{{ $user->first_name ?? old('first_name')}}" type="text" class="form-control" name="first_name">
          </div>
          <div class="mb-2">
            <label for="last_name" class="form-label">last name : </label>
            <input value="{{ $user->last_name ?? old('last_name')}}" type="text" class="form-control" name="last_name">
          </div>
          <div class="mb-2">
            <label for="biography" class="form-label">biography: </label>
            <textarea type="text" class="form-control" name="biography">{{ $user->biography ?? old('biography')}}</textarea>
          </div>
          <div class="mb-2">
            <label for="email" class="form-label">Email address : </label>
            <input value="{{ $user->email ?? old('email')}}" type="text" class="form-control" name="email">
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection