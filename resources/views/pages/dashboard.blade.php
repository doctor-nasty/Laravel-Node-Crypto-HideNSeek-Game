@extends('layouts.mainlayout')

@section('content')
<script>  
    $.ajax({
      url: "{{ url('/get_balance') }}",
    })
      .done(function( data ) {
        $('#balance2').html(data);
        console.log( "Sample of data:", data.slice( 0, 100 ) );
      });
  </script>
    <div id="app">
    </div>
    <div class="content-wrapper">
        @if (session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <!-- <div class="row">
                      <div class="col-md-6 grid-margin">
                        <div class="dashboard-card">
                          <div class="dashboard-card-text">
                            <h5>@lang('dashboard.games_played')</h5>
                            <span class="dashboard-card-number">{{ $gamesplayed }}</span>
                          </div>
                          <div class="dashboard-card-image">
                            <img src="{{ asset('images/component2.png') }}" alt="">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 grid-margin">
                        <div class="dashboard-card">
                          <div class="dashboard-card-text">
                            <h5>@lang('dashboard.points_earned')</h5>
                            <span class="dashboard-card-number">120</span>
                          </div>
                          <span class="dashboard-card-number">{{ Auth::user()->total_winning_points }}</span>
                          <div class="dashboard-card-image">
                            <img src="{{ asset('images/component.png') }}" alt="">
                          </div>
                        </div>
                      </div>
                    </div> -->
        <div class="player-card">
            <div class="payer-avatar-block">
                <div class="payer-avatar-image">
                    <img src="/storage/avatars/{{ Auth::user()->avatar }}" alt="random avatar">
                </div>
                <a href="/settings">
                    <button class="avatar-edit-button">
                        <img src="{{ asset('svgs/pencil.png') }}" alt="">
                    </button>
                </a>
            </div>
            <div class="player-content">
                <div class="player-info">
                    <h4 class="player-wallet">
                        {{ Str::substr(Auth::user()->wallet_address, 0, 5) }}....{{ Str::substr(Auth::user()->wallet_address, -5) }}
                    </h4>
                    <button class="wallet-copy">
                        <img src="{{ asset('svgs/copy.png') }}" alt="">
                    </button>
                </div>
                <div class="player-point-row">
                    <div class="player-point-block">
                        <div class="point-icon">
                            <img src="{{ asset('svgs/controler-blue.svg') }}" alt="controler icon">
                        </div>
                        <div class="point-text">
                            <h5>@lang('dashboard.games_played')</h5>
                            <span>{{ $gamesplayed }}</span>
                        </div>
                    </div>
                    <div class="player-point-block">
                        <div class="point-icon">
                            <img src="{{ asset('svgs/point-icon.svg') }}" alt="point icon">
                        </div>
                        <div class="point-text">
                            <h5>@lang('dashboard.points_earned')</h5>
                            <span>{{ $points_earned }}</span>
                        </div>
                    </div>
                    <div class="player-point-block">
                        <div class="point-icon">
                            <img src="{{ asset('svgs/usdc-icon.svg') }}" alt="point icon">
                        </div>
                        <div class="point-text">
                            <h5>Your Balance</h5>
                            <span id="balance2">0.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-block table-size">
            <div class="menu change-content-btn">
                <button class="button_active btn-change">Games Bidded</button>
                <button class="btn-change">Own Games</button>
                <button class="btn-change">My Items</button>
            </div>
            <div class="row">
                <div class="content_inside content_inside_active">
                    <div class="table-responsive">
                        <table id="gamesbidded" class="display dashboard-table table">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    {{-- <th>Title</th> --}}
                                    <th>Country</th>
                                    <th>City</th>
                                    <th>District</th>
                                    <th>Price</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gamesbidded as $bidded)
                                    <tr>
                                        <td><img src="/game-photos/{{ $bidded->photo }}"
                                                class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                                                alt="{{ $bidded->title }}"></td>
                                        {{-- <td>{{ $bidded->title }}</td> --}}
                                        <td>{{ $bidded->country }}</td>
                                        <td>{{ $bidded->city }}</td>
                                        <td>{{ $bidded->district }}</td>
                                        <td>{{ $bidded->points }}</td>
                                        <td>{{ $bidded->created_at }}</td>
                                        @if (session('can_play'))
                                            <td>
                                                <div class="data-table-buttons-wrapper"><button type="button"
                                                        class="btn btn-info details-button" title="Details"
                                                        data-id="{{ $bidded->id }}" data-toggle="modal"
                                                        data-target="#myModal">Play</button></div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="content_inside">
                    <div class="table-responsive">
                        <table id="owngames" class="display dashboard-table table">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    {{-- <th>Title</th> --}}
                                    <th>Country</th>
                                    <th>City</th>
                                    <th>District</th>
                                    <th>Price</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($owngames as $own)
                                    <tr>
                                        <td><img src="/game-photos/{{ $own->photo }}"
                                                class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                                                alt="{{ $own->title }}"></td>
                                        {{-- <td>{{ $own->title }}</td> --}}
                                        <td>{{ $own->country }}</td>
                                        <td>{{ $own->city }}</td>
                                        <td>{{ $own->district }}</td>
                                        <td>{{ $own->points }}</td>
                                        <td>{{ $own->created_at }}</td>
                                            <td>
                                                <div class="data-table-buttons-wrapper"><button type="button"
                                                        class="btn btn-info details-button" title="Details"
                                                        data-id="{{ $own->id }}" data-toggle="modal"
                                                        data-target="#myModal">View</button></div>
                                            </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="content_inside">
                <div class="dashboard-slider">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach ($tokens as $index => $token)
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="{{ $nft_image[$index] }}"></img>
                                    <div class="slider-content">
                                        <div class="slider-text">
                                            <h4>{{ $nft_name[$index] }}</h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>

    </div>
    <!-- <div class="row grid-margin" id="bidded">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">@lang('dashboard.bidded')</h4>
                              <table class="display nowrap" id="data-table-bid" cellspacing="0" width="100%"></table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row grid-margin">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">@lang('dashboard.your_games')</h4>
                            
                                <table class="display nowrap" id="data-table" cellspacing="0" width="100%"></table>
                          </div>
                        </div>
                      </div>
                    </div> -->

    <div id="myModal" id="darkModalForm" tabindex="-1" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <!--                        <div class="modal-header">
                                    <h4 class="modal-title">Details</h4>
                                    <button style="color:white" type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>-->
                <div id="modal-body" class="modal-body">

                </div>
            </div>

        </div>
    </div>
    <div id="myModal2" id="darkModalForm" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <!--                        <div class="modal-header">
                                    <h4 class="modal-title">Details</h4>
                                    <button style="color:white" type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>-->
                <div id="modal-body2" class="modal-body">

                </div>
            </div>

        </div>
    </div>

    </div>
    <script>
        var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
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
          "@1.00": {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          "@1.50": {
            slidesPerView: 3,
            spaceBetween: 40,
          },
        },
      });
        var dt = $('#gamesbidded').DataTable({
            responsive: true,
            paging: false,
            searching: false
        });
        var dt = $('#owngames').DataTable({
            responsive: true,
            paging: false,
            searching: false
        });
        $(document).ready(function() {
            $('#myModal').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).attr('data-id');
                $.ajax({
                    type: 'post',
                    url: 'getGameModalHtml', //Here you will fetch records
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id': rowid
                    }, //Pass $id
                    success: function(data) {
                        $('#modal-body').html(data); //Show fetched data from database
                    }
                });
            });

            $('#myModal2').on('show.bs.modal', function(e) {
                //$('#myModal').modal('hide');
                var rowid = $(e.relatedTarget).attr('data-id');
                $.ajax({
                    type: 'post',
                    url: 'getGameEditModalHtml', //Here you will fetch records
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id': rowid
                    }, //Pass $id
                    success: function(data) {
                        $('#modal-body2').html(data); //Show fetched data from database
                    }
                });
            });
        });
    </script>
    <script>
        let button = document.querySelectorAll('.menu button');
        let content_inside = document.querySelectorAll('.content_inside');

        Array.from(button).forEach(function(buttonArray, i) {
            buttonArray.addEventListener('click', function() {

                // window.dispatchEvent(new Event('resize'));

                Array.from(button).forEach(buttonAll => buttonAll.classList.remove('button_active'));

                Array.from(content_inside).forEach(content_insideAll => content_insideAll.classList.remove(
                    'content_inside_active'));

                button[i].classList.add('button_active');

                content_inside[i].classList.add('content_inside_active');
            });
        });
    </script>
    <style>
        .menu {
            display: flex;
        }

        .content_inside {
            width:100%;
            display: none;
            border: 1px solid #2a2a2a;
            border-radius: 28px;
            padding: 22px;
        }

        .content_inside_active {
            width:100%;
            display: block;
        }
    </style>
    <script>
        function tableResize(){
            let tableBlock = document.querySelector('.table-size');
            let tableWidth = tableBlock.offsetWidth;
            if(tableWidth >= 252 && tableWidth < 341){
                $(".dashboard-table tbody tr td:nth-child(3)").css("border-radius", "0 30px 30px 0");
            }
            else if (tableWidth >= 341 && tableWidth < 409){
                $(".dashboard-table tbody tr td:nth-child(3)").css("border-radius", "0")
                $(".dashboard-table tbody tr td:nth-child(4)").css("border-radius", "0 30px 30px 0")
            }
            else if(tableWidth >= 409 && tableWidth < 490){
                $(".dashboard-table tbody tr td:nth-child(4)").css("border-radius", "0")
                $(".dashboard-table tbody tr td:nth-child(5)").css("border-radius", "0 30px 30px 0")
            }
            else if(tableWidth >= 490 && tableWidth < 567){
                $(".dashboard-table tbody tr td:nth-child(5)").css("border-radius", "0")
                $(".dashboard-table tbody tr td:nth-child(6)").css("border-radius", "0 30px 30px 0")
            }
            else if(tableWidth >= 567){
                $(".dashboard-table tbody tr td:nth-child(6)").css("border-radius", "0")
                $(".dashboard-table tbody tr td:nth-child(7)").css("border-radius", "0 30px 30px 0")
            }
        }
        function timeFunction() {
            setTimeout(function(){
                tableResize()
            }, 500);
        }
        timeFunction()
        $(window).resize(function() {
        tableResize() 
        });
    </script>
@endsection
