@extends('layout')
@section('title', "post")
@section('content')
@auth
  {{ csrf_field() }}
<body>
  
  <main>
    <div class="container">
      <div class="row justify-content-center align-items-center vh-100 py-5">
        <div class="col-sm-10 col-md-8 col-lg-8 col-xl-7 col-xxl-6">
          <div class="card card-body rounded-3 p-4 p-sm-5"> 
            <form method="POST" action="{{ isset($post) ? route('post.update', ['id' => $post->id]) : route('post.store')}}" class="mt-4" enctype="multipart/form-data">
                @csrf

                @if($errors->any())
                <div class="col-12">
                  @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{$error}}</div>
                  @endforeach
                </div>
                @endif
                
                  @isset($post)
                    <h3>Edit Post :</h3>
                  @else
                    <h3>Add Post :</h3>
                  @endisset
                  <br>
                  <div class="mb-3 position-relative">
                    <!-- post picture -->
                    <div class="col-sm-12 col-lg-12">
                      <label class="form-label">post picture :</label>
                      <input name="post_picture" type="file" class="form-control">
                    
                      @error('post_picture')
                      <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                      @enderror
                    </div>

                    <div class="mb-3 input-group-lg">
                      <label for="title" class="form-label">title :</label>
                      <input value="{{ $post['title'] ?? old('title')}}" type="text" class="form-control" name="title">

                      @error('title')
                      <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                      @enderror
                    </div>

                    <div class="mb-3 input-group-lg">
                      <label for="post" class="form-label">post :</label>
                      <textarea type="text" class="form-control" name="post" rows="5">{{ $post['post'] ?? old('post')}}</textarea>
                    
                      @error('post')
                      <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                      @enderror
                    </div>

                    <div class="mb-3 input-group-lg">
                      <label for="tag" class="form-label">hashtag :</label>
                      <input value="{{ $post['tag'] ?? old('tag')}}" type="text" class="form-control" name="tag">
                    
                      @error('tag')
                      <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <br>
                  <button type="submit">
                    @isset($post)
                        <div  class="btn btn-primary">update</div>
                    @else
                        <div  class="btn btn-primary">add</div>
                    @endisset
                  </button>

                  <hr>
                  <div class="card-footer text-center py-2">
                    <a class="btn btn-link text-secondary btn-sm" type="submit" href="{{ route('profile', ['user_name' => Auth::user()->user_name]) }}">Back to Profile </a>
                  </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

</body>
    @endauth
@endsection