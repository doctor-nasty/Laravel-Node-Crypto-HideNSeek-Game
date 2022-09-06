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
        <div class="player-card">
            <div class="payer-avatar-block">
                <div class="payer-avatar-image">
                    <img src="/storage/avatars/{{ Auth::user()->avatar }}" alt="random avatar">
                </div>
                <a href="/settings">
                    <button class="avatar-edit-button">
                        <img src="{{ asset('svgs/edit.svg') }}" alt="">
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
                            <h5>USDC Earned</h5>
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
        @if (session('can_create'))
        <div class="section-block table-size">
            <div class="change-content-btn">
                <div class="active" aria-current="page">
                    <span class="btn-change">Own Games</span>
                </div>
            </div>
    
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="owngames" class="display dashboard-table table" width="100%">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    {{-- <th>Title</th> --}}
                                    <th>Country</th>
                                    <th>City</th>
                                    <th>District</th>
                                    <th>Price</th>
                                    <th>Players</th>
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
                                        <td>{{count($own->bids)}}/{{ $own->players }}</td>
                                        <td>{{ $own->created_at }}</td>
                                            <td>
                                                <div class="data-table-buttons-wrapper"><button type="button"
                                                        class="btn btn-info details-button" title="Details"
                                                        data-id="{{ $own->id }}" data-toggle="modal"
                                                        data-target="#getOwnGames">View</button></div>
                                            </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
    
                </div>
            </div>
        </div>
        @endif
        @if (session('can_play'))
        <div class="section-block table-size">
            <div class="change-content-btn">
                <div class="active" aria-current="page">
                    <span class="btn-change">Games Bidded</span>
                </div>
            </div>
    
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="gamesbidded" class="display dashboard-table table" width="100%">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    {{-- <th>Title</th> --}}
                                    <th>Country</th>
                                    <th>City</th>
                                    <th>District</th>
                                    <th>Price</th>
                                    <th>Players</th>
                                    {{-- <th>Created At</th> --}}
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
                                        <td>{{count($bidded->bids)}}/{{ $bidded->players }}</td>
                                        {{-- <td>{{ $bidded->created_at }}</td> --}}
                                        @if (session('can_play'))
                                            <td>
                                                <div class="data-table-buttons-wrapper"><button type="button"
                                                        class="btn btn-info details-button" title="Details"
                                                        data-id="{{ $bidded->id }}" data-toggle="modal"
                                                        data-target="#getMyBids">Play</button></div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
    
                </div>
            </div>
        </div>
        @endif

    </div>
        </div>
    <div>

    <div id="getOwnGames" id="darkModalForm" tabindex="-1" class="modal fade table-modal" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div id="OwnGamesBody" class="modal-body">

                </div>
            </div>

        </div>
    </div>
    <div id="getMyBids" id="darkModalForm" class="modal fade table-modal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div id="MyBidsBody" class="modal-body">

                </div>
            </div>

        </div>
    </div>
    </div>
    <script>
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
            $('#getOwnGames').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).attr('data-id');
                $.ajax({
                    type: 'post',
                    url: 'getOwnGames', //Here you will fetch records
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id': rowid
                    }, //Pass $id
                    success: function(data) {
                        $('#OwnGamesBody').html(data); //Show fetched data from database
                    }
                });
            });

            $('#getMyBids').on('show.bs.modal', function(e) {
                //$('#myModal').modal('hide');
                var rowid = $(e.relatedTarget).attr('data-id');
                $.ajax({
                    type: 'post',
                    url: 'getMyBids', //Here you will fetch records
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id': rowid
                    }, //Pass $id
                    success: function(data) {
                        $('#MyBidsBody').html(data); //Show fetched data from database
                    }
                });
            });
        });
    </script>
@endsection
