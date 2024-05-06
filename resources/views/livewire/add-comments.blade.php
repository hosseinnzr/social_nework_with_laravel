
<div class="offcanvas-body pt-0 custom-scrollbar">
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

              <form wire:submit="save({{$postId}})">
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
        <li wire:poll.visible class="comment-item">
            <div class="d-flex position-relative">
            <!-- Avatar -->
            <div class="avatar avatar-xs">
            <a href="#!"><img class="avatar-img rounded-circle" src="{{asset($single_comment['user_profile'])}}" alt=""></a>
            </div>
            <div style="width: 280px;" class="ms-2">
                <!-- Comment by -->
                <div class="bg-light rounded-start-top-0 p-3 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-1"> <a href="#!">{{$single_comment['user_name']}}</a></h6>
                        <p class="ms-2">{{$single_comment['created_at']->diffForHumans()}}</p>
                    </div>
                    <p class="small mb-0">{{$single_comment['comment_value']}}</p>
                </div>
                <!-- Comment react -->
                <ul class="nav nav-divider py-2 small">
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
