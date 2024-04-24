@extends('layout')
@section('title', 'explor')
@section('title1', 'explor')
@section('content')
@auth
{{ csrf_field() }}

<html> 
    <head> 
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <!------ Include the above in your HEAD tag ---------->
      
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
              crossorigin="anonymous">
              
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
              crossorigin="anonymous"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
              crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
              crossorigin="anonymous"></script>
      <style> 
            h1{
              font-size: 30px;
              color: #fff;
              text-transform: uppercase;
              font-weight: 300;
              text-align: center;
              margin-bottom: 15px;
            }
            table{
              width:100%;
              table-layout: fixed;
            }
            .tbl-header{
              background-color: rgba(255,255,255,0.3);
             }
            .tbl-content{
              height:300px;
              overflow-x:auto;
              margin-top: 0px;
              border: 1px solid rgba(255,255,255,0.3);
            }
            th{
              padding: 20px 15px;
              text-align: left;
              font-weight: 500;
              font-size: 12px;
              color: #fff;
              text-transform: uppercase;
            }
            td{
              padding: 15px;
              text-align: left;
              vertical-align:middle;
              font-weight: 300;
              font-size: 12px;
              color: #fff;
              border-bottom: solid 1px rgba(255,255,255,0.1);
            }


            /* demo styles */

            @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
            body{
              background: -webkit-linear-gradient(left, #25c481, #25b7c4);
              background: linear-gradient(to right, #25c481, #25b7c4);
              font-family: 'Roboto', sans-serif;
            }
            section{
              margin: 50px;
            }

            /* follow me template */
            .made-with-love {
              margin-top: 40px;
              padding: 10px;
              clear: left;
              text-align: center;
              font-size: 10px;
              font-family: arial;
              color: #fff;
            }
            .made-with-love i {
              font-style: normal;
              color: #F50057;
              font-size: 14px;
              position: relative;
              top: 2px;
            }
            .made-with-love a {
              color: #fff;
              text-decoration: none;
            }
            .made-with-love a:hover {
              text-decoration: underline;
            }

            /* for custom scrollbar for webkit browser*/

            ::-webkit-scrollbar {
                width: 6px;
            } 
            ::-webkit-scrollbar-track {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
            } 
            ::-webkit-scrollbar-thumb {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
            }
            body {
            background-color: #eeeeee;
           }

        .h7 {
            font-size: 0.8rem;
        }

        .gedf-wrapper {
            margin-top: 0.97rem;
        }

        @media (min-width: 992px) {
            .gedf-main {
                padding-left: 4rem;
                padding-right: 4rem;
            }
            .gedf-card {
                margin-bottom: 2.77rem;
            }
        }

        /**Reset Bootstrap*/
        .dropdown-toggle::after {
            content: none;
            display: none;
        }
       </style> 
    </head> 
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