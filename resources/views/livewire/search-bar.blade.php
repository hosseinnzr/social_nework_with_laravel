<form class="rounded position-relative">
    <input class="form-control bg-light" type="search" placeholder="Search..." aria-label="Search" wire:model.live="search">
        @isset($users)
        <div class="dropdown-menu dropdown-menu-size-md p-0 shadow-lg border-0 show">
            @foreach ($users as $user)

            <div class="col-sm-6 col-lg-12">
                <div class="card" >
                <!-- Card body START -->
                <div style="padding: 14px 0px 5px 14px" class="card-body">
                    <!-- Connection item START -->
                    <div class="hstack gap-2 mb-3">
                        <!-- Avatar -->
                        <div class="avatar">
                            <a href="{{ route('profile', ['user_name' => $user['user_name']]) }}"><img class="avatar-img rounded-circle" src="{{$user['profile_pic']}}" alt=""></a>
                        </div>

                        <!-- Title -->
                        <div class="overflow-hidden">
                            <a class="h6 mb-0" href="{{ route('profile', ['user_name' => $user['user_name']]) }}" >{{$user['user_name']}}</a>
                            <p class="mb-0 small text-truncate">{{$user['first_name']}} {{$user['last_name']}}</p>
                        </div>

                    </div>
                    <!-- Connection item END -->
                </div>
                <!-- Card body END -->
                </div>
            </div>
            <!-- Card follow START -->
            @endforeach
        </div>
    @endisset                
</form>

