
<div class="offcanvas-body pt-0 custom-scrollbar">
    <br>
    <!-- show post START -->
    <div class="card">
        {{-- <!-- Card header START -->
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <!-- Avatar -->
                <div class="avatar me-2">
                <img class="avatar-img rounded-circle" src="{{$post['user_profile_pic']}}" alt="user_img">
                </div>
                <!-- Info -->
                <div>
                <h6 class="card-title mb-0"> <a href="/user/{{$post['user_name']}}">  {{$post['user_name']}}   </a></h6>
                <p class="small mb-0">{{$post['created_at']->diffForHumans()}}</p>
                </div>
            </div>
            <!-- Card share action START -->
            <div class="dropdown">
                <a href="#" class="text-secondary btn btn-secondary-soft-hover py-1 px-2" id="cardShareAction8" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-three-dots"></i>
                </a>
                <!-- Card share action dropdown menu -->
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardShareAction8">
                  <li><a class="dropdown-item" href="#"> <i class="bi bi-bookmark fa-fw pe-2"></i>Save post</a></li>
                  <li><a class="dropdown-item" href="#"> <i class="bi bi-person-x fa-fw pe-2"></i>Unfollow lori ferguson </a></li>
                  <li><a class="dropdown-item" href="#"> <i class="bi bi-slash-circle fa-fw pe-2"></i>Block</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#"> <i class="bi bi-flag fa-fw pe-2"></i>Report post</a></li>
                </ul>
                
            </div>
            <!-- Card share action START -->
            </div>
        </div>
        <!-- Card header START --> --}}
        
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
            <a >{{$tag}} </a>
            @endforeach
            
        </div>
        <!-- Card body END -->
        

    </div>
    <br>
    <!-- show post END -->

    <!-- Add comment -->
    <div class="d-flex mb-2">
        <!-- Avatar -->
        <div class="avatar avatar-xs me-2">
            <a href="#!"> <img class="avatar-img rounded-circle" src="{{auth()->user()->profile_pic}}" alt=""> </a>
        </div>

        <!-- Comment box START -->
        <div class="offcanvas-body p-0">
            <div class=" rounded-end-lg-0 border-end-lg-0">
              <!-- add comment START -->

              <form wire:submit="save({{$postId}})" >
                <label>             
                    <input wire:model="comment" name="comment" id="cmnt-input" class="form-control py-2" type="text" placeholder="Add Comment ..." aria-label="Search">
                </label>
                    <button class="btn btn-light" id="cmnt-btn" type="submit">  <i class="fa-solid fa-comment"></i></button>
              </form>
              <script>
                document.getElementById('cmnt-btn').addEventListener('click', function() {
                    document.getElementById('cmnt-input').value = '';
                })
              </script>
            </div>
        </div>
        <!-- Comment box END -->

    </div>
    <!-- Comment wrap START -->
    <ul class="comment-wrap list-unstyled">

        @foreach ($post_comments as $single_comment)

        <!-- Comment item START -->
        <br>
        <li wire:poll.visible class="comment-item">
            <div class="d-flex position-relative">
            <!-- Avatar -->
            <div class="avatar avatar-xs">
            <a href="#!"><img class="avatar-img rounded-circle" src="{{asset($single_comment['user_profile'])}}" alt=""></a>
            </div>
            <div style="width: 100%;" class="ms-2">
                <!-- Comment by -->
                <div class="bg-light rounded-start-top-0 p-3 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-1"> <a href="#!">{{$single_comment['user_name']}}</a></h6>
                        <p class="ms-2">{{$single_comment['created_at']->diffForHumans()}}</p>
                    </div>
                    <p class="small mb-0">{{$single_comment['comment_value']}}</p>
                </div>
                <!-- Comment react -->
                <ul class="nav py-2 small">

                    <li class="nav-item">
                        <div wire:poll.visible style="text-align: center">
                            @if (in_array(Auth::id(), explode(",", $single_comment['like'])))
                        
                                <button style="color:red" wire:click="like({{$single_comment}})"><i class="bi bi-heart-fill pe-1"></i>liked ( {{ $single_comment['like_number'] }} )</button>
                            @else
                                <button  wire:click="like({{$single_comment}})"><i class="bi bi-heart-fill pe-1"></i>like ( {{ $single_comment['like_number'] }} )</button>
                            @endif
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#!"> Reply</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#!"> View 5 replies</a>
                    </li>
                </ul>
            </div>
            </div>
            
        </li>
        <!-- Comment item END -->
        @endforeach

    </ul>
    <!-- Comment wrap END -->
</div>
