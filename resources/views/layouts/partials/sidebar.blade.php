<div class="dashbord-sidebar">
  <div class="dashbord-sidebar-body">
    <div class="dashbord-sidebar-title">
      <h3>HIDENSEEK.GAMES</h3>
    </div>
    <div>
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
    </div>
  </div>
</div>