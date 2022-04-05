        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            {{-- <li class="nav-item account-dropdown">
              <a class="nav-link" data-toggle="collapse" href="#account-dropdown" aria-expanded="false" aria-controls="account-dropdown">
                <img class="img-sm rounded-circle" src="/storage/avatars/{{ Auth::user()->avatar }}" alt="">
                <p class="mb-0 ml-3 text-light">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="account-dropdown">
                <ul class="nav flex-column sub-menu pl-0">
                  <li class="nav-item">
                    <a class="nav-link pl-5" href="{{ url('profile') }}">
                      <span class="menu-icon">
                        <i class="mdi mdi-account"></i>
                      </span>
                      <span class="menu-title">@lang('sidebar.profile')</span>
                    </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link pl-5" href="{{ url('settings') }}">
                        <span class="menu-icon">
                          <i class="mdi mdi-wrench"></i>
                        </span>
                        <span class="menu-title">@lang('sidebar.settings')</span>
                      </a>
                    </li>
                  <li class="nav-item">
                        <a class="nav-link pl-5" href="{{ url('admin') }}">
                          <span class="menu-icon">
                            <i class="mdi mdi-wrench"></i>
                          </span>
                          <span class="menu-title">Admin Panel</span>
                        </a>
                      </li>

                    <li class="nav-item">
                    @csrf
                    <a class="nav-link pl-5" href="{{ route('logout') }}">
                      <span class="menu-icon">
                        <i class="mdi mdi-power"></i>
                      </span>
                      <span class="menu-title">@lang('sidebar.logout')</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li> --}}
            <li class="nav-item nav-category">
              <span class="nav-link">@lang('sidebar.navigation')</span>
            </li>
            <li class="nav-item menu-items">
              <a class="nav-link" href="{{ url('/') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-view-dashboard"></i>
                </span>
                <span class="menu-title">@lang('sidebar.mainpage')</span>
              </a>
            </li>
            <li class="nav-item menu-items">
              <a class="nav-link" href="{{ url('games') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-laptop"></i>
                </span>
                <span class="menu-title">@lang('sidebar.games')</span>
              </a>
            </li>
            <li class="nav-item menu-items">
              <a class="nav-link" href="{{ url('my_bids') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-xbox-controller"></i>
                </span>
                <span class="menu-title">@lang('sidebar.mybids')</span>
              </a>
            </li>
            <li class="nav-item menu-items">
              <a class="nav-link" href="{{ url('users') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-account"></i>
                </span>
                <span class="menu-title">@lang('sidebar.users')</span>
              </a>
            </li>
            <li class="nav-item menu-items">
              <a class="nav-link" href="{{ url('points') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-star-circle"></i>
                </span>
                <span class="menu-title">@lang('sidebar.points')</span>
              </a>
            </li>
            {{-- <li class="nav-item menu-items">
              <a class="nav-link" href="{{ url('plans') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-gamepad"></i>
                </span>
                <span class="menu-title">@lang('sidebar.subscriptions')</span>
              </a>
            </li> --}}
            <li class="nav-item menu-items">
              <a class="nav-link" href="{{ url('redeem') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-cash"></i>
                </span>
                <span class="menu-title">@lang('sidebar.redeem')</span>
              </a>
            </li>
            <li class="nav-item nav-category">
              <span class="nav-link">@lang('sidebar.more')</span>
            </li>
            <li class="nav-item menu-items">
              <a class="nav-link" href="{{ url('documentation') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-file-document-box"></i>
                </span>
                <span class="menu-title">@lang('sidebar.documentation')</span>
              </a>
            </li>
            <li class="nav-item menu-items">
              <a class="nav-link" href="{{ url('contact') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-email"></i>
                </span>
                <span class="menu-title">@lang('sidebar.contact')</span>
              </a>
            </li>
            <li class="nav-item menu-items">
              <a class="nav-link" href="{{ url('requests') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-image-filter-center-focus-weak"></i>
                </span>
                <span class="menu-title">@lang('sidebar.requests')</span>
              </a>
            </li>
            <li class="nav-item nav-category">
            <span class="nav-link">@lang('sidebar.balance'): {{ Auth::user()->points }}</span>
            </li>
          </ul>
        </nav>
