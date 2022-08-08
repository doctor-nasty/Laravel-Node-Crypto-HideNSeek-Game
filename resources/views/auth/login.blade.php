<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-YED843SXDX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-YED843SXDX');
</script>


    	<!-- Metas -->
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

		<!-- Title  -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @if(isset($title))
        {{ $title }}
        @else
        {{ config('app.name') }}
        @endif
    </title>

		<!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />

		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900" rel="stylesheet">

		<!-- Plugins -->
		<link rel="stylesheet" href="{{ asset('css/login/plugins.css') }}" />

        <!-- Core Style Css -->
        <link rel="stylesheet" href="{{ asset('css/login/style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/login/fontawesome.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/login/fontawesome.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/all.css') }}" rel="stylesheet"/>

    </head>

    <body>

<!-- Modal -->
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
                            <input id="text" type="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                            @if ($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
              </div>
              <div class="form-group">
                <label style="color:white">@lang('login.password') *</label>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
              </div>
              <div class="form-group d-flex align-items-center justify-content-between">
                <div class="form-check">
                  <label style="color:white" class="white-text form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> @lang('login.remember_me')</label>
                </div>
               @if (Route::has('password.request'))
               <a href="{{ route('password.request') }}" style="color:white" class="forgot-pass">@lang('login.forgot_password')</a>
               @endif
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block btn-dark">@lang('login.login')</button>
              </div>
              {{--<div class="d-flex">--}}
                {{--<button class="btn btn-facebook mr-2 col">--}}
                  {{--<i class="mdi mdi-facebook"></i> Facebook </button>--}}
                {{--<button class="btn btn-google col">--}}
                  {{--<i class="mdi mdi-google-plus"></i> Google plus </button>--}}
              {{--</div>--}}
            </form>
            <!-- <span>Coming Soon</span> -->
          </div>
        <div class="modal-footer">
          <p style="color:white">@lang('login.no_account')</p> <a class="btn btn-dark" href="/register"> @lang('login.sign_up')</a>
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
    			<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
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

			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="icon-bar"><i class="fas fa-bars"></i></span>
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
            <li class="nav-item header-nav header-social">
                <a href="#" class="nav-icon">
                  <img src="{{ asset('svgs/telegram.svg')}}" alt="telegram icon">
                </a>
                <a href="#" class="nav-icon">
                  <img src="{{ asset('svgs/discord.svg')}}" alt="discord icon">
                </a>
            </li>
			      <li class="nav-item header-nav">
			        <!-- <a class="nav-link" href="/register">@lang('register.register')</a> -->
              <a href="/register">
                <button type="button" class="sign-in-btn" href="/register">
                  Sign in
                </button>
              </a>
			      </li>
			    </ul>
			  </div>
			</div>
		</nav>

    	<!-- End Navbar ====
    	======================================= -->


    	<!-- =====================================
    	==== Start Header -->

    	<header class="header valign bg-img" data-scroll-index="0" data-overlay-dark="5" data-background="{{ asset('login-img/background.jpg') }}" data-stellar-background-ratio="0.5">
        <!-- particles -->
        <div id="particles-js"></div>
    		<div class="container">
    			<div class="row">
    				<div class="full-width text-center caption mt-30">
    					<h1><b>@lang('login.boldtitle')</b> @lang('login.firsttext')</h1>
              <!-- <h1>@lang('login.secondtext')</h1> -->
              <h4 id="demo"></h4>
              <p>@lang('login.thirdtext')</p>
              <div class="full-width caption mt-30 btn-start-block">
                @if(session()->get('message'))
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
            <img src="{{ asset('svgs/mouse.svg')}}" alt="mouse icon">
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
                        <img src="{{ asset('images/nft-esample.png')}}" alt="Nft Example">
                      </div>
                      <button class="about-us-button">
                        Explore the NFT Collection
                        <img src="{{ asset('svgs/arrow-right-circle.svg')}}" alt="button-arrow">
                      </button>
                    </div>
                    <article class="col-12 col-lg-6 about-us-article mb-md50">
                      <h2>About the Game</h2>
                      <h4 class="about-us-subheading">How it Works</h4>
                      <p>
                        Game instructions: We will have 2 types of NFTs for users, 
                        one type is with game creation option and another type is with 
                        game playing option. Game creation NFT costs $500, game playing NFT 
                        costs $100. If user owns both NFTs they can do both, game creation 
                        and playing. There will be a limited amount of NFTs on opensea. 
                        User who owns NFT will receive a USDC to their wallets daily for 
                        the first month, twice a week for the second month, once a week 
                        for a third month.
                      </p>
                      <p>
                        Users will need to login to our website through Phantom wallet 
                        mobile app browser in order to be able to connect Phantom wallet, 
                        when connecting Phantom wallet system will check if there is a NFT 
                        in the wallet. Based on the NFT user will have either game creation 
                        option or game playing option.
                      </p>
                      <p>
                        When creating a game users should choose participant amount for game 
                        starting and game bid amount (after game is created bid amount will be 
                        deducted from users wallet and sent to our wallet). User should write 
                        small comment which will be visible for all users and full description 
                        with hints which will be visible to only users who makes a bid. Users 
                        should mark a location with circle in the radius of 500 meters, where 
                        item is hidden.
                      </p>
                      <p>
                        When user joins a game USDC will be deducted from his wallet and sent 
                        to our wallet. Then he will see games full description, hints, and 
                        radius of the hidden item on the map. User who wins a game gets 55% 
                        from total amount, creator gets 30% and 15% stays in our wallet.
                      </p> 
                    </article>
                </div>
            </div>
        </section>
        <!-- <section class="hero section-padding" data-scroll-index="2">
            <div class="container">
                <div class="row">

                    <div class="intro offset-lg-1 col-lg-10 text-center mb-80" style="color:black">
                        <h3>@lang('login.first')</h3>
                        <h4>@lang('login.second')</h4>
                        <p>@lang('login.third')</p>
                    </div>

                    <div class="col-lg-4" style="color:black">
                        <div class="item text-center mb-md50">
                            <span class="fas fa-gamepad"></span>
                            <h5>@lang('login.firstboxtitle')</h5>
                            <p>@lang('login.firstboxtext')</p>
                        </div>
                    </div>

                    <div class="col-lg-4" style="color:black">
                        <div class="item text-center mb-md50">
                            <span class="fas fa-money-bill"></span>
                            <h5>@lang('login.secondboxtitle')</h5>
                            <p>@lang('login.secondboxtext')</p>
                        </div>
                    </div>

                    <div class="col-lg-4" style="color:black">
                        <div class="item text-center">
                            <span class="fas fa-envelope"></span>
                            <h5>@lang('login.thirdboxtitle')</h5>
                            <p>@lang('login.thirdboxtext')</p>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <section class="card-list-section" data-scroll-index="2">
          <div class="container">
            <div class="row">
              <div class="col-lg-4 mb-mb-120">
                <div class="card-list-block">
                  <div class="card-icon">
                    <img src="{{ asset('svgs/controller.svg')}}" alt="controller icon">
                  </div>
                  <h3>Game</h3>
                  <p>
                    Game instructions: We will have 2 types of NFTs for users, 
                    one type is with game creation option and another type is 
                    with game playing option. Game creation NFT costs $500, game 
                    playing NFT costs $100. If user owns both NFTs they can do both, 
                    game creation and playing. There will be a limited amount of NFTs 
                    on opensea. User who owns NFT will receive a USDC to their wallets 
                    daily for the first month, twice a week for the second 
                    month, once a week for a third month. Users will need to 
                    login to our website through Phantom wallet mobile app browser 
                    in order to be able to connect Phantom wallet, when connecting 
                    Phantom wallet system will check if there is a NFT in the wallet. 
                    Based on the NFT user will have either game creation option or game playing option.
                  </p>
                </div>
              </div>
              <div class="col-lg-4 mb-mb-120">
                <div class="card-list-block">
                  <div class="card-icon">
                    <img src="{{ asset('svgs/piggy-bank.svg')}}" alt="piggy bank icon">
                  </div>
                  <h3>Money</h3>
                  <p>
                    Game instructions: We will have 2 types of NFTs for users, 
                    one type is with game creation option and another type is 
                    with game playing option. Game creation NFT costs $500, game 
                    playing NFT costs $100. If user owns both NFTs they can do both, 
                    game creation and playing. There will be a limited amount of NFTs 
                    on opensea. User who owns NFT will receive a USDC to their wallets 
                    daily for the first month, twice a week for the second 
                    month, once a week for a third month. Users will need to 
                    login to our website through Phantom wallet mobile app browser 
                    in order to be able to connect Phantom wallet, when connecting 
                    Phantom wallet system will check if there is a NFT in the wallet. 
                    Based on the NFT user will have either game creation option or game playing option.
                  </p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="card-list-block">
                  <div class="card-icon">
                    <img src="{{ asset('svgs/mobile.svg')}}" alt="mobile icon">
                  </div>
                  <h3>Contact</h3>
                  <p>
                    Game instructions: We will have 2 types of NFTs for users, 
                    one type is with game creation option and another type is 
                    with game playing option. Game creation NFT costs $500, game 
                    playing NFT costs $100. If user owns both NFTs they can do both, 
                    game creation and playing. There will be a limited amount of NFTs 
                    on opensea. User who owns NFT will receive a USDC to their wallets 
                    daily for the first month, twice a week for the second 
                    month, once a week for a third month. Users will need to 
                    login to our website through Phantom wallet mobile app browser 
                    in order to be able to connect Phantom wallet, when connecting 
                    Phantom wallet system will check if there is a NFT in the wallet. 
                    Based on the NFT user will have either game creation option or game playing option.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End Hero ====
        ======================================= -->

        <!-- =====================================
        ==== Start Footer -->

        <footer class="text-center">
            <div class="container">

                <!-- Logo -->
                <a class="logo" href="#">
                    <img src="{{ asset('login-img/logo-new.png') }}" alt="logo">
                </a>

                <div class="social">
                  <a href="#" class="icon">
                      <img src="{{ asset('svgs/discord.svg')}}" alt="discord icon">
                  </a>
                  <a href="#" class="icon">
                      <img src="{{ asset('svgs/telegram.svg')}}" alt="telegram icon">
                  </a> 
                </div>

                <p>&copy; 2022 HIDENSEEK.GAMES</p>

            </div>
        </footer>

        <!-- End Footer ====
        ======================================= -->



        <script>
