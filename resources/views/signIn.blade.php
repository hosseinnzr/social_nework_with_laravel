@extends('layout')
@section('title', 'signin')
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

            <form  action="{{route('signin.post')}}" method="POST" class="mt-4">
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
              </div>
              
              <!-- Remember me -->
              <div class="mb-3 d-sm-flex justify-content-between">
                {{-- <div>
                  <input type="checkbox" class="form-check-input" id="rememberCheck">
                  <label class="form-check-label" for="rememberCheck">Remember me?</label>
                </div> --}}
                <a href="/forgot-password">Forgot password?</a>
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
