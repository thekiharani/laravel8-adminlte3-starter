<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <img src="{{ asset(auth()->user()->avatar_url) }}" class="img-circle elevation-2" alt="User Image" width="20">
            <span class="ml-1">{{ auth()->user()->name ?? 'My Account' }} <i class="fas fa-caret-down"></i></span>
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
            <span class="dropdown-item dropdown-header">{{ __('My Account') }}</span>

            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <i class="fas fa-user-cog mr-2"></i>
                {{ __('Profile') }}
            </a>

            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <i class="fas fa-user-lock mr-2"></i>
                {{ __('Change Password') }}
            </a>

            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt mr-2"></i>
                {{ __('Logout') }}
            </a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
      </li>
    </ul>
</nav>
