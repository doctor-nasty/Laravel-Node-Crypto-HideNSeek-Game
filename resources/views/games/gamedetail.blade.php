@extends('layouts.mainlayout')

@section('content')
    <div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ url('') }}">@lang('gamedetail.dashboard')</a></li>
                <li class="breadcrumb-item"><a href="{{ url('games') }}">@lang('gamedetail.games')</a></li>
                <li class="breadcrumb-item active" aria-current="page"><span>{{ $game->title }}</span></li>
            </ol>
        </nav>

        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        @if(session()->get('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
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
        <div class="row">

            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $game->title }}</h4>
                        <ul class="nav nav-tabs tab-solid  tab-solid-primary" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-6-1" data-toggle="tab" href="#home-6-1" role="tab" aria-controls="home-6-1" aria-selected="true">
                                    <i class="mdi mdi-home-outline"></i>@lang('gamedetail.basic_info')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-6-2" data-toggle="tab" href="#profile-6-2" role="tab" aria-controls="profile-6-2" aria-selected="false">
                                    <i class="mdi mdi-account-outline"></i>@lang('gamedetail.players')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-6-3" data-toggle="tab" href="#contact-6-3" role="tab" aria-controls="contact-6-3" aria-selected="false">
                                    <i class="mdi mdi-account-outline"></i>@lang('gamedetail.game')</a>
                            </li>
                                @if($game->user_id === auth()->user()->id)
                                <div class="align-self-center flex-grow text-right">
                                        <li class="nav-item">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-dark icon-btn dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-account"></i>
                                        </button>
                                        <div  class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7">
                                            <h6 class="dropdown-header">@lang('gamedetail.actions')</h6>
                                            <a class="dropdown-item" href="{{ route('games.edit', $game->id) }}">@lang('gamedetail.edit')</a>
                                            <form action="{{ route('games.destroy', $game->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Are You Sure?')" class="dropdown-item">@lang('gamedetail.remove')</button>
                                            </form>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ route('games.create') }}">@lang('gamedetail.create_new_game')</a>
                                    </div>             
                                        </li>
                                </div>
                                @endif

                        </ul>
                        <div class="tab-content tab-content-solid">
                            <div class="tab-pane fade show active" id="home-6-1" role="tabpanel" aria-labelledby="tab-6-1">
                                <div class="row">
                                    <div class="col-md-4">
                                            @foreach($game->bids as $bid)
                                            @if($bid->user_id == Auth::user()->id)
     
                                            @php
                                            $bid_on = 1;
                                            @endphp
     
                                            @endif
                                         @endforeach
                                        @if(isset($bid_on) && $bid_on == 1)
                                        <img class="img-fluid w-100" src="/storage/game-photos/{{ $game->photo }}" alt="">
                                        @elseif($game->user_id === auth()->user()->id)
                                        <img class="img-fluid w-100" src="/storage/game-photos/{{ $game->photo }}" alt="">
                                        @else
                                        <img class="img-fluid w-100" src="/images/bid_to_see.jpg" alt="">
                                        @endif
                                        <small>{{ $game->points }} @lang('gamedetail.points_required')</small>
                                    </div>
                                    <div class="col-md-8">
                                        <h5 class="mb-3">@lang('gamedetail.whats_hidden') <b>{{ $game->type }}</b></h5>
                                        <div class="tab-pane fade show active" id="profile-6-1" role="tabpanel" aria-labelledby="tab-6-1">
                                            @lang('gamedetail.comment'): <span>{{ $game->comment }}</span>
                                        </div>                                        
                                        <div class="tab-pane fade show active" id="profile-6-1" role="tabpanel" aria-labelledby="tab-6-1">
                                            @lang('gamedetail.which_city'): {{ $game->city }}
                                        </div>                                        
                                        <div class="tab-pane fade show active" id="profile-6-1" role="tabpanel" aria-labelledby="tab-6-1">
                                            @lang('gamedetail.which_district'): {{ $game->district }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile-6-2" role="tabpanel" aria-labelledby="tab-6-2"> 
                            <span>@lang('gamedetail.players_count') {{ count($game->bids) }}</span>
                            </div>
                            <div class="tab-pane fade" id="contact-6-3" role="tabpanel" aria-labelledby="tab-6-3">
                                @if($game->status === 2)
                                <span class="text text-danger">@lang('gamedetail.game_has_finished')</span>
                                @else
                                @if($game->user_id === auth()->user()->id)
                                <div class="card-body">
                                    <span class="text text-danger">@lang('gamedetail.cant_play_own')</span><br><br>
                            @lang('gamedetail.game_code') 
                                    <span class="input-group-addon bg-dark" id="basic-addon1">rlg_{{ $game->identifier }}</span>
                        </div>
                                @else
                                    
                                    @foreach($game->bids as $bid)
                                       @if($bid->user_id == Auth::user()->id)

                                       @php
                                       $bid_on = 1;
                                       @endphp

                                       @endif
                                    @endforeach
                                    
                                    @if(isset($bid_on) && $bid_on == 1)
                                    <blockquote class="blockquote blockquote-primary">
                                        <span>{{ $game->full_comment }}</span>
                                    </blockquote>
                                    <form action="{{route('bid.answer')}}" method="POST">
                                        {{csrf_field()}}
                                        <input name="game_id" type="hidden" value="{{$game->id}}" />
                                        <label>@lang('gamedetail.enter_answer') </label>
                                        <input name="answer" type="text" class="form-group form-control" required />
                                        <button class="btn btn-inverse-success" type="submit">@lang('gamedetail.submit')</button>
                                    </form>
                                    
                                    @else
                                        @if($game->points < auth()->user()->points)
                                        <td>@lang('gamedetail.points_required') {{ $game->points }} @lang('gamedetail.points_required_2')</td>
                                        <td>
                                            <br>
                                            <br>
                                        <a href="{{route('bid', ['game_id' => $game->id])}}">
                                            <button class="btn btn-inverse-success">
                                                @lang('gamedetail.start_playing')
                                            </button></a>
                                        </td>
                                        @else
                                        <span class="text text-danger">@lang('gamedetail.no_enough_points')</span>
                                        @endif
                                    @endif
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script type="text/javascript">
//            $(document).ready(function () {
//                //Disable full page
//                $('body').bind('cut copy paste', function (e) {
//                    e.preventDefault();
//                });
//              
//            
//            $('body').on('contextmenu', function(e) {
//                return false;
//            });
//            });
        </script>
@endsection
