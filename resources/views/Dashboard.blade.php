@extends('layout')
@section('title', 'all user tabel')
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
            <div class="col-md-3">
                <div class="card">
                    @auth
                    <div class="mr-2">
                      <img class="rounded-circle" width="65" src="https://picsum.photos/50/50" alt="">
                    </div>
                    <div class="card-body">
                        <div class="h5">{{auth()->user()->user_name}}</div>
                        <div class="h7 text-muted">Fullname : {{auth()->user()->first_name}}</div>
                        <div class="h7 text-muted">Lastname : {{auth()->user()->last_name}}</div>
                        <div class="h7 text-muted">Lastname : {{auth()->user()->email}}</div>
                        <div class="h7">Bio : hello i'm php web-developer</div>
                        <form action="#" method="POST" class="ms-auto me-auto mt-3">
                          @csrf
                          <a href="#" class="card-link"><i class="fa fa-edit"></i> Edit Profile</a>
                        </form>
                    </div>
                    @endauth
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="h6 text-muted">Followers</div>
                            <div class="h5">5.2342</div>
                        </li>
                        <li class="list-group-item">
                            <div class="h6 text-muted">Following</div>
                            <div class="h5">6758</div>
                        </li>
                        <li class="list-group-item">
                          <div class="h6 text-muted">Post Number</div>
                          <div class="h5">6758</div>
                      </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 gedf-main">
              @foreach ($posts as $post)
                                <div class="card gedf-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                                </div>
                                <div class="ml-2">
                                    <div class="h5 m-0">{{auth()->user()->user_name}}</div>
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
                            <h5 class="card-title"> {{$post['email']}}</h5>
                        </a>

                        <p class="card-text">
                          {{$post['address']}}
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
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