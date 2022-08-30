<div class="dashbord-sidebar">
  <div class="dashbord-sidebar-body">
    <div>
      <div class="dashbord-sidebar-title">
        <h3>HIDENSEEK.GAMES</h3>
      </div>
      <div class="dashbord-sidebar-item dashbord-sidebar-item-{{ Request::is('/') ? 'active' : '' }}" id="">
        <a href="{{ url('/') }}">
          <div class="sidebar-item-icon-box">
            <img src="{{ asset('svgs/home.svg') }}" alt="home icon">
          </div>
          <div class="sidebar-item-title">Dashboard</div>
        </a>
      </div>
      <div class="dashbord-sidebar-item dashbord-sidebar-item-{{ Request::is('/myitems') ? 'active' : '' }}" id="">
        <a href="{{ url('/myitems') }}">
          <div class="sidebar-item-icon-box">
            <img src="{{ asset('svgs/nft.svg') }}" alt="home icon">
          </div>
          <div class="sidebar-item-title">My Items</div>
        </a>
      </div>
      @if (session('can_play'))
      <div class="dashbord-sidebar-item dashbord-sidebar-item-{{ Request::is('games') ? 'active' : '' }}">
        <a href="{{ url('/games') }}">
          <div class="sidebar-item-icon-box">
            <img src="{{ asset('svgs/game-controller.svg') }}" alt="game-controller">
          </div>
          <div class="sidebar-item-title">Games</div>
        </a>
      </div>
      @endif
      @if (session('can_play'))
      <div class="dashbord-sidebar-item dashbord-sidebar-item-{{ Request::is('my_bids') ? 'active' : '' }}">
        <a href="{{ url('/my_bids') }}">
          <div class="sidebar-item-icon-box">
            <img src="{{ asset('svgs/shopping-bag.svg') }}" alt="shopping-bag">
          </div>
          <div class="sidebar-item-title">My Bids</div>
        </a>
      </div>
      @endif
      <div class="dashbord-sidebar-item dashbord-sidebar-item-{{ Request::is('delegations') ? 'active' : '' }}">
        <a href="{{ url('/delegations') }}">
          <div class="sidebar-item-icon-box">
              <img src="{{ asset('svgs/file-text.svg') }}" alt="file icon">
          </div>
          <div class="sidebar-item-title">Delegations</div>
        </a>
      </div>
      <!-- <div class="dashbord-sidebar-item dashbord-sidebar-item-{{ Request::is('documentation') ? 'active' : '' }}">
        <a href="{{ url('/documentation') }}">
          <div class="sidebar-item-icon-box">
            <img src="{{ asset('svgs/file-text.svg') }}" alt="">
          </div>
          <div class="sidebar-item-title">Documentation</div>
        </a>
      </div> -->
      <div class="dashbord-sidebar-item dashbord-sidebar-item-{{ Request::is('settings') ? 'active' : '' }}">
        <a href="{{ url('/settings') }}">
          <div class="sidebar-item-icon-box">
            <img src="{{ asset('svgs/setting.svg') }}" alt="Settings icon">
          </div>
          <div class="sidebar-item-title">Settings</div>
        </a>
      </div>
      <div class="dashbord-sidebar-item dashbord-sidebar-item-{{ Request::is('logout') ? 'active' : '' }}">
        <a href="{{ url('/logout') }}">
          <div class="sidebar-item-icon-box">
            <img src="{{ asset('svgs/log-out.svg') }}" alt="logout icon">
          </div>
          <div class="sidebar-item-title">Log Out</div>
        </a>
      </div>
      @if (session('can_create'))
      <div class="creat-game-button-block">
        <a href="{{ url('games/create') }}">
        <button type="button" class="creat-game-button" title="Creat Game"> 
          <img src="{{ asset('svgs/plus.svg') }}" alt="">
          <span>Create A Game</span>
        </button>
      </a>
      </div>
      @endif
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