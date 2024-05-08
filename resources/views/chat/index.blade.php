@extends('chat.layoutChat')
@section('title', 'chat')
@section('content')
@auth

{{ csrf_field() }}


<main>
  <!-- Container START -->
  <div class="container">
		<div class="row gx-0">
      <!-- Sidebar START -->
      <div class="col-lg-4 col-xxl-3" id="chatTabs" role="tablist">
        @livewire('show-user-chat' ,['users' => $users])
      </div>
      <!-- Sidebar START -->

      <!-- Chat conversation START -->
      <div class="col-lg-8 col-xxl-9">
        <div class="card card-chat rounded-start-lg-0 border-start-lg-0">
          <div class="card-body h-100">
            <div class="tab-content py-0 mb-0 h-100" id="chatTabsContent">

              <!-- Conversation item START -->
              <div class="fade tab-pane show active h-100" id="chat-1" role="tabpanel" aria-labelledby="chat-1-tab">
                <!-- Top avatar and status START -->
                <div class="d-sm-flex justify-content-between align-items-center">
                  <div class="d-flex mb-2 mb-sm-0">
                    <div class="flex-shrink-0 avatar me-2">
                      <img class="avatar-img rounded-circle" src="assets/images/avatar/10.jpg" alt="">
                    </div>
                    <div class="d-block flex-grow-1">
                      <h6 class="mb-0 mt-1">Judy Nguyen</h6>
                      <div class="small text-secondary"><i class="fa-solid fa-circle text-success me-1"></i>Online</div>
                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <!-- Call button -->
                    <a href="#!" class="icon-md rounded-circle btn btn-primary-soft me-2 px-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Audio call"><i class="bi bi-telephone-fill"></i></a>
                    <a href="#!" class="icon-md rounded-circle btn btn-primary-soft me-2 px-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Video call"><i class="bi bi-camera-video-fill"></i></a>
                    <!-- Card action START -->
                    <div class="dropdown">
                      <a class="icon-md rounded-circle btn btn-primary-soft me-2 px-2" href="#" id="chatcoversationDropdown" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></a>               
                      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="chatcoversationDropdown">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-check-lg me-2 fw-icon"></i>Mark as read</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-mic-mute me-2 fw-icon"></i>Mute conversation</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person-check me-2 fw-icon"></i>View profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-trash me-2 fw-icon"></i>Delete chat</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-archive me-2 fw-icon"></i>Archive chat</a></li>
                      </ul>
                    </div>
                    <!-- Card action END -->
                  </div>
                </div>
                <!-- Top avatar and status END -->
                <hr>
                <!-- Chat conversation START -->
                <div class="chat-conversation-content custom-scrollbar">
                  <!-- Chat time -->
                  
                  @livewire('show-message-chat', ['chat' => $chat])
                  

                  <!-- Chat message left -->
                </div>
                <!-- Chat conversation END -->
              </div>
              <!-- Conversation item END -->

            </div>
          </div>

          <div class="card-footer">
            <div class="d-sm-flex align-items-end">
              <textarea class="form-control mb-sm-0 mb-3" data-autoresize placeholder="Type a message" rows="1"></textarea>
              <button class="btn btn-sm btn-danger-soft ms-sm-2"><i class="fa-solid fa-face-smile fs-6"></i></button>
              <button class="btn btn-sm btn-secondary-soft ms-2"><i class="fa-solid fa-paperclip fs-6"></i></button>
              <button class="btn btn-sm btn-primary ms-2"><i class="fa-solid fa-paper-plane fs-6"></i></button>
            </div>
          </div>

          
        </div>
      </div>
      <!-- Chat conversation END -->
    </div> <!-- Row END -->
    <!-- =======================
    Chat END -->

	</div>
  <!-- Container END -->

</main>


<!-- Chat START -->
<div class="position-fixed bottom-0 end-0 p-3">

  <!-- Chat toast START -->
  <div id="chatToast" class="toast bg-mode" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
    <div class="toast-header bg-mode d-flex justify-content-between">
      <!-- Title -->
      <h6 class="mb-0">New message</h6>
      <button class="btn btn-secondary-soft-hover py-1 px-2" data-bs-dismiss="toast" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <!-- Top avatar and status END -->
    <div class="toast-body collapse show" id="collapseChat">
      <!-- Chat conversation START -->
      <!-- Form -->
      <form>
        <div class="input-group mb-3">
          <span class="input-group-text border-0">To</span>
          <input class="form-control" type="text" placeholder="Type a name or multiple names">
        </div>
      </form>         
      <!-- Chat conversation END -->
      <!-- Extra space -->
      <div class="h-200px"></div>
      <!-- Button  -->
      <div class="d-sm-flex align-items-end">
        <textarea class="form-control mb-sm-0 mb-3" placeholder="Type a message" rows="1" spellcheck="false"></textarea>
        <button class="btn btn-sm btn-danger-soft ms-sm-2"><i class="fa-solid fa-face-smile fs-6"></i></button>
        <button class="btn btn-sm btn-secondary-soft ms-2"><i class="fa-solid fa-paperclip fs-6"></i></button>
        <button class="btn btn-sm btn-primary ms-2"><i class="fa-solid fa-paper-plane fs-6"></i></button>
      </div>
    </div>
  </div>
  <!-- Chat toast END -->

</div>
<!-- Chat END -->

@endauth

@endsection    