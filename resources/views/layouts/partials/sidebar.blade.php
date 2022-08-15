<div class="dashbord-sidebar">
  <div class="dashbord-sidebar-body">
    <div>
      <div class="dashbord-sidebar-title">
        <h3>HIDENSEEK.GAMES</h3>
      </div>
      <div class="dashbord-sidebar-item dashbord-sidebar-item-active" id="">
        <a href="{{ url('/') }}">
          <div class="sidebar-item-icon-box">
            <img src="{{ asset('svgs/home.svg') }}" alt="home icon">
          </div>
          <div class="sidebar-item-title">Dashboard</div>
        </a>
      </div>
      <div class="dashbord-sidebar-item">
        <a href="{{ url('/games') }}">
          <div class="sidebar-item-icon-box">
            <img src="{{ asset('svgs/game-controller.svg') }}" alt="">
          </div>
          <div class="sidebar-item-title">Games</div>
        </a>
      </div>
      <div class="dashbord-sidebar-item">
        <a href="{{ url('/my_bids') }}">
          <div class="sidebar-item-icon-box">
            <img src="{{ asset('svgs/shopping-bag.svg') }}" alt="">
          </div>
          <div class="sidebar-item-title">My Bids</div>
        </a>
      </div>
      <div class="dashbord-sidebar-item">
        <a href="{{ url('/delegations') }}">
          <div class="sidebar-item-icon-box">
              <img src="{{ asset('svgs/shopping-bag.svg') }}" alt="">
          </div>
          <div class="sidebar-item-title">Delegations</div>
        </a>
      </div>
      <div class="dashbord-sidebar-item">
        <a href="{{ url('/documentation') }}">
          <div class="sidebar-item-icon-box">
            <img src="{{ asset('svgs/file-text.svg') }}" alt="">
          </div>
          <div class="sidebar-item-title">Documentation</div>
        </a>
      </div>
      <div class="creat-game-button-block">
        <button type="button" class="creat-game-button" title="Creat Game"> 
          <img src="{{ asset('svgs/plus.svg') }}" alt="">
          <span>Creat Game</span>
        </button>
      </div>
    </div>
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
  </div>
</div>