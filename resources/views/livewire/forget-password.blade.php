<div>

    <div style=" font-size: 0.8em;">
        @if($errors->any())
            {!! implode('', $errors->all('<div class="alert alert-danger alert-dismissible fade show" role="alert">:message</div>')) !!}
        @endif

        @if(Session::get('error') && Session::get('error') != null)

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('error') }}
            </div>
            @php
            Session::put('error', null)
            @endphp
        @endif

        @if(Session::get('success') && Session::get('success') != null)

            
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
            </div>

            @php
            Session::put('success', null)
            @endphp
        @endif
    </div>

    @if ($send_code == false)
        <form wire:submit="sendCode()" method="POST" class="mt-4">
            @csrf

            <div class="mb-3 position-relative input-group-lg">
            <label for="email" class="form-label">Email:</label>
            <input wire:model="email" type="text" class="form-control" placeholder="Email">
            </div>

            <br>
            <!-- Button -->
            <div class="d-grid">
            <button type="submit" class="btn btn-lg btn-primary-soft">send verify code</button>
            </div>
        </form>
    @else
        <form wire:submit="forgotPassword()" method="POST" class="mt-4">
            @csrf
            <p>email send to {{$email}}</p>

            <div class="mb-3 position-relative input-group-lg">
            <label for="new_password" class="form-label">New password:</label>
            <input wire:model="new_password" type="text" class="form-control" placeholder="New password" value="{{ old('new_password')}}">
            </div>

            <div class="mb-3 position-relative input-group-lg">
            <label for="confirm_new_password" class="form-label">Confirm password:</label>
            <input wire:model="confirm_new_password" type="text" class="form-control" placeholder="Confirm password" value="{{ old('confirm_new_password')}}">
            </div>
            <hr>
            <div class="mb-3 position-relative input-group-lg">
            <label for="verify_code" class="form-label">Verify code:</label>
            <input wire:model="verify_code" type="text" class="form-control" placeholder="Verify code">
            </div>
            <br>
            <!-- Button -->
            <div class="d-grid">
            <button type="submit" class="btn btn-lg btn-primary-soft">reset password</button>
            </div>
        </form>
    @endif
</div>
