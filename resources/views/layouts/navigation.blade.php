<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #5bc0de;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#" style="color: white;">Ticketing System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        @auth
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
               style="color: white;">
                Logout
            </a>
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        @else
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}" style="color: white;">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}" style="color: white;">Register</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>