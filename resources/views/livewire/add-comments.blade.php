
<div style="width: 100%; padding: 0px"  class="offcanvas-body pt-0 custom-scrollbar">

    <!-- Add comment START -->
    <div class="d-flex mb-2 pt-3">
        <!-- Avatar -->
        <div class="avatar avatar-xs me-2">
            <a href="/user/{{auth()->user()->user_name}}"> <img class="avatar-img rounded-circle" src="{{auth()->user()->profile_pic}}" alt=""> </a>
        </div>

        <!-- Comment box START -->
        <div  class="offcanvas-body p-0">
            <div style="position: sticky; top: 500;" class=" rounded-end-lg-0 w-full border-end-lg-0">
                <!-- add comment START -->

                <form wire:submit="save({{$postId}})" >
                <label>             
                    <input wire:model="comment" name="comment" id="cmnt-input" class="form-control py-2 w-full" type="text" placeholder="Add Comment ..." aria-label="Search" value="">
                </label>
                    <button class="btn btn-light" id="cmnt-btn" type="submit">  <i class="fa-solid fa-comment"></i></button>
                </form>
                <script>
                document.getElementById('cmnt-btn').addEventListener('click', function() {
                    document.getElementById('cmnt-input').value = "";
                })
                </script>
            </div>
        </div>
        <!-- Comment box END -->

    </div>
    <!-- Add comment END -->

    <!-- Comment wrap START -->
    <ul class="comment-wrap list-unstyled">

        @foreach ($post_comments as $single_comment)

        <!-- Comment item START -->
        <br>
        <li class="comment-item">
            <div class="d-flex position-relative">
                <!-- Avatar -->
                <div class="avatar avatar-xs">
                <a href="/user/{{$single_comment['user_name']}}"><img class="avatar-img rounded-circle" src="{{asset($single_comment['user_profile'])}}" alt=""></a>
                </div>
                <div class="ms-2">
                    <!-- Comment by -->
                    <div class="ms-2">
                        <div class="bg-light rounded-start-top-0 p-2 rounded">
                            <div class="d-flex justify-content-between">
                            <p class="mb-1"> <a href="/user/{{$single_comment['user_name']}}"> {{$single_comment['user_name']}} </a></p>
                            
                            <div style="text-align: center">
                                @if (in_array(Auth::id(), explode(",", $single_comment['like'])))
                                    <button style="color:red" wire:click="like({{$single_comment}})"><i class="bi bi-heart-fill "></i></button>
                                @else
                                    <button  wire:click="like({{$single_comment}})"><i class="bi bi-heart "></i></button>
                                @endif
                            </div>    

                            </div>
                            <p style="max-width: 30ch;" class="small mb-0">{{$single_comment['comment_value']}}</p>
                        </div>
                    </div>

                    <!-- Comment like, replay, time ago -->
                    <ul class="nav px-2 small">

                        <li wire:poll.visible class="nav-item">
                            <div style="text-align: center">
                                <a>{{ $single_comment['like_number'] }} likes</a>
                            </div>
                        </li>

                        <li class="nav-item">
                            <small>&nbsp; &nbsp; Reply</small>
                        </li>

                        <li style="text-align:right" class="nav-item">
                            <small>&nbsp; &nbsp; {{$single_comment['created_at']->diffForHumans()}}</small> 
                        </li>
                    </ul>
                </div>
            </div>
            
        </li>
        <!-- Comment item END -->
        @endforeach

        <br>
        <li wire:click="loadMore()" class="comment-item">
            <div>
                <!-- Load more comments -->
                  <button class="" style="padding:5px 8px 5px 8px; ">Load more commnent ... </button>
            </div>
        </li>
    </ul>
    <!-- Comment wrap END -->
    
</div>
