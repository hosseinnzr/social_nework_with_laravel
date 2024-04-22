<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">social network</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          @auth
          <li class="nav-item">
            <a class="nav-link active"href="{{route('Dashboard')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active"href="{{route('explore')}}">Explore</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('logout')}}">logout</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('addPost')}}">Add Post</a>
          </li>
          @else
          <li>
            <a class="nav-link" href="{{route('signup')}}">signUp</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('login')}}">login</a>
          </li>
          @endauth

        </ul>
      </div>
    </div>
  </nav>