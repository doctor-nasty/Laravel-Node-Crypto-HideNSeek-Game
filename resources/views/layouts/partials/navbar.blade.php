<div class="dashboard-header-container" style="top: 0px;">
  <header class="dashboard-header">
    <div class="dashboard-logo">
      <img alt="HIDENSEEK GAMES LOGO" src="{{ asset('img/logo-dark.png') }}">
    </div>
    <nav class="dashboard-nav">
      <ul class="dashboard-nav-list">
        <li>
          <div class="account-block">
            <span>12.45</span>
            <img src="{{ asset('svgs/dollar-circle.svg') }}" alt="dolar sign">
          </div>
        </li>
        <li>
          <button tupe="button" class="menu-btn">
             <img src="{{ asset('svgs/bell.svg') }}" alt="bell">
             <div class="notification-number">3</div>
          </button>
        </li>
        <li>
          <button tupe="button" class="menu-btn burger-menu-btn">
            <img src="{{ asset('svgs/sidebar-menu.svg') }}" alt="sidebar menu item">
          </button>
        </li>
      </ul>
    </nav>
  </header>
</div>
<script>
  const burgerMenu = document.querySelector('.burger-menu-btn');
  burgerMenu.onclick = function (){
    const sideBar = document.querySelector('.dashbord-sidebar');
    sideBar.classList.toggle("dashbord-sidebar-small");
  }
</script>