// Set the date we're counting down to
var countDownDate = new Date("Aug 20, 2022 00:00:00").getTime();

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
</script>
        <!-- jQuery -->
        <script src="{{ asset('js/login/jquery-3.0.0.min.js') }}"></script>
        <script src="{{ asset('js/login/jquery-migrate-3.0.0.min.js') }}"></script>

        <!-- popper.min -->
        <script src="{{ asset('js/login/popper.min.js') }}"></script>

        <!-- fonts -->
        <script src="{{ asset('js/login/all.js') }}"></script>

        <!-- bootstrap -->
        <script src="{{ asset('js/login/bootstrap.min.js') }}"></script>

        <!-- scrollIt -->
        <script src="{{ asset('js/login/scrollIt.min.js') }}"></script>

        <!-- jquery.waypoints.min -->
        <script src="{{ asset('js/login/jquery.waypoints.min.js') }}"></script>

        <!-- jquery.counterup.min -->
        <script src="{{ asset('js/login/jquery.counterup.min.js') }}"></script>

        <!-- owl carousel -->
        <script src="{{ asset('js/login/owl.carousel.min.js') }}"></script>

        <!-- jquery.magnific-popup js -->
        <script src="{{ asset('js/login/jquery.magnific-popup.min.js') }}"></script>

        <!-- stellar js -->
        <script src="{{ asset('js/login/jquery.stellar.min.js') }}"></script>

        <!-- isotope.pkgd.min js -->
        <script src="{{ asset('js/login/isotope.pkgd.min.js') }}"></script>

        <!-- YouTubePopUp.jquery -->
        <script src="{{ asset('js/login/YouTubePopUp.jquery.js') }}"></script>

        <!-- particles.min js -->
        <script src="{{ asset('js/login/particles.min.js') }}"></script>

        <!-- app js -->
        <script src="{{ asset('js/login/app.js') }}"></script>

        <!-- Map -->
        <script src="{{ asset('js/login/map.js') }}"></script>

        <!-- validator js -->
        <script src="{{ asset('js/login/validator.js') }}"></script>

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

    </body>
</html>
