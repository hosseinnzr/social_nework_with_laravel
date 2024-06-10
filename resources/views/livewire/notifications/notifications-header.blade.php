<div>
    <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="m-0">Notifications <span class="badge bg-danger bg-opacity-10 text-danger ms-2">{{$x}} new</span></h6>
        <a class="small" wire:click="refresh()" >refresh</a>
        
    </div>

        <div class="card-body p-0">
            <ul class="list-group list-group-flush list-unstyled p-2">
            <!-- Notif item -->
            <li>
                <div class="list-group-item list-group-item-action rounded badge-unread d-flex border-0 mb-1 p-3">
                <div class="avatar text-center d-none d-sm-inline-block">
                    <img class="avatar-img rounded-circle" src="{{ asset("assets/images/avatar/01.jpg") }}" alt="">
                </div>
                <div class="ms-sm-3">
                    <div class=" d-flex">
                    <p class="small mb-2"><b>Judy Nguyen</b> sent you a friend request.</p>
                    <p class="small ms-3 text-nowrap">Just now</p>
                </div>
                <div class="d-flex">
                    <button class="btn btn-sm py-1 btn-primary me-2">Accept </button>
                    <button class="btn btn-sm py-1 btn-danger-soft">Delete </button>
                </div>
                </div>
            </div>
            </li>
            <!-- Notif item -->
            <li>
                <div class="list-group-item list-group-item-action rounded badge-unread d-flex border-0 mb-1 p-3 position-relative">
                <div class="avatar text-center d-none d-sm-inline-block">
                    <img class="avatar-img rounded-circle" src="{{ asset("assets/images/avatar/02.jpg") }}" alt="">
                </div>
                <div class="ms-sm-3 d-flex">
                    <div>
                    <p class="small mb-2">Wish <b>Amanda Reed</b> a happy birthday (Nov 12)</p>
                    <button class="btn btn-sm btn-outline-light py-1 me-2">Say happy birthday 🎂</button>
                    </div>
                    <p class="small ms-3">2min</p>
                </div>
                </div>
            </li>

            </ul>
        </div>

    </div>
</div>
