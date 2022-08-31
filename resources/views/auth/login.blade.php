<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Google tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-237510470-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-237510470-1');
    </script>


    <!-- Metas -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Title  -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @if (isset($title))
            {{ $title }}
        @else
            {{ config('app.name') }}
        @endif
    </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/site.webmanifest') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900" rel="stylesheet">

    <!-- Plugins -->
    <link rel="stylesheet" href="{{ asset('css/login/plugins.css') }}" />

    <!-- Core Style Css -->
    <link rel="stylesheet" href="{{ asset('css/login/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login/fontawesome.min.css') }}" />
    <!-- <link rel="stylesheet" href="{{ asset('css/login/fontawesome.css') }}" /> -->
    <!-- <link rel="stylesheet" href="{{ asset('css/old/style.css') }}" rel="stylesheet" /> -->

    <meta property="og:image" content="{{ asset('images/hns.gif') }}">
    <meta property="og:image:type" content="image/gif">
    <!-- Meta Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1662005714200090');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=1662005714200090&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->
</head>
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<body>

    <div class="container">
        <div id="myModal" id="darkModalForm" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">@lang('login.modalheader')</h4>
                        <button style="color:white" type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label style="color:white">@lang('login.username') *</label>
                                <input id="text" type="username"
                                    class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                    name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label style="color:white">@lang('login.password') *</label>
                                <input id="password" type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <label style="color:white" class="white-text form-check-label">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}> @lang('login.remember_me')</label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" style="color:white"
                                        class="forgot-pass">@lang('login.forgot_password')</a>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-primary btn-block btn-dark">@lang('login.login')</button>
                            </div>
                            {{-- <div class="d-flex"> --}}
                            {{-- <button class="btn btn-facebook mr-2 col"> --}}
                            {{-- <i class="mdi mdi-facebook"></i> Facebook </button> --}}
                            {{-- <button class="btn btn-google col"> --}}
                            {{-- <i class="mdi mdi-google-plus"></i> Google plus </button> --}}
                            {{-- </div> --}}
                        </form>
                        <!-- <span>Coming Soon</span> -->
                    </div>
                    <div class="modal-footer">
                        <p style="color:white">@lang('login.no_account')</p> <a class="btn btn-dark" href="/register">
                            @lang('login.sign_up')</a>
                        {{-- <button style="color:white" type="button" class="btn btn-dark" data-dismiss="modal">@lang('login.close')</button> --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- =====================================
    ==== Start Loading -->

    <div class="loading">
        <div class="text-center middle">
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>

    <!-- End Loading ====
    ======================================= -->


    <!-- =====================================
    ==== Start Navbar -->

    <nav class="navbar navbar-expand-lg">
        <div class="container">

            <!-- Logo -->
            <a class="logo" href="#">
                <img src="{{ asset('login-img/logo-new.png') }}" alt="logo">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="icon-bar"><img src="/svgs/burger-menu-button.svg"></img></span>
            </button>

            <!-- navbar links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/" data-scroll-nav="0">@lang('login.home')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-scroll-nav="1">@lang('login.about')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-scroll-nav="2">Borrow NFT</a>
                    </li>
                    <li class="nav-item header-nav header-social">
                        <a href="https://t.me/hidenseek_group" class="nav-icon">
                            <img src="{{ asset('svgs/telegram.svg') }}" alt="telegram icon">
                        </a>
                        <a href="https://discord.gg/DNYBCqztSv" class="nav-icon">
                            <img src="{{ asset('svgs/discord.svg') }}" alt="discord icon">
                        </a>
                        <a href="https://twitter.com/hidenseek_games" class="nav-icon">
                            <img src="{{ asset('svgs/twitter.svg') }}" alt="twitter icon">
                        </a>
                    </li>
                    <!-- <li class="nav-item header-nav">
              <a href="/register">
                <button type="button" class="sign-in-btn" href="/register">
                  Sign in
                </button>
              </a>
   </li> -->
                </ul>
            </div>
        </div>
    </nav>

    <!-- End Navbar ====
    ======================================= -->


    <!-- =====================================
    ==== Start Header -->

    <header class="header valign bg-img" data-scroll-index="0" data-overlay-dark="5"
        data-background="{{ asset('login-img/background.jpg') }}" data-stellar-background-ratio="0.5">
        <!-- particles -->
        <div id="particles-js"></div>
        <div class="container">
            <div class="row">
                <div class="full-width text-center caption mt-30">
                    <h1><b>@lang('login.boldtitle')</b> @lang('login.firsttext')</h1>
                    <!-- <h1>@lang('login.secondtext')</h1> -->
                    <!-- <div class="sub-date">
                <div class="data-block">
                  <h5>August 12</h5>
                  <span>Minting Date</span>
                </div>
                <div class="divider-line"></div>
                <div class="data-block">
                  <h5>August 24</h5>
                  <span>Drop Date</span>
                </div>
              </div> -->
                    <div class="full-width caption btn-start-block mt-30">
                        @if (session()->get('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-start" id="login">
                            <span>@lang('login.play')</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-learn-more">
            <a href="#" class="btn" data-scroll-nav="1">
                <span>@lang('login.learn')</span>
                <img src="{{ asset('svgs/mouse.svg') }}" alt="mouse icon">
            </a>
        </div>
    </header>

    <!-- End Header ====
    ======================================= -->



    <!-- =====================================
        ==== Start Hero -->

    <section class="hero section-padding" data-scroll-index="1">
        <div class="container">
            <div class="row about-game-row">

                <!-- <div class="intro offset-lg-1 col-lg-10 text-center mb-80" style="color:black">
                        <h3>@lang('login.first')</h3>
                        <h4>@lang('login.second')</h4>
                        <p>@lang('login.third')</p>
                    </div> -->
                <div class="col-12 col-lg-6 about-us-row">
                    <div class="nft-examples-block">
                        <img src="{{ asset('images/nft-esample.png') }}" alt="Nft Example">
                    </div>
                    <a href="https://opensea.io/collection/hidenseek-games" target="_blank">
                        <button class="about-us-button">
                            Explore the NFT Collection
                            <img src="{{ asset('svgs/arrow-right-circle.svg') }}" alt="button-arrow">
                        </button>
                    </a>
                </div>
                <!-- modal waiting -->
                <div class="modal fade table-modal" id="confirmation-modal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-costum-body">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content terms-modal">
                                <div class="terms-modal-text">
                                    {{-- <h4>Wait for confirmation</h4> --}}
                                    <div class="form group">
                                        <label id="tx_status"></label>
                                    </div>
                                </div>
                                <div class="wait-block">
                                    <div class="wait-spin">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="nowallet-modal" class="modal fade table-modal" role="dialog">
                    <div class="modal-costum-body">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content terms-modal">
                                <div class="terms-modal-text">
                                    <a href="https://coinbase-wallet.onelink.me/q5Sx/invite">
                                        <button class="connect-btn" style="border: 1px solid rgba(255, 255, 255, 0.1);">
                                            Login with Coinbase Wallet
                                        </button>
                                    </a>
                                </div>
                                <span>
                                    You need to install Coinbase Wallet App on your mobile device or Coinbase Wallet
                                    Browser Extension to play from desktop browser.
                                </span>
                                <span>
                                    Press the button above to proceed.
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <article class="col-12 col-lg-6 about-us-article mb-md50">
                    <h2>About the Game</h2>
                    <h4 class="about-us-subheading">Get NFT -> Play Free Hide & Seek Game -> Earn USDC</h4>
                    <p>
                        With our game you can hide items in the real world, than enter hints
                        and mark radius on the map. Once players join your game they will see hints,
                        and your marked radius on the map. They will need to follow your hints
                        to find an item. First player who find an item wins a game.
                        Both, game creator and game winner will receive USDC to their wallets.
                    </p>
                    <p>
                        NFT supply will be limited, we will be minting 5000 NFT's,
                        before starting our open beta program. From the total minted NFT's there will be
                        125 Pirates NFT's and 4875 Treasure NFT's. With Pirates you will be able to
                        create a game, and with Treasure you will be able to play a game.
                    </p>
                    <p>
                        Game creators will earn 35% from total bid amount in game.
                        Players will earn 55% from total bid amount in game.
                        Please note that we will never ask for your private keys,
                        NFT's you buy will stay in your wallet.
                        USDC you earn daily will also be staying in your wallet.
                    </p>
                    <p>
                        To explore our whole collection please use a button to go to Opensea.
                        In case you need help or want to ask questions about our game feel free
                        to join our communities on Discord or on Telegram.
                    </p>
                </article>
            </div>
        </div>
    </section>

    @if (count($data) > 0)

    <section class="card-list-section">
        <div class="container">
            <div class="row" id="nft">
                @include('auth.nft')
            </div>
        </div>
    </section>
    @endif

    <div id="buy-modal" class="modal fade table-modal" role="dialog">
        <div class="modal-costum-body">
            <div class="modal-dialog" role="document">
                <div class="modal-content terms-modal">
                    <div class="terms-modal-text">
                        <a href="https://coinbase-wallet.onelink.me/q5Sx/invite">
                            <button class="connect-btn" style="border: 1px solid rgba(255, 255, 255, 0.1);">
                                Login with Coinbase Wallet
                            </button>
                        </a>
                    </div>
                    <span>
Text
                    </span>
                    <span>
                      text2
                    </span>
                </div>
            </div>
        </div>
    </div>

    <section class="card-list-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-mb-120 d-flex">
                    <div class="card-list-block">
                        <div class="card-icon">
                            <img src="{{ asset('svgs/controller.svg') }}" alt="controller icon">
                        </div>
                        <h3>Game</h3>
                        <p>
                            To start playing you will need to download Coinbase Wallet application
                            on your mobile phone and open our website from browser located within app.
                            To be able to successfully authenticate you must own NFT.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 mb-mb-120 d-flex">
                    <div class="card-list-block">
                        <div class="card-icon">
                            <img src="{{ asset('svgs/piggy-bank.svg') }}" alt="piggy bank icon">
                        </div>
                        <h3>Money</h3>
                        <p>
                            User who owns NFT will receive a USDC coins to their wallets
                            daily for the first month, twice a week for the second
                            month, once a week for a third month.
                            With the received amount you can either withdraw it, or
                            you can join or create a games to earn more.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 d-flex">
                    <div class="card-list-block">
                        <div class="card-icon">
                            <img src="{{ asset('svgs/mobile.svg') }}" alt="mobile icon">
                        </div>
                        <h3>Contact</h3>
                        <p>
                            If by any chance you need to contact our administration
                            you can do so by contacting us on our Discord server or directly
                            to Email at: support@hidenseek.games
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero ====
        ======================================= -->
    <section class="slider-section" data-scroll-index="2">
        <div class="container">
            <div class="row">
                <article class="col-12 borrow-article mb-md50">
                    <h2>Borrow NFT</h2>
                    <p>
                        Here you can see available NFTs to borrow, price per day is 0.5 USDC.
                        Winning the game with the borrowed Creators NFT will earn you a 10% from the total bid in game.
                        Winning the game with the Players NFT will earn you a 40% from the total bid in game.
                    </p>
                </article>
                <div class="col-12">
                    @if (sizeof($delegations) > 0)
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                <input type="hidden" id="usdt_addr" value="{{ config('web3.chain.token') }}">
                                <input type="hidden" id="nft_addr" value="{{ config('web3.chain.nft') }}">
                                @foreach ($delegations as $index => $delegation)
                                    <div class="swiper-slide">
                                        <div class="slider-content">
                                            <div class="slider-text">
                                                <h4>{{ $nft_name[$index] }}</h4>
                                                <span>{{ $delegation->duration }} Days</span>
                                            </div>
                                            <div class="slider-buttons">
                                                <button class="slider-button-delegate"
                                                    onclick="javascript:borrow({{ $delegation->token_id }}, {{ $delegation->duration }})">Borrow</button>
                                            </div>
                                        </div>
                                        <img src="{{ $nft_image[$index] }}" alt="mouse icon">
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    @else
                        <p>Currently, no NFTs are available for borrowing.</p>
                        <p>Please, check back later.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>


    <!-- =====================================
        ==== Start Footer -->

    <footer class="text-center">
        <div class="container">

            <!-- Logo -->
            <a class="logo" href="#">
                <img src="{{ asset('login-img/logo-new.png') }}" alt="logo">
            </a>

            <div class="social">
                <a href="https://discord.gg/DNYBCqztSv" class="icon">
                    <img src="{{ asset('svgs/discord.svg') }}" alt="discord icon">
                </a>
                <a href="https://t.me/hidenseek_group" class="icon">
                    <img src="{{ asset('svgs/telegram.svg') }}" alt="telegram icon">
                </a>
                <a href="https://twitter.com/hidenseek_games" class="icon">
                    <img src="{{ asset('svgs/twitter.svg') }}" alt="twitter icon">
                </a>
            </div>

            <p>&copy; 2022 HIDENSEEK.GAMES</p>

        </div>
    </footer>

    <!-- End Footer ====
        ======================================= -->



    {{-- <script>
// Set the date we're counting down to
var countDownDate = new Date("Aug 26, 2022 00:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script> --}}
    <!-- jQuery -->
    <script src="{{ asset('js/login/jquery-3.0.0.min.js') }}"></script>
    <!-- <script src="{{ asset('js/login/jquery-migrate-3.0.0.min.js') }}"></script> -->

    <!-- popper.min -->
    <!-- <script src="{{ asset('js/login/popper.min.js') }}"></script> -->

    <!-- fonts -->
    <!-- <script src="{{ asset('js/login/all.js') }}"></script> -->

    <!-- bootstrap -->
    <script src="{{ asset('js/login/bootstrap.min.js') }}"></script>

    <!-- scrollIt -->
    <script src="{{ asset('js/login/scrollIt.min.js') }}"></script>

    <!-- jquery.waypoints.min -->
    <!-- <script src="{{ asset('js/login/jquery.waypoints.min.js') }}"></script> -->

    <!-- jquery.counterup.min -->
    <!-- <script src="{{ asset('js/login/jquery.counterup.min.js') }}"></script> -->

    <!-- owl carousel -->
    <!-- <script src="{{ asset('js/login/owl.carousel.min.js') }}"></script> -->

    <!-- jquery.magnific-popup js -->
    <!-- <script src="{{ asset('js/login/jquery.magnific-popup.min.js') }}"></script> -->

    <!-- stellar js -->
    <!-- <script src="{{ asset('js/login/jquery.stellar.min.js') }}"></script> -->

    <!-- isotope.pkgd.min js -->
    <!-- <script src="{{ asset('js/login/isotope.pkgd.min.js') }}"></script> -->

    <!-- YouTubePopUp.jquery -->
    <!-- <script src="{{ asset('js/login/YouTubePopUp.jquery.js') }}"></script> -->

    <!-- particles.min js -->
    <!-- <script src="{{ asset('js/login/particles.min.js') }}"></script> -->

    <!-- app js -->
    <!-- <script src="{{ asset('js/login/app.js') }}"></script> -->

    <!-- Map -->
    <!-- <script src="{{ asset('js/login/map.js') }}"></script> -->

    <!-- validator js -->
    <!-- <script src="{{ asset('js/login/validator.js') }}"></script> -->

    <!-- custom scripts -->
    <script src="{{ asset('js/login/scripts.js') }}"></script>

    <!-- wallet scripts -->
    <script src="https://cdn.ethers.io/lib/ethers-5.2.umd.min.js" type="application/javascript"></script>
    <script src="{{ asset('js/wallet.js') }}"></script>
    <script type="text/javascript">
        @if (count($errors) > 0)
            $('#myModal').modal('show');
        @endif
    </script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                "@0.00": {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                "@1.10": {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                "@1.50": {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
            },
        });
    </script>

<script type="text/javascript">
    $(document).ready(function(){
    
    $(document).on('click', '.pagination a', function(event){
     event.preventDefault(); 
     var page = $(this).attr('href').split('page=')[1];
     fetch_data(page);
    });
    
    function fetch_data(page)
    {
     $.ajax({
      url:"/fetch_data?page="+page,
      success:function(data)
      {
       $('#nft').html(data);
      }
     });
    }
    
    });
    
    
    </script>
</body>

</html>
