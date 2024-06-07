@extends('layout')
@section('title', 'profile')
@section('content')
@auth
{{ csrf_field() }}

<main>
  <!-- Container START -->
  <div class="container">
    <div class="row g-4">

      <!-- Left sidebar START -->
      <div class="col-lg-2">
      </div>
      <!-- Left sidebar END -->

      <!-- Center sidebar START -->
      <div style="padding: 0px" class="col-lg-8 vstack gap-0">

        <!-- My profile START -->
        <div class="card">
          <!-- Cover image -->
          <div class="h-90px rounded-top"></div>
            <!-- Card body START -->
            <div class="card-body py-0">
              <div class="d-sm-flex align-items-start text-center text-sm-start">
                <div>
                  <!-- Avatar -->
                  <div class="avatar avatar-xxxl mt-n5 mb-3">
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

                    <form action="{{route('conversation', ['id' => $user['id']])}}" method="POST" class="ms-auto me-auto mt-3">
                      @csrf
                      <button type="submit" class="btn btn-success-soft me-2"><i class="fa bi-chat-left-text-fill"></i> message</button>
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
                <li class="list-inline-item">{{$user['biography']}} </li>
                <br><br>
                <li class="list-inline-item"> <i class="bi bi-calendar-date fa-fw pe-1"></i> Birthday : {{ str_replace("-", ".", $user['birthday']) }} </li>
                <li class="list-inline-item"> <i class="bi bi-envelope fa-fw pe-1"></i> Email: {{$user['email']}}</li>
                <li class="list-inline-item"><i class="bi bi-calendar2-plus me-1"></i> Joined on {{$user['created_at']->format('Y-m-d')}}</li>
              </ul>
              
              <br>
              <!-- Tab nav line START -->
              <ul class="nav nav-tabs nav-bottom-line justify-content-center justify-content-md-start">
                <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#tab-1"> Your post </a> </li>
                <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#tab-2"> Save post </a> </li>
              </ul>
              <!-- Tab nav line START -->
              
        <!-- My profile END -->

          <!-- Card body START -->
            <div style="padding: 4px 0px 15px 0px" class="card-body">

              <!-- Album Tab content START -->
              <div class="tab-content mb-0 pb-0">
  
                <!-- your post tab START -->
                <div class="tab-pane fade show active" id="tab-1">
                  <div class="row g-3">
                    
                    @foreach ($posts as $post)
                      <!-- Photo item START -->
                      <div class="col-4 col-lg-4 position-relative">

                        <div data-bs-toggle="modal" data-bs-target="#showComments{{$post['id']}}" aria-controls="offcanvasChat">
                          <img class="img-fluid" src={{$post['post_picture']}} alt="">
                        </div>

                            <!-- scroll show post START -->
                            <div class="modal fade" id="showComments{{$post['id']}}" tabindex="-1" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">

                                  <!-- Modal feed header START -->
                                  <div class="modal-header">

                                    <div class="d-flex align-items-center justify-content-between">
                                      <div class="d-flex align-items-center">
                                        <!-- Avatar -->
                                        <div class="avatar me-2">
                                          <img class="avatar-img rounded-circle" src={{$user['profile_pic']}} alt="">
                                        </div>
                                        <!-- Info -->
                                        <div>
                                          <div class="nav nav-divider">
                                            <h6 class="nav-item card-title mb-0"><a href="/user/{{$user['user_name']}}">{{$user['user_name']}} </a></h6>
                                            <span class="nav-item small"> {{$post['created_at']->diffForHumans()}}</span>
                                          </div>
                                          {{-- <p class="mb-0 small">{{$user['user_name']}}</p> --}}
                                        </div>
                                      </div>
                                      <!-- Card feed action dropdown START -->
                                      <div class="dropdown">
                                        <a href="#" class="text-secondary btn btn-secondary-soft-hover py-1 px-2" id="cardShareAction8" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <!-- Card share action dropdown menu -->     
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardShareAction8">
                                          <li><a style="color: rgb(10, 0, 195)" class="dropdown-item" type="submit" href="{{ route('post', ['id' => $post['id']]) }}"> <i class="bi bi-pencil fa-fw pe-2"></i>Edit post</a></li>
                                          <li><a class="dropdown-item" href="#"> <i class="bi bi-archive fa-fw pe-2"></i>Archive</a></li>
                                          <li><a style="color: red" class="dropdown-item" type="submit" href="{{ route('delete', ['id' => $post['id']]) }}"> <i class="bi bi-x-circle fa-fw pe-2"></i>Delete post</a></li>
                                        </ul>
                
                                      </div>
                                      <!-- Card feed action dropdown END -->
                                    </div>
                                    
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <!-- Modal feed header END -->

                                  <!-- show post START -->
                                    <div class="card-body">
                                      <div class="row g-3">

                                        <div class="col-12 col-lg-6">
                                          @isset($post['post_picture'])
                                          <img class="card-img" src="{{$post['post_picture']}}" alt="Post">
                                          @endisset 
                                          <br>
                                          <ul class="nav nav-fill nav-stack small">
                                            <li class="nav-item">
                                              @livewire('like-post', ['post' => $post])
                                            </li>
                  
                                            <li class="nav-item">
                                              <div data-bs-toggle="modal">
                                                <small style="text-align: center" class="mb-0"> <i class="bi bi-send fa-xl pe-1"></i></small>
                                              </div>
                                            </li>
                  
                                            <li class="nav-item">
                                              @livewire('save-post', ['postId' => $post['id']]) 
                                            </li>

                                          </ul>

                                        </div>

                                        <div class="col-12 col-lg-6">

                                          <div class="comments-container" style="height: 420px; overflow-y: auto;">
                                            <p style="width: 100%;" class="mb-0">{{$post['post']}}</p>

                                            @foreach(explode(",", $post['tag']) as $tag)
                                            <a href="/?tag={{$tag}}">{{$tag}} </a>
                                            @endforeach
                                            <br>
                                            <br>
                                            @livewire('add-comments', ['postId' => $post['id'], 'post' => $post])
                                          </div>

                                        </div>

                                      </div>
                                    </div>
                                  <!-- show post END -->
                                </div>
                              </div>
                            </div>
                            <!-- scroll show post END -->

                        <!-- glightbox Albums left bar START -->
                        <div class="glightbox-desc custom-desc2">
                          <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                              <!-- Avatar -->
                              <div class="avatar me-2">
                                <img class="avatar-img rounded-circle" src={{$user['profile_pic']}} alt="">
                              </div>
                              <!-- Info -->
                              <div>
                                <div class="nav nav-divider">
                                  <h6 class="nav-item card-title mb-0"><a href="/user/{{$user['user_name']}}">{{$user['user_name']}}</a></h6>
                                  <span class="nav-item small"> {{$post['created_at']->diffForHumans()}}</span>
                                </div>
                                <p class="mb-0 small">Web Developer at Webestica</p>
                              </div>
                            </div>
                            <!-- Card feed action dropdown START -->
                            <div class="dropdown">
                              <a href="#" class="text-secondary btn btn-secondary-soft-hover py-1 px-2" id="cardShareAction8" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="bi bi-three-dots"></i>
                              </a>
                              <!-- Card share action dropdown menu -->     
                              @if ($post['UID'] == Auth::id())
                              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardShareAction8">
                                <li><a style="color: rgb(10, 0, 195)" class="dropdown-item" type="submit" href="{{ route('post', ['id' => $post['id']]) }}"> <i class="bi bi-pencil fa-fw pe-2"></i>Edit post</a></li>
                                <li><a class="dropdown-item" href="#"> <i class="bi bi-archive fa-fw pe-2"></i>Archive</a></li>
                                <li><a style="color: red" class="dropdown-item" type="submit" href="{{ route('delete', ['id' => $post['id']]) }}"> <i class="bi bi-x-circle fa-fw pe-2"></i>Delete post</a></li>
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
                            <!-- Card feed action dropdown END -->
                          </div>
                          <h6 class="mt-3 mb-0">{{$post['title']}}</h6>
                          <p class="mt-3 mb-0">{{$post['post']}}</p>

                          <ul class="nav nav-fill nav-stack small">
                            <li class="nav-item">
                              @livewire('like-post', ['post' => $post])
                            </li>
  
                            <li class="nav-item">
                              <div data-bs-toggle="modal">
                                <small style="text-align: center" class="mb-0"> <i class="bi bi-send fa-xl pe-1"></i></small>
                              </div>
                            </li>
  
                            <li class="nav-item">
                              @livewire('save-post', ['postId' => $post['id']]) 
                            </li>
                          </ul>
                          <br>
                        </div>
                        <!-- glightbox Albums left bar END  -->
                      </div>
                      <!-- Photo item END -->
                    @endforeach

                  </div>

                </div>
                <!-- your post tab END -->
  
                <!-- Save photos tab START -->
                <div class="tab-pane fade" id="tab-2">
                  <div class="row g-3">
                    
                    @foreach ($save_posts as $save_post)
                      <!-- Photo item START -->
                      <div class="col-4 col-lg-4 position-relative">

                        <div data-bs-toggle="modal" data-bs-target="#showSavePost{{$save_post['id']}}" aria-controls="offcanvasChat">
                          <img class="img-fluid" src={{$save_post['post_picture']}} alt="">
                        </div>

                            <!-- scroll show post START -->
                            <div class="modal fade" id="showSavePost{{$save_post['id']}}" tabindex="-1" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">

                                  <!-- Modal feed header START -->
                                  <div class="modal-header">

                                    <div class="d-flex align-items-center justify-content-between">
                                      <div class="d-flex align-items-center">
                                        <!-- Avatar -->
                                        <div class="avatar me-2">
                                          <img class="avatar-img rounded-circle" src={{$save_post['user_profile_pic']}}>
                                        </div>
                                        <!-- Info -->
                                        <div>
                                          <div class="nav nav-divider">
                                            <h6 class="nav-item card-title mb-0"><a href="/user/{{$save_post['user_name']}}">{{$save_post['user_name']}}</a></h6>
                                            
                                            <small>&nbsp; &nbsp;{{$save_post['created_at']->diffForHumans()}}</small>

                                          </div>
                                          {{-- <p class="mb-0 small">{{$user['user_name']}}</p> --}}
                                        </div>
                                      </div>
                                      <!-- Card feed action dropdown START -->
                                      <div class="dropdown">
                                        <a href="#" class="text-secondary btn btn-secondary-soft-hover py-1 px-2" id="cardShareAction8" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <!-- Card share action dropdown menu -->     
                                        @if ($save_post['UID'] == Auth::id())
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardShareAction8">
                                          <li><a style="color: rgb(10, 0, 195)" class="dropdown-item" type="submit" href="{{ route('post', ['id' => $save_post['id']]) }}"> <i class="bi bi-pencil fa-fw pe-2"></i>Edit post</a></li>
                                          <li><a class="dropdown-item" href="#"> <i class="bi bi-archive fa-fw pe-2"></i>Archive</a></li>
                                          <li><a style="color: red" class="dropdown-item" type="submit" href="{{ route('delete', ['id' => $save_post['id']]) }}"> <i class="bi bi-x-circle fa-fw pe-2"></i>Delete post</a></li>
                                        </ul>
                                        @else
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardShareAction8">
                                          <li><a class="dropdown-item" href="#"> <i class="bi bi-person-x fa-fw pe-2"></i>Unfollow {{$user['user_name']}}</a></li>
                                          <li><a class="dropdown-item" href="#"> <i class="bi bi-slash-circle fa-fw pe-2"></i>Block {{$user['user_name']}}</a></li>
                                          <li><hr class="dropdown-divider"></li>
                                          <li><a class="dropdown-item" href="#"> <i class="bi bi-flag fa-fw pe-2"></i>Report post</a></li>
                                        </ul>
                                        @endif                 
                                      </div>
                                      <!-- Card feed action dropdown END -->
                                    </div>
                                    
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <!-- Modal feed header END -->

                                  <!-- show post START -->
                                    <!-- Card body START -->
                                    <div class="card-body">
                                      <div class="row g-3">

                                        <div class="col-12 col-lg-6">
                                          @isset($save_post['post_picture'])
                                          <img class="card-img" src="{{$save_post['post_picture']}}" alt="Post">
                                          @endisset 
                                          <br>
                                          <ul class="nav nav-fill nav-stack small">
                                            <li class="nav-item">
                                              @livewire('like-post', ['post' => $save_post])
                                            </li>
                  
                                            <li class="nav-item">
                                              <div data-bs-toggle="modal">
                                                <small style="text-align: center" class="mb-0"> <i class="bi bi-send fa-xl pe-1"></i></small>
                                              </div>
                                            </li>
                  
                                            <li class="nav-item">
                                              @livewire('save-post', ['postId' => $save_post['id']]) 
                                            </li>

                                          </ul>

                                        </div>

                                        <div class="col-12 col-lg-6">

                                          <div class="comments-container" style="height: 420px; overflow-y: auto;">
                                            <p style="width: 100%;" class="mb-0">{{$save_post['post']}}</p>

                                            @foreach(explode(",", $save_post['tag']) as $tag)
                                            <a href="/?tag={{$tag}}">{{$tag}} </a>
                                            @endforeach
                                            <br>
                                            <br>
                                            @livewire('add-comments', ['postId' => $save_post['id'], 'post' => $save_post])
                                          </div>

                                        </div>

                                      </div>
                                    </div>
                                    <!-- Card body END -->
                                  <!-- show post END -->
                                </div>
                              </div>
                            </div>
                            <!-- scroll show post END -->

                        <!-- glightbox Albums left bar START -->
                        <div class="glightbox-desc custom-desc2">
                          <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                              <!-- Avatar -->
                              <div class="avatar me-2">
                                <img class="avatar-img rounded-circle" src={{$user['profile_pic']}} alt="">
                              </div>
                              <!-- Info -->
                              <div>
                                <div class="nav nav-divider">
                                  <h6 class="nav-item card-title mb-0"><a href="/user/{{$user['user_name']}}">{{$user['user_name']}}</a></h6>
                                  <span class="nav-item small"> {{$post['created_at']->diffForHumans()}}</span>
                                </div>
                                <p class="mb-0 small">Web Developer at Webestica</p>
                              </div>
                            </div>
                            <!-- Card feed action dropdown START -->
                            <div class="dropdown">
                              <a href="#" class="text-secondary btn btn-secondary-soft-hover py-1 px-2" id="cardShareAction8" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="bi bi-three-dots"></i>
                              </a>
                              <!-- Card share action dropdown menu -->     
                              @if ($post['UID'] == Auth::id())
                              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardShareAction8">
                                <li><a style="color: rgb(10, 0, 195)" class="dropdown-item" type="submit" href="{{ route('post', ['id' => $post['id']]) }}"> <i class="bi bi-pencil fa-fw pe-2"></i>Edit post</a></li>
                                <li><a class="dropdown-item" href="#"> <i class="bi bi-archive fa-fw pe-2"></i>Archive</a></li>
                                <li><a style="color: red" class="dropdown-item" type="submit" href="{{ route('delete', ['id' => $post['id']]) }}"> <i class="bi bi-x-circle fa-fw pe-2"></i>Delete post</a></li>
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
                            <!-- Card feed action dropdown END -->
                          </div>
                          <h6 class="mt-3 mb-0">{{$post['title']}}</h6>
                          <p class="mt-3 mb-0">{{$post['post']}}</p>

                          <ul class="nav nav-fill nav-stack small">
                            <li class="nav-item">
                              @livewire('like-post', ['post' => $post])
                            </li>
  
                            <li class="nav-item">
                              <div data-bs-toggle="modal">
                                <small style="text-align: center" class="mb-0"> <i class="bi bi-send fa-xl pe-1"></i></small>
                              </div>
                            </li>
  
                            <li class="nav-item">
                              @livewire('save-post', ['postId' => $post['id']]) 
                            </li>
                          </ul>
                          <br>
                        </div>
                        <!-- glightbox Albums left bar END  -->
                      </div>
                      <!-- Photo item END -->
                    @endforeach

                  </div>
                </div>
                <!-- Save photos tab END -->
                
              </div>
  
            <!-- Album Tab content END -->
            </div>
          <!-- Card body END -->
          </div>
        <!-- Card END -->
        </div>
        <br>
        <!-- show post START -->
        <div class="col-md-12 col-lg-12 vstack gap-4">
        </div>
        <!-- show post END -->

      </div>
      <!-- Center sidebar END -->


      <!-- Right sidebar START -->
      <div class="col-lg-2">
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