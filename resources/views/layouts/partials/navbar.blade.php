<div class="dashboard-header-container" style="top: 0px;">
  <header class="dashboard-header">
    <div class="dashboard-logo">
      <img alt="HIDENSEEK GAMES LOGO" src="{{ asset('img/logo-dark.png') }}">
    </div>
    <nav class="dashboard-nav">
      <ul class="dashboard-nav-list">
        <li>
          <div class="account-block">
            <span id="balance"></span>
            <img src="{{ asset('svgs/usdc-icon.svg') }}" alt="dolar sign">
          </div>
        </li>
        <li class="notification-dropdown-btn">
          <button tupe="button" class="menu-btn">
             <img src="{{ asset('svgs/bell.svg') }}" alt="bell">
             <div class="notification-number">{{ auth()->user()->unreadNotifications->count() }}</div>
          </button>
        </li>
        <li class="sidebar-btn-list">
          <button tupe="button" class="menu-btn burger-menu-btn">
            <img src="{{ asset('svgs/sidebar-menu.svg') }}" alt="sidebar menu item">
          </button>
        </li>
        <li class="dropdown-btn-list">
          <button tupe="button" class="menu-btn dropdown-menu-btn">
            <img src="{{ asset('svgs/burger-menu-button.svg') }}" alt="sidebar menu item">
          </button>
        </li>
      </ul>
    </nav>
    <nav class="dashboard-dropdown-navigation">
      <ul>
        <li>
          <a href="{{ url('/') }}" class="dropdown-link">Dashboard</a>
        </li>
        <li>
          <a href="{{ url('/games') }}" class="dropdown-link">Games</a>
        </li>
        <li>
          <a href="{{ url('/my_bids') }}" class="dropdown-link">My Bids</a>
        </li>
        <li>
          <a href="{{ url('/delegations') }}" class="dropdown-link">Delegations</a>
        </li>
        <li>
          <a href="{{ url('/documentation') }}" class="dropdown-link">Documentation</a>
        </li>
        <li>
          <a href="{{ url('/settings') }}" class="dropdown-link">Settings</a>
        </li>
        <li>
          <a href="{{ url('/logout') }}" class="dropdown-link">Logout</a>
        </li>
        @if (session('can_create'))
        <li>
          <a href="{{ url('games/create') }}" class="dropdown-link">Create A Game</a>
        </li>
        @endif
        <li class="dropdown-navigation-socmedia">
          <div class="dashbord-sidebar-social">
            <a href="https://t.me/hidenseek_group" class="nav-icon">
              <img src="{{ asset('svgs/telegram.svg')}}" alt="telegram icon">
            </a>
            <a href="https://discord.gg/DNYBCqztSv" class="nav-icon">
              <img src="{{ asset('svgs/discord.svg')}}" alt="discord icon">
            </a>
            <a href="https://twitter.com/hidenseek_games" class="nav-icon">
              <img src="{{ asset('svgs/twitter.svg')}}" alt="twitter icon">
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <div class="notification-dropdown">
      <div class="notification-block">
        <a href="{{route('mark')}}" class="mark-read">
          Mark As Read
        </a>
              {{-- @foreach(auth()->user()->unreadNotifications as $notification)
              <a class="dropdown-item preview-item">
                <div class="preview-item-content">
                    <span>$notification->data['title'] }}</span>
                    <p>{{ $notification->data['data'] }}</p>
                </div>
              </a>
              @endforeach --}}
                <div class="notification-content">
                  <div class="notification-icon">
                    <img src="{{ asset('images/avatar.jpg') }}" alt="bell">
                  </div>
                  <div class="notification-text">
                    <span>notification title</span>
                    <p>Lorem Ipsum is simply dummy text of </p>
                  </div>
                </div>
                <div class="notification-content">
                  <div class="notification-icon">
                    <img src="{{ asset('images/avatar.jpg') }}" alt="bell">
                  </div>
                  <div class="notification-text">
                    <span>notification title</span>
                    <p>Lorem Ipsum is simply dummy text of </p>
                  </div>
                </div>
            </div>
          </div>
  </header>
</div>
<script>
  const burgerMenu = document.querySelector('.burger-menu-btn');
  burgerMenu.onclick = function (){
    const sideBar = document.querySelector('.dashbord-sidebar');
    sideBar.classList.toggle("dashbord-sidebar-small");
  }
  $(".dropdown-menu-btn").click(function(){
    $(".dashboard-dropdown-navigation").slideToggle();
    $(".notification-dropdown").slideUp();
  });

  $.ajax({
    url: "{{ url('/get_balance') }}",
  })
    .done(function( data ) {
      $('#balance').html(data);
      console.log( "Sample of data:", data.slice( 0, 100 ) );
    });
  $(".notification-dropdown-btn").click(function(){
    $(".notification-dropdown").slideToggle();
    $(".dashboard-dropdown-navigation").slideUp();
  });
</script>