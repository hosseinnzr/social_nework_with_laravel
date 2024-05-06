@extends('layout')
@section('title', 'profile')
@section('content')
@auth
{{ csrf_field() }}

<main>
  <!-- Container START -->
  <div class="container">
    <div class="row g-4">

      <!-- Main content START -->
      <div class="col-lg-8 vstack gap-4">
        <!-- My profile START -->
        <div class="card">
          <!-- Cover image -->
          <div class="h-200px rounded-top" style="background-image:url(assets/images/bg/05.jpg); background-position: center; background-size: cover; background-repeat: no-repeat;"></div>
            <!-- Card body START -->
            <div class="card-body py-0">
              <div class="d-sm-flex align-items-start text-center text-sm-start">
                <div>
                  <!-- Avatar -->
                  <div class="avatar avatar-xxl mt-n5 mb-3">
                    <img class="avatar-img rounded-circle border border-white border-3" src="{{$user['profile_pic']}}" alt="">
                  </div>
                </div>
                <div class="ms-sm-4 mt-sm-3">
                  <!-- Info -->
                  <h1 class="mb-0 h5">{{$user['first_name']}} {{$user['last_name']}} <i class="bi bi-patch-check-fill text-success small"></i></h1>
                    
                  <!-- post, follow, following START -->
                    <x-post-follower-following :user="$user"/>
                  <!-- post, follow, following END -->

                </div>
                <!-- Button -->
                <div class="d-flex mt-3 justify-content-center ms-sm-auto">

                  @if ($user['user_name'] == auth()->user()->user_name)
                    <a class="btn btn-success-soft me-2" type="submit" href="{{ route('post') }}">
                      <span><i class="fa fa-add"></i> Add post</span>
                    </a>  
                  @elseif ( in_array(auth()->id(), explode(",", $user['followers'])) )                            
                    <form action="{{route('follow', ['id' => $user['id']])}}" method="POST" class="ms-auto me-auto mt-3">
                      @csrf
                      <button type="submit" class="btn btn-primary-soft me-2"><i class="fa fa-user"></i> unfollow</button>
                    </form>
                  @else 
                    <form action="{{route('follow', ['id' => $user['id']])}}" method="POST" class="ms-auto me-auto mt-3">
                      @csrf
                      <button type="submit" class="btn btn-primary-soft me-2"><i class="fa fa-user"></i> follow</button>
                    </form> 
                  @endif

                </div>
              </div>
              <!-- List profile -->
              <ul class="list-inline mb-0 text-center text-sm-start mt-3 mt-sm-0">
                <li class="list-inline-item"><i class="bi bi-briefcase me-1"></i> Lead Developer</li>
                <li class="list-inline-item"><i class="bi bi-geo-alt me-1"></i> New Hampshire</li>
                <li class="list-inline-item"><i class="bi bi-calendar2-plus me-1"></i> Joined on {{$user['created_at']}}</li>
              </ul>
            </div>
            <!-- Card body END -->
            <div class="card-footer mt-3 pt-2 pb-0">
              <!-- Nav profile pages -->
              <ul class="nav nav-bottom-line align-items-center justify-content-center justify-content-md-start mb-0 border-0">
                <li class="nav-item"> <a class="nav-link active" href="my-profile.html"> Posts </a> </li>
                <li class="nav-item"> <a class="nav-link" href="my-profile-about.html"> About </a> </li>
                <li class="nav-item"> <a class="nav-link" href="my-profile-connections.html"> Connections <span class="badge bg-success bg-opacity-10 text-success small"> 230</span> </a> </li>
                <li class="nav-item"> <a class="nav-link" href="my-profile-media.html"> Media</a> </li>
                <li class="nav-item"> <a class="nav-link" href="my-profile-videos.html"> Videos</a> </li>
                <li class="nav-item"> <a class="nav-link" href="my-profile-events.html"> Events</a> </li>
                <li class="nav-item"> <a class="nav-link" href="my-profile-activity.html"> Activity</a> </li>
              </ul>
            </div>
          </div>
          <!-- My profile END -->

      <!-- Main content START -->
      <div class="col-md-12 col-lg-12 vstack gap-4">
        <!-- Card feed item START -->
        @foreach ($posts as $post)
            <div class="card">
            <!-- Card header START -->
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <!-- Avatar -->
                    <div class="avatar me-2">
                    <a href="#!"> <img class="avatar-img rounded-circle" src="{{$user['profile_pic']}}" alt=""> </a>
                    </div>
                    <!-- Info -->
                    <div>
                    <h6 class="card-title mb-0"> <a href="/user/{{$user['user_name']}}">{{$user['user_name']}}</a></h6>
                    <p class="small mb-0">{{$post['created_at']->diffForHumans()}}</p>
                    </div>
                </div>
                <!-- Card share action START -->
                <div class="dropdown">
                    <a href="#" class="text-secondary btn btn-secondary-soft-hover py-1 px-2" id="cardShareAction8" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-three-dots"></i>
                    </a>
                    <!-- Card share action dropdown menu -->     
                    @if ($post['UID'] == Auth::id())
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardShareAction8">
                      <li><a class="dropdown-item" type="submit" href="{{ route('post', ['id' => $post['id']]) }}"> <i class="bi bi-pencil fa-fw pe-2"></i>Edit post</a></li>
                      <li><a class="dropdown-item" href="#"> <i class="bi bi-bookmark fa-fw pe-2"></i>Save post</a></li>
                      <li><a class="dropdown-item" href="#"> <i class="bi bi-archive fa-fw pe-2"></i>Archive</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" type="submit" href="{{ route('delete', ['id' => $post['id']]) }}"> <i class="bi bi-x-circle fa-fw pe-2"></i>Delete post</a></li>
                    </ul>
                    @else
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardShareAction8">
                      <li><a class="dropdown-item" href="#"> <i class="bi bi-bookmark fa-fw pe-2"></i>Save post</a></li>
                      <li><a class="dropdown-item" href="#"> <i class="bi bi-person-x fa-fw pe-2"></i>Unfollow {{$user['user_name']}}</a></li>
                      <li><a class="dropdown-item" href="#"> <i class="bi bi-slash-circle fa-fw pe-2"></i>Block {{$user['user_name']}}</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#"> <i class="bi bi-flag fa-fw pe-2"></i>Report post</a></li>
                    </ul>
                    @endif                 
                </div>
                <!-- Card share action START -->
                </div>
            </div>
            <!-- Card header START -->
            <!-- Card body START -->
            <div class="card-body">
                <h5>{{$post['title']}}</h5>
                <p class="mb-0">{{$post['post']}}</p>
                <br>

                @isset($post['post_picture'])
                  <img class="card-img" src="{{$post['post_picture']}}" alt="Post">
                  <br>    
                @endisset

                @foreach(explode(",", $post['tag']) as $tag)
                <a href="/user/{{auth()->user()->user_name}}?tag={{$tag}}">{{$tag}}</a>
                @endforeach
            </div>
            <!-- Card body END -->
            <!-- Card Footer START -->
            <div class="card-footer py-3">
                <!-- Feed react START -->
                <ul class="nav nav-fill nav-stack small">
                <li class="nav-item">

                  @livewire('like-post', ['post' => $post])

                </li>

                <li class="nav-item">
                  <div data-bs-toggle="offcanvas" href="#showComments{{$post['id']}}" role="button" aria-controls="offcanvasChat">
                    <small style="text-align: center" class="mb-0"> <i class="bi bi-chat-fill pe-1"></i> Comments</small>
                  </div>
                </li>

                <!-- scroll show comment START -->
                  <div class="d-block d-lg-block">
                    <div class="offcanvas offcanvas-end" data-bs-scroll="false" tabindex="-1" id="showComments{{$post['id']}}">

                        <!-- Close Start -->
                        <div class="offcanvas-header d-flex justify-content-between">
                            <h5 class="offcanvas-title">Comment</h5>
                            <div class="d-flex">
                                <!-- Close  -->
                                <a href="#" class="btn btn-secondary-soft-hover py-1 px-2" data-bs-dismiss="offcanvas" aria-label="Close">
                                <i class="fa-solid fa-xmark"></i>
                                </a>
                            </div>
                        </div>
                        <!-- Close END -->

                            @livewire('add-comments', ['postId' => $post['id']])
                    </div>
                  </div>
                <!-- scroll show comment END -->

                <li class="nav-item">
                    <form action="#" method="POST" class="ms-auto me-auto mt-3">
                        @csrf
                        <button style="font-size: 12px" type="submit" class="btn btn-link"><i class="bi bi-send-fill pe-1"></i>Send</button>
                    </form>
                </li>
                </ul>
                <!-- Feed react END -->
            </div>
            <!-- Card Footer END -->
            </div>
        @endforeach
        <!-- Card feed item END -->
      </div>
      <!-- Main content END -->
    </div>
      <!-- Right sidebar START -->
      <div class="col-lg-4">
        <div class="row g-4">
          <!-- Card START -->
          <div class="col-md-6 col-lg-12">
            <div class="card">
              <div class="card-header border-0 pb-0">
                <h5 class="card-title">Biography :</h5>
                <!-- Button modal -->
              </div>
              <!-- Card body START -->
              <div class="card-body position-relative pt-0">
                <p>{{$user['biography']}}</p>
                <!-- Date time -->
                <ul class="list-unstyled mt-3 mb-0">
                  <li class="mb-2"> <i class="bi bi-calendar-date fa-fw pe-1"></i> Birthday : <strong> {{ str_replace("-", ".", $user['birthday']) }} </strong> </li>
                  <li class="mb-2"> <i class="bi bi-heart fa-fw pe-1"></i> Status : <strong> Single </strong> </li>
                  <li> <i class="bi bi-envelope fa-fw pe-1"></i> Email : <strong> {{$user['email']}} </strong> </li>
                </ul>
              </div>
              <!-- Card body END -->
            </div>
          </div>
          <!-- Card END -->

          <!-- Card START -->
          <div class="col-md-6 col-lg-12">
            <div class="card">
              <!-- Card header START -->
              <div class="card-header d-flex justify-content-between border-0">
                <h5 class="card-title">Experience</h5>
                <a class="btn btn-primary-soft btn-sm" href="#!"> <i class="fa-solid fa-plus"></i> </a>
              </div>
              <!-- Card header END -->
              <!-- Card body START -->
              <div class="card-body position-relative pt-0">
                <!-- Experience item START -->
                <div class="d-flex">
                  <!-- Avatar -->
                  <div class="avatar me-3">
                    <a href="#!"> <img class="avatar-img rounded-circle" src="{{asset("assets/images/logo/08.svg")}}" alt=""> </a>
                  </div>
                  <!-- Info -->
                  <div>
                    <h6 class="card-title mb-0"><a href="#!"> Apple Computer, Inc. </a></h6>
                    <p class="small">May 2015 – Present Employment Duration 8 mos <a class="btn btn-primary-soft btn-xs ms-2" href="#!">Edit </a></p>
                  </div>
                </div>
                <!-- Experience item END -->

                <!-- Experience item START -->
                <div class="d-flex">
                  <!-- Avatar -->
                  <div class="avatar me-3">
                    <a href="#!"> <img class="avatar-img rounded-circle" src="{{asset("assets/images/logo/09.svg")}}" alt=""> </a>
                  </div>
                  <!-- Info -->
                  <div>
                    <h6 class="card-title mb-0"><a href="#!"> Microsoft Corporation </a></h6>
                    <p class="small">May 2017 – Present Employment Duration 1 yrs 5 mos <a class="btn btn-primary-soft btn-xs ms-2" href="#!">Edit </a></p>
                  </div>
                </div>
                <!-- Experience item END -->

                <!-- Experience item START -->
                <div class="d-flex">
                  <!-- Avatar -->
                  <div class="avatar me-3">
                    <a href="#!"> <img class="avatar-img rounded-circle" src="{{asset("assets/images/logo/10.svg")}}" alt=""> </a>
                  </div>
                  <!-- Info -->
                  <div>
                    <h6 class="card-title mb-0"><a href="#!"> Tata Consultancy Services. </a></h6>
                    <p class="small mb-0">May 2022 – Present Employment Duration 6 yrs 10 mos <a class="btn btn-primary-soft btn-xs ms-2" href="#!">Edit </a></p>
                  </div>
                </div>
                <!-- Experience item END -->

              </div>
              <!-- Card body END -->
            </div>
          </div>
          <!-- Card END -->
          
          <!-- Card START -->
          <div class="col-md-6 col-lg-12">
            <div class="card">
              <!-- Card header START -->
              <div class="card-header d-sm-flex justify-content-between border-0">
                <h5 class="card-title">Photos</h5>
                <a class="btn btn-primary-soft btn-sm" href="#!"> See all photo</a>
              </div>
              <!-- Card header END -->
              <!-- Card body START -->
              <div class="card-body position-relative pt-0">
                <div class="row g-2">
                  <!-- Photos item -->
                  <div class="col-6">
                    <a href="{{asset("assets/images/albums/01.jpg")}}" data-gallery="image-popup" data-glightbox="">
                      <img class="rounded img-fluid" src="{{asset("assets/images/albums/01.jpg")}}" alt="">
                    </a>
                  </div>
                  <!-- Photos item -->
                  <div class="col-6">
                    <a href="{{asset("assets/images/albums/02.jpg")}}" data-gallery="image-popup" data-glightbox="">
                      <img class="rounded img-fluid" src="{{asset("assets/images/albums/02.jpg")}}" alt="">
                    </a>
                  </div>
                  <!-- Photos item -->
                  <div class="col-4">
                    <a href="{{asset("assets/images/albums/03.jpg")}}" data-gallery="image-popup" data-glightbox="">
                      <img class="rounded img-fluid" src="{{asset("assets/images/albums/03.jpg")}}" alt="">
                    </a>
                  </div>
                  <!-- Photos item -->
                  <div class="col-4">
                    <a href="{{asset("assets/images/albums/04.jpg")}}" data-gallery="image-popup" data-glightbox="">
                      <img class="rounded img-fluid" src="{{asset("assets/images/albums/04.jpg")}}" alt="">
                    </a>
                  </div>
                  <!-- Photos item -->
                  <div class="col-4">
                    <a href="{{asset("assets/images/albums/05.jpg")}}" data-gallery="image-popup" data-glightbox="">
                      <img class="rounded img-fluid" src="{{asset("assets/images/albums/05.jpg")}}" alt="">
                    </a>
                    <!-- glightbox Albums left bar END  -->
                  </div>
                </div>
              </div>
              <!-- Card body END -->
            </div>
          </div>
          <!-- Card END -->

          <!-- Card START -->
          <div class="col-md-6 col-lg-12">
            <div class="card">
              <!-- Card header START -->
              <div class="card-header d-sm-flex justify-content-between align-items-center border-0">
                <h5 class="card-title">Friends <span class="badge bg-danger bg-opacity-10 text-danger">230</span></h5>
                <a class="btn btn-primary-soft btn-sm" href="#!"> See all friends</a>
              </div>
              <!-- Card header END -->
              <!-- Card body START -->
              <div class="card-body position-relative pt-0">
                <div class="row g-3">

                  <div class="col-6">
                    <!-- Friends item START -->
                    <div class="card shadow-none text-center h-100">
                      <!-- Card body -->
                      <div class="card-body p-2 pb-0">
                        <div class="avatar avatar-story avatar-xl">
                          <a href="#!"><img class="avatar-img rounded-circle" src="{{asset("assets/images/avatar/02.jpg")}}" alt=""></a>
                        </div>
                        <h6 class="card-title mb-1 mt-3"> <a href="#!"> Amanda Reed </a></h6>
                        <p class="mb-0 small lh-sm">16 mutual connections</p>
                      </div>
                      <!-- Card footer -->
                      <div class="card-footer p-2 border-0">
                        <button class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Send message"> <i class="bi bi-chat-left-text"></i> </button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove friend"> <i class="bi bi-person-x"></i> </button>
                      </div>
                    </div>
                    <!-- Friends item END -->
                  </div>

                  <div class="col-6">
                    <!-- Friends item START -->
                    <div class="card shadow-none text-center h-100">
                      <!-- Card body -->
                      <div class="card-body p-2 pb-0">
                        <div class="avatar avatar-xl">
                          <a href="#!"><img class="avatar-img rounded-circle" src="{{asset("assets/images/avatar/03.jpg")}}" alt=""></a>
                        </div>
                        <h6 class="card-title mb-1 mt-3"> <a href="#!"> Samuel Bishop </a></h6>
                        <p class="mb-0 small lh-sm">22 mutual connections</p>
                      </div>
                      <!-- Card footer -->
                      <div class="card-footer p-2 border-0">
                        <button class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Send message"> <i class="bi bi-chat-left-text"></i> </button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove friend"> <i class="bi bi-person-x"></i> </button>
                      </div>
                    </div>
                    <!-- Friends item END -->
                  </div>

                  <div class="col-6">
                    <!-- Friends item START -->
                    <div class="card shadow-none text-center h-100">
                      <!-- Card body -->
                      <div class="card-body p-2 pb-0">
                        <div class="avatar avatar-xl">
                          <a href="#!"><img class="avatar-img rounded-circle" src="{{asset("assets/images/avatar/04.jpg")}}" alt=""></a>
                        </div>
                        <h6 class="card-title mb-1 mt-3"> <a href="#"> Bryan Knight </a></h6>
                        <p class="mb-0 small lh-sm">1 mutual connection</p>
                      </div>
                      <!-- Card footer -->
                      <div class="card-footer p-2 border-0">
                        <button class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Send message"> <i class="bi bi-chat-left-text"></i> </button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove friend"> <i class="bi bi-person-x"></i> </button>
                      </div>
                    </div>
                    <!-- Friends item END -->
                  </div>

                  <div class="col-6">
                    <!-- Friends item START -->
                    <div class="card shadow-none text-center h-100">
                      <!-- Card body -->
                      <div class="card-body p-2 pb-0">
                        <div class="avatar avatar-xl">
                          <a href="#!"><img class="avatar-img rounded-circle" src="{{asset("assets/images/avatar/05.jpg")}}" alt=""></a>
                        </div>
                        <h6 class="card-title mb-1 mt-3"> <a href="#!"> Amanda Reed </a></h6>
                        <p class="mb-0 small lh-sm">15 mutual connections</p>
                      </div>
                      <!-- Card footer -->
                      <div class="card-footer p-2 border-0">
                        <button class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Send message"> <i class="bi bi-chat-left-text"></i> </button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove friend"> <i class="bi bi-person-x"></i> </button>
                      </div>
                    </div>
                    <!-- Friends item END -->
                  </div>

                </div>
              </div>
              <!-- Card body END -->
            </div>
          </div>
          <!-- Card END -->
        </div>

      </div>
      <!-- Right sidebar END -->

    </div> <!-- Row END -->
  </div>
  <!-- Container END -->
</main>

  <!-- Show follower/following START -->
    <x-show-follower-following :following="$following_user" :follower="$follower_user" />
  <!-- Show follower/following END -->


@endauth
@endsection    