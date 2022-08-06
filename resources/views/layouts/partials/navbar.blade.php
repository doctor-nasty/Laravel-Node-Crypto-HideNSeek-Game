      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="{{ url('/') }}"><img src="{{ asset('img/logo-dark.png') }}" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}"><img src="{{ asset('img/logo-dark.png') }}" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          {{-- <ul class="navbar-nav w-100">
            <li class="nav-item w-100">
                <img src="https://s3.envato.com/files/181231924/jpg/234x60_Half_Banner.jpg" class="rounded mx-auto d-block" alt="AD">
            </li>
          </ul> --}}
         {{-- <ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                  <a class="btn btn-dark" href="{{ url('/') }}">
                    <span class="menu-icon">
                      <i class="mdi mdi-speedometer"></i>
                    </span>
                    <span class="menu-title">@lang('sidebar.dashboard')</span>
                  </a>
                </li>
              <li class="nav-item w-100">
                  <a class="btn btn-dark" href="{{ url('games') }}">
                    <span class="menu-icon">
                      <i class="mdi mdi-laptop"></i>
                    </span>
                    <span class="menu-title">@lang('sidebar.games')</span>
                  </a>
                </li>
          <li class="navbar-nav w-100">
              <a class="btn btn-dark" href="{{ url('points') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-medical-bag"></i>
                </span>
                <span class="menu-title">@lang('sidebar.points')</span>
              </a>
          </li>
          <li class="navbar-nav w-100">
              <a class="btn btn-dark" href="{{ url('plans') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-gamepad"></i>
                </span>
                <span class="menu-title">@lang('sidebar.subscriptions')</span>
              </a>
            </li>
            <li class="navbar-nav w-100">
              <a class="btn btn-dark" href="{{ url('redeem') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-cash"></i>
                </span>
                <span class="menu-title">@lang('sidebar.redeem')</span>
              </a>
            </li>
            <li class="navbar-nav w-100">
                <a class="btn btn-dark" href="{{ url('documentation') }}">
                  <span class="menu-icon">
                    <i class="mdi mdi-file-document-box"></i>
                  </span>
                  <span class="menu-title">@lang('sidebar.documentation')</span>
                </a>
              </li>
              <li class="navbar-nav w-100">
                <a class="btn btn-dark" href="{{ url('contact') }}">
                  <span class="menu-icon">
                    <i class="mdi mdi-email"></i>
                  </span>
                  <span class="menu-title">@lang('sidebar.contact')</span>
                </a>
              </li>
              <li class="navbar-nav w-100">
                <a class="btn btn-dark" href="{{ url('requests') }}">
                  <span class="menu-icon">
                    <i class="mdi mdi-image-filter-center-focus-weak"></i>
                  </span>
                  <span class="menu-title">@lang('sidebar.requests')</span>
                </a>
              </li>
        </ul> --}}
        {{-- <nav class="navbar navbar-expand-lg">

          <div class="container">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="icon-bar"><i class="mdi mdi-format-line-spacing"></i></span>
                </button>
            <!-- navbar links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
              <li class="nav-item w-100">
                  <a class="btn btn-dark" href="{{ url('/') }}">
                    <span class="menu-icon">
                      <i class="mdi mdi-speedometer"></i>
                    </span>
                    <span class="menu-title">@lang('sidebar.dashboard')</span>
                  </a>
                </li>
              <li class="nav-item w-100">
                  <a class="btn btn-dark" href="{{ url('games') }}">
                    <span class="menu-icon">
                      <i class="mdi mdi-laptop"></i>
                    </span>
                    <span class="menu-title">@lang('sidebar.games')</span>
                  </a>
                </li>
          <li class="navbar-nav w-100">
              <a class="btn btn-dark" href="{{ url('points') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-medical-bag"></i>
                </span>
                <span class="menu-title">@lang('sidebar.points')</span>
              </a>
          </li>
          <li class="navbar-nav w-100">
              <a class="btn btn-dark" href="{{ url('plans') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-gamepad"></i>
                </span>
                <span class="menu-title">@lang('sidebar.subscriptions')</span>
              </a>
            </li>
            <li class="navbar-nav w-100">
              <a class="btn btn-dark" href="{{ url('redeem') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-cash"></i>
                </span>
                <span class="menu-title">@lang('sidebar.redeem')</span>
              </a>
            </li>
            <li class="navbar-nav w-100">
                <a class="btn btn-dark" href="{{ url('documentation') }}">
                  <span class="menu-icon">
                    <i class="mdi mdi-file-document-box"></i>
                  </span>
                  <span class="menu-title">@lang('sidebar.documentation')</span>
                </a>
              </li>
              <li class="navbar-nav w-100">
                <a class="btn btn-dark" href="{{ url('contact') }}">
                  <span class="menu-icon">
                    <i class="mdi mdi-email"></i>
                  </span>
                  <span class="menu-title">@lang('sidebar.contact')</span>
                </a>
              </li>
              <li class="navbar-nav w-100">
                <a class="btn btn-dark" href="{{ url('requests') }}">
                  <span class="menu-icon">
                    <i class="mdi mdi-image-filter-center-focus-weak"></i>
                  </span>
                  <span class="menu-title">@lang('sidebar.requests')</span>
                </a>
              </li>

                  </ul>
            </div>
          </div>
        </nav> --}}

          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
              <a class="btn count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-earth"></i>
                {{--<span class="count bg-danger">5</span>--}}
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                {{-- <h6 class="p-3 mb-0">Languages</h6> --}}
                <div class="dropdown-divider"></div>

                




                {{-- <div class="dropdown-divider"></div>
                <p class="p-3 mb-0 text-center">Coming Soon</p> --}}
              </div>
            </li>
            <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-bell"></i>
                  <span class="count bg-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="p-3 mb-0">@lang('sidebar.notifications')</h6>
                  <div class="dropdown-divider"></div>
                  @foreach(auth()->user()->unreadNotifications as $notification)


                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-xbox-controller text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                        <p class="preview-subject mb-1">{{ $notification->data['title'] }}</p>
                        <p class="text-muted ellipsis mb-0">{{ $notification->data['data'] }}</p>

                                              </div>
                  </a>
                  @endforeach
                  <div class="dropdown-divider"></div>
                  <a href="{{route('mark')}}">
                    <p class="p-3 mb-0 text-center">@lang('sidebar.markasread')</p>
                </a>
                </div>
              </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <img class="img-sm rounded-circle" src="/storage/avatars/{{ Auth::user()->avatar }}" alt="">
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <h6 class="p-3 mb-0">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item" href="{{ url('profile') }}">
                    {{-- <div class="preview-thumbnail">
                        <i class="mdi mdi-account"></i>
                    </div> --}}
                      <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">@lang('sidebar.profile')</p>
                      </div>
                </a>
                <a class="dropdown-item preview-item" href="{{ url('settings') }}">
                    {{-- <div class="preview-thumbnail">
                        <i class="mdi mdi-wrench"></i>
                    </div> --}}
                      <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">@lang('sidebar.settings')</p>
                      </div>
                </a>
                {{-- <a class="dropdown-item preview-item" href="{{ route('games.create') }}">
                    <div class="preview-thumbnail">
                        <i class="mdi mdi-chess-king"></i>
                    </div>
                      <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">@lang('games.create_game')</p>
                      </div>
                </a> --}}
                <a class="dropdown-item preview-item" href="{{ route('logout') }}">
                    {{-- <div class="preview-thumbnail">
                        <i class="mdi mdi-power"></i>
                    </div> --}}
                      <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">@lang('sidebar.logout')</p>
                      </div>
                </a>
                <div class="dropdown-divider"></div>
                <p class="p-3 mb-0 text-center">Balance: {{ Auth::user()->points }}</p>
            </li>
            {{-- <li class="nav-item dropdown">
            <a class="btn btn-dark count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-sm rounded-circle" src="/storage/avatars/{{ Auth::user()->avatar }}" alt="">
                <span class="count bg-danger">5</span>
              </a>
              <a href="locale/ge" class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                <img src="{{ asset('images/flags/ge.png') }}" alt="image" class="rounded-circle profile-pic">
                </div>
                <div class="preview-item-content">
                  <p class="preview-subject ellipsis mb-1">ქართული</p>
                </div>
              </a>
            </li> --}}
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
            {{-- <li class="nav-item nav-settings d-none d-lg-block">
              <a class="btn btn-dark" href="#">
                <i class="mdi mdi-view-grid"></i>
              </a>
            </li>
          </ul> --}}
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
          </button>
        </div>
      </nav>
