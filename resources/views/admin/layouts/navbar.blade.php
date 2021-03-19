  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('home') }}" class="nav-link">{{__('home')}}</a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>
    <!-- Language -->
    <ul class='nav' style="float: left;">
      <li>
        <div class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{__('language')}}</a>
          <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">            
            <li>
              <a href="{{ url('locale/en') }}"> English </a>
            </li>
            <li>
              <a href="{{ url('locale/ar') }}"> العربية</a>
            </li>
          </ul>
        </div>   
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- change language -->
      <li>
        
      </li>
      

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="" role="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
          @csrf
      </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->