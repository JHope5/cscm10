<? use App\User; ?>

<!-- Navbar css -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="{{ url('/') }}">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navbarNavDropdown" class="navbar-collapse collapse">
      <ul class="navbar-nav mr-auto">
        <li class="{{ Request::segment(1) === 'projects' ? 'active' : null }}">
          <a class="nav-link" href="{{ url('/projects') }}">Projects</span></a>
        </li>
        <li class="{{ Request::segment(1) === 'users' ? 'active' : null }}">
          <a  class="nav-link" href="{{ url('/users') }}">Lecturers</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
      @guest
        <li class="nav-item">
          <a class="nav-link" style="color:white" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        <!-- Remove register functionality - future development will allow for this
        @if (Route::has('register'))
        <li class="nav-item">
          <a class="nav-link" style="color:white" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif -->
        @else
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" 
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:white">
              {{ Auth::user()->username }} <span class="caret"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('users.show', Auth::id()) }}">My Profile</a>
            @if(Auth::id() == 1)
            <a class="dropdown-item" href="{{ route('allocate') }}">Allocate</a>
            @endif
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">{{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
      </ul>
      @endguest
  </div>
</nav>