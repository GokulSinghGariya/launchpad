<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">{{ Auth::user()->user_type }} Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active" active="{{request()->routeIs('dashboard')}}">
          <a class="nav-link" href="{{route('dashboard')}}"> {{ __('Dashboard') }} <span class="sr-only">(current)</span></a>

        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">{{ Auth::user()->email }}</a>
        </li>

      </ul>
      <div class="dropdown">
        <span id="dropdownMenuButton" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: rgb(0, 255, 234);padding:10px;border-radius:6px;margin:10px"><i class="fa fa-bell"></i><b id="count_notification">0</b></span>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="res_notification">


    </div>
  </div>
      <span class="navbar-text">

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <label for=""> {{ Auth::user()->name}}</label>
            <button class="btn btn-danger" href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log Out') }}
        </button>


        </form>
      </span>
    </div>
  </nav>

