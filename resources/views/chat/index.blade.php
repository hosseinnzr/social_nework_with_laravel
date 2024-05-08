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
        @livewire('show-user-chat', [ 'conversations' => $conversations ])
      </div>
      <!-- Sidebar START -->

      <!-- Chat conversation START -->
      <div class="col-lg-8 col-xxl-9">
        @livewire('show-message-chat', [ 'conversations' => $conversations ])
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