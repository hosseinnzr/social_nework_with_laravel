@extends('layout')
@section('title', "home page")
@section('content')
    @auth
    {{ csrf_field() }}

    <form action="{{route('addPost.post')}}" method="POST" class="ms-auto me-auto mt-3" style="width: 500px">
        @csrf

        @if($errors->any())
        <div class="col-12">
          @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
          @endforeach
        </div>
        @endif

          <h3>Add Post :</h3>
          <br>
          <div class="mb-3">
            <label for="title" class="form-label">title :</label>
            <input value="{{ $user->first_name ?? old('first_name')}}" type="text" class="form-control" name="title">

            @error('title')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
          </div>

          <div class="mb-3">
            <label for="post" class="form-label">post :</label>
            <input value="{{ $user->first_name ?? old('first_name')}}" type="text" class="form-control" name="post">
           
            @error('post')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
          </div>

          <div class="mb-3">
            <label for="hashtag" class="form-label">hashtag :</label>
            <input value="{{ $user->first_name ?? old('first_name')}}" type="text" class="form-control" name="hashtag">
          
            @error('hashtag')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    @endauth
@endsection