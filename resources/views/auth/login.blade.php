<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}>

    <head>
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-142304536-1"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-142304536-1');
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
                <img src="{{ asset('login-img/logo.png') }}" alt="logo">
            </a>

			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="icon-bar"><i class="fas fa-bars"></i></span>
			  </button>

			  <!-- navbar links -->
			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav ml-auto">
			      <li class="nav-item">
			        <a class="nav-link active" href="#" data-scroll-nav="0">@lang('login.home')</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="/register">@lang('register.register')</a>
			      </li>
			      <li class="nav-item">
                    <a class="nav-link" href="#" data-scroll-nav="1">@lang('login.about')</a>
                  </li>

			      <li class="nav-item">
                <a href="locale/ge" class="nav-link">
                  <div class="preview-thumbnail">
                  <img src="{{ asset('images/flags/ge.png') }}" alt="image" class="rounded-circle profile-pic" style="width:20px;height:20px;">
                  </div>
                </a>
            </li>
			      <li class="nav-item">
              <a href="locale/en" class="nav-link">
                <div class="preview-thumbnail">
                  <img src="{{ asset('images/flags/en.png') }}" alt="image" class="rounded-circle profile-pic" style="width:20px;height:20px;">
                </div>
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

    	<header class="header valign bg-img" data-scroll-index="0" data-overlay-dark="5" data-background="{{ asset('login-img/bg.jpg') }}" data-stellar-background-ratio="0.5">

            <!-- particles -->
            <div id="particles-js"></div>

    		<div class="container">
    			<div class="row">
    				<div class="full-width text-center caption mt-30">
    					<h4>@lang('login.firsttext')</h4>
                        <h1>@lang('login.secondtext')</h1>
                        <p>@lang('login.thirdtext')</p>
                        <div class="full-width text-center caption mt-30">
                            @if(session()->get('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif

                        <a href="#" class="btn btn-dark" data-scroll-nav="1">
                            <span>@lang('login.learn')</span>
                        </a>
                        <!-- Trigger the modal with a button -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
    <span>@lang('login.play')</span>
</button></div>
    				</div>
    			</div>
    		</div>
    	</header>

    	<!-- End Header ====
    	======================================= -->



        <!-- =====================================
        ==== Start Hero -->

        <section class="hero section-padding" data-scroll-index="1">
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
        </section>

        <!-- End Hero ====
        ======================================= -->

        <!-- =====================================
        ==== Start Footer -->

        <footer class="text-center">
            <div class="container">

                <!-- Logo -->
                <a class="logo" href="#">
                    <img src="{{ asset('login-img/logo.png') }}" alt="logo">
                </a>

                <div class="social">
                  <a href="https://www.facebook.com/Unreal-Reality-685933075171285/" class="icon">
                      <i class="fab fa-facebook-square"></i>
                  </a>
                  {{-- <a href="https://t.me/joinchat/LsZusBeowb2o1U30XcVfXw" class="icon">
                      <i class="fab fa-telegram"></i>
                  </a> --}}
                </div>

                <p>&copy; 2020 Unreal Reality.</p>

            </div>
        </footer>

        <!-- End Footer ====
        ======================================= -->





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

        <script type="text/javascript">
          @if (count($errors) > 0)
              $('#myModal').modal('show');
          @endif
          </script>

    </body>
</html>
