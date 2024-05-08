<!-- Sidebar START -->
<div>

    <!-- Divider -->
    <div class="d-flex align-items-center mb-4 d-lg-none">
        <button class="border-0 bg-transparent" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <i class="btn btn-primary fw-bold fa-solid fa-sliders"></i>
            <span class="h6 mb-0 fw-bold d-lg-none ms-2">Chats</span>
        </button>
    </div>

    <!-- Advanced filter responsive toggler END -->
        <div class="card card-body border-end-0 border-bottom-0 rounded-bottom-0">
            <div class=" d-flex justify-content-between align-items-center">
            <h1 class="h5 mb-0">Active chats <span class="badge bg-success bg-opacity-10 text-success">6</span></h1>
            <!-- Chat new create message item START -->
            <div class="dropend position-relative">
                <div class="nav">
                <a class="icon-md rounded-circle btn btn-sm btn-primary-soft nav-link toast-btn" data-target="chatToast" href="#" > <i class="bi bi-pencil-square"></i> </a>
                </div>
            </div>
            <!-- Chat new create message item END -->
            </div>
        </div>

<nav class="navbar navbar-light navbar-expand-lg mx-0">
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
        <!-- Offcanvas header -->
            <div class="offcanvas-header">
                <button type="button" class="btn-close text-reset ms-auto" data-bs-dismiss="offcanvas"></button>
            </div>

        <!-- Offcanvas body -->
            <div class="offcanvas-body p-0">
                <div class="card card-chat-list rounded-end-lg-0 card-body border-end-lg-0 rounded-top-0">
                
                <!-- Search chat START -->
                <form class="position-relative">
                    <input class="form-control py-2" type="search" placeholder="Search for chats" aria-label="Search">
                    <button class="btn bg-transparent text-secondary px-2 py-0 position-absolute top-50 end-0 translate-middle-y" type="submit">
                    <i class="bi bi-search fs-5"></i>
                    </button>
                </form>
                <!-- Search chat END -->
                
                <!-- Chat list tab START -->
                <div class="mt-4 h-100">
                    <div class="chat-tab-list custom-scrollbar">
                    <ul class="nav flex-column nav-pills nav-pills-soft">
                        
                        @foreach ($users as $user)
                            
                        <li data-bs-dismiss="offcanvas">
                        <!-- Chat user tab item -->
                        <a href="?query={{$user->id}}" class="nav-link active text-start" id="chat-2-tab" data-bs-toggle="pill" role="tab">
                            <div class="d-flex">
                            <div class="flex-shrink-0 avatar avatar-story me-2 status-online">
                                <img class="avatar-img rounded-circle" src="{{$user->profile_pic}}" alt="">
                            </div>
                            <div class="flex-grow-1 d-block">
                                <h6 class="mb-0 mt-1">{{$user->user_name}}</h6>
                                <div class="small text-secondary">Frances sent a photo.</div>
                            </div>
                            </div>
                        </a>
                        </li>
                       
                        @endforeach

                    </ul>
                    </div>
                </div>
                <!-- Chat list tab END -->
                </div>
            </div>

    </div>
</nav>
</div>
<!-- Sidebar START -->