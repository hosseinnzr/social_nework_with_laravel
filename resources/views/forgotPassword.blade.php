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
        <div class="card card-body p-4 p-sm-5">
          <!-- Title -->
          <h1 class="mb-2 text-center">Forget password</h1>
          <p class="text-center">back to <a href="/signin"> sign in</a> page</p>
          <!-- Form START -->

            <form  action="{{route('forgot-password.post')}}" method="POST" class="mt-4">
              @csrf

              <div class="mb-3 position-relative input-group-lg">
                <label for="new_password" class="form-label">New password:</label>
                <input name="new_password" type="text" class="form-control" placeholder="New password">
              </div>

              <div class="mb-3 position-relative input-group-lg">
                <label for="confirm_new_password" class="form-label">Confirm password:</label>
                <input name="confirm_new_password" type="text" class="form-control" placeholder="Confirm password">
              </div>
              <hr>
              <div class="mb-3 position-relative input-group-lg">
                <label for="verify_code" class="form-label">Verify code:</label>
                <input name="verify_code" type="text" class="form-control" placeholder="Verify code">
              </div>
              <br>
              <!-- Button -->
              <div class="d-grid">
                <button type="submit" class="btn btn-lg btn-primary-soft">reset password</button>
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
