<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <!-- Mirrored from decentral.games/ice/start by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 12 Aug 2022 21:02:56 GMT -->
  <!-- Added by HTTrack -->
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <!-- /Added by HTTrack -->
  <head>
    @include('layouts.partials.head')
  </head>
  <body class="body">
    <div class="row">
      @include('layouts.partials.navbar')
      <div style="margin-top:0px">
        <div class="d-flex flex-row">
            @include('layouts.partials.sidebar')
            <div class="IcePoker_main_container___ZNyK">
              <div class="get-started component  GetStarted_main_wrapper__f0u9t">
                <div class="GetStarted_need_help__faKHS">
                  @yield('content')
                </div>
              </div>
            </div>
        </div>
      </div>
      <section class="crypto-widget" style="display:none">
        <div id="crypto-widget-CoinMarquee" data-transparent="true" data-design="classic" data-coins="ethereum,decentral-games,decentral-games-ice,decentral-games-governance-xdg" style="margin-top:-48px;margin-left:-17px"></div>
      </section>
    </div>
  </body>
  <!-- Mirrored from decentral.games/ice/start by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 12 Aug 2022 21:03:01 GMT -->
</html>