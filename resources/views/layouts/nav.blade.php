<header class="blog-header py-3">
  <div class="row ">
    <div class="col-md-4 pt-1">
      <a class="text-muted" href="#">Subscribe</a>
    </div>
    <div class="col-md-4 text-center">

      <a class="blog-header-logo text-dark" href="{{url('/')}}"><img src="{{route('index')}}/css/svg/device-mobile.svg" class="img-rounded img-responsive " alt="Responsive image" id="logo" > meAlert</a><span class="beta">BETA (demo data)</span>
    </div>
    <div class="col-md-4 d-flex justify-content-end align-items-center">
      <!--<a class="text-muted" href="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
      </a>-->
      <div class="">
          <!-- Authentication Links -->
          @guest
          <!--<a class="btn btn-sm btn-outline-secondary" href="{{ url('/register_userz') }}">Sign up</a>--><a class="btn btn-sm btn-outline-secondary" href="{{ route('login') }}">Sign in</a>
            @else
              <div class="nav-item dropdown">
                  <a id="navbarDropdown" class="btn btn-link nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      {{ Auth::user()->username }} | @if(Auth::user()->county_id !=0) {{ Auth::user()->county->name }} @elseif(Auth::user()->subcounty_id !=0) {{ Auth::user()->subcounty->name }}  @endif{{ Auth::user()->access_level }} <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          Logout
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </div>
              </div>
          @endguest
      </ul>
        <!--@if (Route::has('login'))
        @auth
        <form action="/logout" method="POST">
          <button class="btn btn-sm btn-outline-secondary" type="submit">Logout</button>
        </form>
          @else
      <a class="btn btn-sm btn-outline-secondary" href="{{ route('register') }}">Sign up</a>
      <a class="btn btn-sm btn-outline-secondary" href="{{ route('login') }}">Sign in</a>
      @endauth
      @endif-->
    </div>
  </div>
</header>

  @auth

<div class="row" >
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse float-right" id="navbarTogglerDemo01">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-right">
      <li class="nav-item">
        <a class="p-2 text-muted" href="{{url('/alerts')}}">Alerts</a>
      </li>
      <li class="nav-item">
        <a class="p-2 text-muted" href="{{route('index')}}/facilities">Facilities</a>
      </li>
      <li class="nav-item">
        <a class="p-2 text-muted" href="{{route('index')}}/diseases">Diseases</a>
      </li>
      <li class="nav-item">
        <a class="p-2 text-muted" href="{{route('index')}}/counties">Counties</a>
      </li>
      <li class="nav-item">
        <a class="p-2 text-muted" href="{{route('index')}}/subcounties">Sub-Counties</a>
      </li>
      <li class="nav-item">
        <a class="p-2 text-muted" href="{{route('index')}}/responses">Responses</a>
      </li>
      @if(Auth::user()->access_level == "MOH")
      <li class="nav-item">
        <a class="p-2 text-muted" href="{{route('index')}}/users">Users</a>
      </li>
      @endif
    </ul>
  </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>
</div>
@endauth
