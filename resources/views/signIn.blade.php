@extends('layout')
@section('title', 'signIn')
@section('content')

<main>
  
  <!-- Container START -->
  <div class="container">
    <div class="row justify-content-center align-items-center vh-100 py-5">
      <!-- Main content START -->
      <div class="col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
        <!-- Sign in START -->
        <div class="card card-body text-center p-4 p-sm-5">
          <!-- Title -->
          <h1 class="mb-2">Sign in</h1>
          <p>Don't have an account?<a href="/signup"> sign up</a></p>
          <!-- Form START -->

            <form  action="{{route('signIn.post')}}" method="POST" class="mt-4">
              @csrf

              <div class="mb-3 position-relative input-group-lg">
                <input name="email" type="email" class="form-control" placeholder="Enter email">
              </div>

              <div class="mb-3">
                <div class="input-group input-group-lg">
                  <input name="password" class="form-control fakepassword" type="password" id="psw-input" placeholder="Enter new password">
                  <span class="input-group-text p-0">
                    <i class="fakepasswordicon fa-solid fa-eye-slash cursor-pointer p-2 w-40px"></i>
                  </span>
                </div>

                <!-- Pswmeter -->
                <div id="pswmeter" class="mt-2"></div>
                <div class="d-flex mt-1">
                  <div id="pswmeter-message" class="rounded"></div>
                  <!-- Password message notification -->
                  <div class="ms-auto">
                    <i class="bi bi-info-circle ps-1" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Include at least one uppercase, one lowercase, one special character, one number and 8 characters long." data-bs-original-title="" title=""></i>
                  </div>
                </div>

              </div>
              <!-- Button -->
              <div class="d-grid">
                <button type="submit" class="btn btn-lg btn-primary-soft">sign in</button>
              </div>
            </form>

          <!-- Form END -->
        </div>
        <!-- Sign in START -->
      </div>
    </div> <!-- Row END -->
  </div>
  <!-- Container END -->

</main>

@endsection
