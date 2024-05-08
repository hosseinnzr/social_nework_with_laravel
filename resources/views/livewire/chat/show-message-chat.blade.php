<div class="card card-chat rounded-start-lg-0 border-start-lg-0">
    <div class="card-body h-100">
      <div class="tab-content py-0 mb-0 h-100" id="chatTabsContent">
        <!-- Conversation item START -->
        @foreach ($conversations as $conversations)
        <div class="fade tab-pane h-100" id="chat-{{$conversations->id}}" role="tabpanel" aria-labelledby="chat-{{$conversations->id}}-tab">
            <!-- Top avatar and status START -->
            <div class="d-sm-flex justify-content-between align-items-center">
              <div class="d-flex mb-2 mb-sm-0">
                <div class="flex-shrink-0 avatar me-2">
                  <img class="avatar-img rounded-circle" src="assets/images/avatar/12.jpg" alt="">
                </div>
                <div class="d-block flex-grow-1">
                  <h6 class="mb-0 mt-1">{{$conversations->id}}</h6>
                  <div class="small text-secondary">Last active a month</div>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <!-- Call button -->
                <a href="#!" class="icon-md rounded-circle btn btn-primary-soft me-2 px-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Audio call"><i class="bi bi-telephone-fill"></i></a>
                <a href="#!" class="icon-md rounded-circle btn btn-primary-soft me-2 px-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Video call"><i class="bi bi-camera-video-fill"></i></a>
                <!-- Card action START -->
                <div class="dropdown">
                  <a class="icon-md rounded-circle btn btn-primary-soft me-2 px-2" href="#" id="chatcoversationDropdown3" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></a>               
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="chatcoversationDropdown3">
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
            <div class="chat-conversation-content overflow-auto custom-scrollbar">
              <!-- Chat time -->
              <div class="text-center small my-2">Jul 16, 2022, 06:15 am</div>
              <!-- Chat message right -->
              <div class="d-flex justify-content-end text-end mb-1">
                <div class="w-100">
                  <div class="d-flex flex-column align-items-end">
                    <div class="bg-primary text-white p-2 px-3 rounded-2">Hello</div>
                  </div>
                </div>
              </div>
              <!-- Chat message right -->
              <div class="d-flex justify-content-end text-end mb-1">
                <div class="w-100">
                  <div class="d-flex flex-column align-items-end">
                    <div class="bg-primary text-white p-2 px-3 rounded-2">Made and For saw Creepeth place shall Moving.</div>
                    <div class="d-flex my-2">
                      <div class="small text-secondary">6:20 AM</div>
                      <div class="small ms-2"><i class="fa-solid fa-check-double text-info"></i></div>
                    </div>
                  </div>
                </div>
              </div>
               <!-- Chat message right -->
               <div class="d-flex justify-content-end text-end mb-1">
                <div class="w-100">
                  <div class="d-flex flex-column align-items-end">
                    <div class="bg-primary text-white p-2 px-3 rounded-2">Made and For saw Creepeth place shall Moving.</div>
                    <div class="d-flex my-2">
                      <div class="small text-secondary">6:20 AM</div>
                      <div class="small ms-2"><i class="fa-solid fa-check-double text-info"></i></div>
                    </div>
                  </div>
                </div>
              </div>
               <!-- Chat message right -->
               <div class="d-flex justify-content-end text-end mb-1">
                <div class="w-100">
                  <div class="d-flex flex-column align-items-end">
                    <div class="bg-primary text-white p-2 px-3 rounded-2">Made and For saw Creepeth place shall Moving.</div>
                    <div class="d-flex my-2">
                      <div class="small text-secondary">6:20 AM</div>
                      <div class="small ms-2"><i class="fa-solid fa-check-double text-info"></i></div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Chat message left -->
              <div class="d-flex mb-1">
                <div class="flex-shrink-0 avatar avatar-xs me-2">
                  <img class="avatar-img rounded-circle" src="assets/images/avatar/12.jpg" alt="">
                </div>
                <div class="flex-grow-1">
                  <div class="w-100">
                    <div class="d-flex flex-column align-items-start">
                      <div class="bg-light text-secondary p-2 px-3 rounded-2">Thank you for prompt response</div>
                      <div class="small my-2">12:16 PM</div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Chat message left -->
              <div class="d-flex mb-1">
                <div class="flex-shrink-0 avatar avatar-xs me-2">
                  <img class="avatar-img rounded-circle" src="assets/images/avatar/12.jpg" alt="">
                </div>
                <div class="flex-grow-1">
                  <div class="w-100">
                    <div class="d-flex flex-column align-items-start">
                      <div class="bg-light text-secondary p-3 rounded-2">
                        <div class="typing d-flex align-items-center">
                          <div class="dot"></div>
                          <div class="dot"></div>
                          <div class="dot"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Chat conversation END -->
          </div>
        @endforeach
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