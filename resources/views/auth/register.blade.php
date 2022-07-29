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

    </head>

    <body>
<!-- Modal -->
    <div id="myModal2" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="color:white" class="modal-title">@lang('register.register')</h4>
          <button style="color:white" type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{ route('register') }}">
            @csrf
          <!-- <div class="form-group">
            <label>@lang('register.first_name')</label>
            <input id="name" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required autofocus>
        <small>@lang('register.fntext')</small>
            @if ($errors->has('firstname'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('firstname') }}</strong>
                            </span>
                        @endif
          </div>
            <div class="form-group">
                <label>@lang('register.last_name')</label>
                <input id="name" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required autofocus>
                <small>@lang('register.lntext')</small>
                @if ($errors->has('lastname'))
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('lastname') }}</strong>
                            </span>
                @endif
            </div> -->
            <div class="form-group">
                <label>@lang('register.username')</label>
                <div class="input-group">
                    <span class="input-group-addon bg-dark" id="basic-addon1">@</span>
                    <input id="name" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                  </div>
                  <small>@lang('register.untext')</small>
                @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                @endif
            </div>
            <!-- <div class="form-group">
                <label>@lang('register.phone_number')</label>
                  <div class="input-group">
                      <span class="input-group-addon bg-dark" id="basic-addon1">+995</span>
                            <input name="phone_number" id="phone_number" type="number" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" value="{{ old('phone_number') }}" required autofocus>
                          </div>
                          <small>@lang('register.pntext')</small>
                          @if ($errors->has('phone_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                            @endif
              </div> -->
              {{-- <div class="form-group">
                  <label>@lang('register.id_number')</label>
                    <div class="input-group">
                              <input name="id_number" id="id_number" type="number" class="form-control{{ $errors->has('id_number') ? ' is-invalid' : '' }}" value="{{ old('id_number') }}" required autofocus>
                            </div>
                            <small>@lang('register.idtext')</small>
                            @if ($errors->has('id_number'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('id_number') }}</strong>
                                  </span>
                              @endif
                </div> --}}
          <!-- <div class="form-group">
            <label>@lang('register.gender')</label>
              <div class="input-group">
                  <select name="gender" id="gender" required autofocus class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}">
                      <option selected disabled></option>
                      <option>@lang('register.male')</option>
                      <option>@lang('register.female')</option>
                  </select>
              </div>
                        @if ($errors->has('gender'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('gender') }}</strong>
                            </span>
                        @endif
          </div> -->
          <!-- <div class="form-group">
            <label>@lang('register.date_of_birth')</label>
              <div class="input-group date datepicker">
                  <input name="date_of_birth" type="date" id="date_of_birth" required autofocus class="form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}">
              </div>
              <small>@lang('register.dobtext')</small>
              @if ($errors->has('date_of_birth'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('date_of_birth') }}</strong>
                            </span>
                        @endif
          </div> -->
          <div class="form-group">
            <label>@lang('register.email')</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                        <small>@lang('register.emailtext')</small>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
          </div>
          <div class="form-group">
            <label>@lang('register.password')</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
          </div>
          <div class="form-group">
            <label>@lang('register.confirm_password')</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary btn-block enter-btn">@lang('register.register')</button>
          </div>
        </form>
        <!-- <span>Coming Soon</span> -->
          </div>
        {{-- <div class="modal-footer">
          <p style="color:white" class="sign-up">@lang('register.read')</p> <a class="btn btn-dark" href="#" data-toggle="modal" data-target="#myModal" data-dismiss="modal"> @lang('register.register')</a>
          <button style="color:white" type="button" class="btn btn-danger" data-dismiss="modal">@lang('login.close')</button>
        </div> --}}
        <!-- <div class="modal-footer">
          <p style="color:white" class="sign-up">@lang('register.haveacc')</p> <a class="btn btn-dark" href="/login"> @lang('register.haveacclogin')</a>
          {{-- <button style="color:white" type="button" class="btn btn-danger" data-dismiss="modal">@lang('login.close')</button> --}}
        </div> -->
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
            <a class="logo" href="/">
                <img src="{{ asset('login-img/logo.png') }}" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="icon-bar"><i class="fas fa-bars"></i></span>
            </button>

			  <!-- navbar links -->
			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav ml-auto">
          <li class="nav-item">
			        <a class="nav-link" href="/">@lang('login.home')</a>
            </li>
			      <li class="nav-item">
			        <a class="nav-link active" href="/register">@lang('register.register')</a>
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
                        <p style="color:white">@lang('register.text')</p>
                        <p style="color:white">@lang('register.text2')</p>
                        <p style="color:white">@lang('register.text3')</p>
                        <p style="color:white">@lang('register.text4')</p>
                        <p style="color:white">@lang('register.text5')</p>
                        <p style="color:white">@lang('register.text6')</p>
                        <br>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal2">
                    <span>@lang('register.registerbtn')</span>
                </button>
            </div>
    			</div>
    		</div>
    	</header>

    	<!-- End Header ====
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
                    <a href="/" class="icon">
                        <i class="fab fa-facebook-square"></i>
                    </a>
                    <a href="/" class="icon">
                        <i class="fab fa-telegram"></i>
                    </a>
                  </div>

                <p>&copy; 2022 HIDENSEEK.</p>

            </div>
        </footer>

        <!-- End Footer ====
        ======================================= -->





        <!-- jQuery -->
        <script src="{{ asset('js/login/jquery-3.0.0.min.js') }}"></script>
        <script src="{{ asset('js/login/jquery-migrate-3.0.0.min.js') }}"></script>

        <!-- popper.min -->
        <script src="{{ asset('js/login/popper.min.js') }}"></script>

        <!-- bootstrap -->
        <script src="{{ asset('js/login/bootstrap.min.js') }}"></script>

        <!-- fonts -->
        <script src="{{ asset('js/login/all.js') }}"></script>

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
              $('#myModal2').modal('show');
          @endif
          </script>
    </body>
</html>
