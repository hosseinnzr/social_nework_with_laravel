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
                    <div class="card-body">
                        <a class="card-link" href="#">
                            <h5 class="card-title"> {{$post['title']}}</h5>
                        </a>

                        <p class="card-text">
                          {{$post['post']}}
                        </p>

                        @foreach(explode(",", $post['tag']) as $tag)
                        <a href="/search/?tag={{$tag}}">{{$tag}}</a>
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
        </div>
    </div>
  </body> 
</html> 
@endauth

@endsection    