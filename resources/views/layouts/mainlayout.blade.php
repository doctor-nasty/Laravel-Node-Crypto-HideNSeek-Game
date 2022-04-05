<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @include('layouts.partials.head')
</head>

  {{-- <body class="sidebar-toggle-display sidebar-hidden"> --}}
<body>
    <!-- partial:partials/_settings-panel.html -->
    <div id="right-sidebar" class="settings-panel">
      <i class="settings-close mdi mdi-close"></i>
      <ul class="nav nav-tabs" id="setting-panel" role="tablist">
        <li class="nav-item">
          <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">Chats</a>
        </li>
      </ul>
      <div class="tab-content" id="setting-content">
        <!-- To do section tab ends -->
      @include('layouts.partials.chat-tab')
        <!-- chat tab ends -->

        <!-- theme tab ends -->
      </div>
</div>
    <!-- partial -->
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
  @include('layouts.partials.navbar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
  @include('layouts.partials.sidebar')
        <!-- partial -->
        <div class="main-panel">
@yield('content')
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
@include('layouts.partials.footer')
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
@include('layouts.partials.footer-scripts')
@yield('stripe-scripts')
    <!-- End custom js for this page-->
  </body>

<!-- RLG.GE -->
</html>
