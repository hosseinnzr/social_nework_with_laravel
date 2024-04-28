@extends('layout')
@section('title', 'explor')
@section('title1', 'explor')
@section('content')
@auth
{{ csrf_field() }}

<html> 
  <body> 
    <div class="container-fluid gedf-wrapper">
        <div class="row">
            <div class="col-md-9 gedf-main">
              @foreach ($posts as $post)
                                <div class="card gedf-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                                </div>
                                <div class="ml-2">
                                    <div class="h5 m-0">{{$post['user_name']}}</div>
                                    <div class="text-muted h7 mb-1"> <i class="fa fa-clock-o"></i> {{$post['created_at']}}</div>
                                </div>
                            </div>
                            <div>
                                <div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                      {{-- Delete --}}
                                      <form action="{{route('delete', ['id' => $post['id']])}}" method="POST" class="ms-auto me-auto mt-3">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                      </form>
                                      {{-- Edit --}}
                                      <form action="#" method="POST" class="ms-auto me-auto mt-3">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                      </form>
                                      {{-- Save --}}
                                      <form action="#" method="POST" class="ms-auto me-auto mt-3">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Save</button>
                                      </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <a class="card-link" href="#">
                            <h5 class="card-title"> {{$post['title']}}</h5>
                        </a>

                        <p class="card-text">
                          {{$post['post']}}
                        </p>

                        @foreach(explode(",", $post['tag']) as $tag)
                        <a href="/explore/?tag={{$tag}}">{{$tag}}</a>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <form action="{{route('like', ['id' => $post['id']])}}" method="POST" class="ms-auto me-auto mt-3">
                          @csrf
                          <button type="submit" class="card-link"><i class="fa fa-gittip"></i> LIKE - {{$post['like_number']}}</button>
                        </form>
                        <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>
                        <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
                    </div>
                </div>
              @endforeach

            </div>
            <div class="col-md-3">
                <div class="card gedf-card">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                            card's content.</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
                <div class="card gedf-card">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                                card's content.</p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
  </body> 
</html> 
@endauth

@endsection    