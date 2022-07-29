@extends('layouts.mainlayout')

@section('content')

<!-- google map api start -->
<script src="https://maps.google.com/maps/api/js?key=AIzaSyCaWBIHePh4f4bQIROBybqJzKfaqiNCkac"></script>
<!-- <script src="http://maps.google.com/maps/api/js?key=AIzaSyDkduGOlqZSICxQ40aTrr_shmIr1Nm5k2Q"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>


<style type="text/css">
    #mymap {
        border: 1px solid red;
        width: 100%;
        height: 500px;
    }

    #mymap_create_game {
        border: 1px solid red;
        width: 800px;
        height: 500px;
    }
</style>
<!-- <div class="container-fluid text-center mt-5">
    <h1>{{ config('app.name') }}</h1>
    <div class="d-flex justify-content-center mt-5">
        <button id="login-button" onclick="phantomLogin()" class="btn btn-dark">Login with Phantom Wallet</button>
    </div>

    <div class="d-flex justify-content-center mt-5">
        <div class="public-key" style="display: none"></div>
    </div>

    <div class="d-flex justify-content-center mt-5">
        <div class="sol-balance" style="display: none">

        </div>
    </div>
</div> -->
<div id="app">
</div>
<script src="https://cdn.tailwindcss.com"></script>
    <script>
      // Work-around node polyfills missing in Vite.
      window.global = window;
    </script>    
          <div class="content-wrapper">
            @if(session()->get('success'))
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
            <div class="row">
              <div class="col-md-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-row p-3">
                      <div class="align-self-top">
                        <p class="card-title mb-1 font-weight-bold">@lang('dashboard.games_played')</p>
                        <h3 class="mb-0">{{$games_played}}</h3>
                      </div>
                      <div class="align-self-center flex-grow text-right">
                        <i class="icon-lg mdi mdi-chart-pie text-primary"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-row p-3">
                      <div class="align-self-top">
                        <p class="card-title mb-1 font-weight-bold">@lang('dashboard.points_earned')</p>
                        <h3 class="mb-0">{{Auth::user()->total_winning_points}}</h3>
                      </div>
                      <div class="align-self-center flex-grow text-right">
                        <i class="icon-lg mdi mdi-cash-multiple text-warning"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-row p-3">
                      <div class="align-self-top">
                        <p class="card-title mb-1 font-weight-bold">@lang('dashboard.your_points')</p>
                        <h3 class="mb-0">{{ Auth::user()->points }}</h3>
                        <input id="phantomProvider">
                      </div>
                      <div class="align-self-center flex-grow text-right">
                        <i class="icon-lg mdi mdi-account-outline text-success"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row grid-margin">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">@lang('dashboard.bidded')</h4>
                    <div class="table-responsive">
                      <table class="table sortable-table table-hover" id="data-table-bid" cellspacing="0" width="100%"></table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row grid-margin">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">@lang('dashboard.your_games')</h4>
                    <div class="table-responsive">
                        <table class="table sortable-table table-hover" id="data-table" cellspacing="0" width="100%"></table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
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
            dataTableInit('#data-table', [4, 'desc'], 'POST', '{{ url('list/own_games') }}', [
                {
                    title: '{{ Lang::trans('games.photo') }}',
                    data: 'photo', render : function(data, type, row){
                      return '<img src="/storage/game-photos/'+data+'" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">'
                }},
                {
                    title: '{{ Lang::trans('games.title') }}',
                    data: 'title'
                },
                {
                    title: '{{ Lang::trans('games.city') }}',
                    data: 'city'
                },
                {
                    title: '{{ Lang::trans('games.points') }}',
                    data: 'points'
                },
                // {
                //     title: '{{ Lang::trans('games.type') }}',
                //     data: 'type'
                // },
                {
                    title: '{{ Lang::trans('games.created_at') }}',
                    data: 'created_at'
                }
                ,
                {
                title: '{{ Lang::trans('games.status') }}',
                data: 'status', render : function(data, type, row)
                {
                    switch (data)
                    {
                        case '1': return '<span class="btn btn-success">{{ Lang::trans('games.going') }}</span>';
                            break;
                        case '2': return '<span class="btn btn-danger">{{ Lang::trans('games.disabled') }}</span>';
                            break;
                        // case '3': return '<a href="game/activate/'+row['id']+'" class="btn btn-warning" onclick=" name="activate" value="1">{{ Lang::trans('games.activate') }}</a>';
                        // break;
                        
//                        case '3': return '<form enctype="multipart/form-data" action="{{ route('games.activate') }}" method="post">' +
//                          '<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />'+
//                          '<input hidden type="numbers" name="user_id" class="form-control"/ value="{{ Auth::user()->id }}">'+
//                                        ' <button class="btn btn-warning" name="activate" value="1">{{ Lang::trans('games.activate') }}</button>' +
//                                    '</form>';

                    }
                }
            },
            {
                    title: '{{ Lang::trans('games.actions') }}',
                    data: 'status', render : function(data, type, row)
                    {
                        return '<div class="data-table-buttons-wrapper"><button type="button" class="btn btn-info details-button" title="Details" data-id="'+row['id']+'" data-toggle="modal" data-target="#myModal">{{ Lang::trans('games.view') }}</button></div>';
                    }
                }
//                {
//                    title: '{{ Lang::trans('games.actions') }}',
//                    defaultContent: '<div class="data-table-buttons-wrapper">' +
//                                        '<button type="button" class="btn btn-info details-button" title="Details">{{ Lang::trans('games.view') }}</button> ' +
//                                    '</div>'
//                }
            ]);
//            detailsButton('{{ url('games/{id}') }}');
        </script>
        <script>
              dataTableInit('#data-table-bid', [4, 'desc'], 'POST', '{{ url('list/bid_games') }}', [
                {
                    title: '{{ Lang::trans('games.photo') }}',
                    data: 'photo', render : function(data, type, row){
                      return '<img src="/storage/game-photos/'+data+'" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">'
                }},
                {
                    title: '{{ Lang::trans('games.title') }}',
                    data: 'title'
                },
                {
                    title: '{{ Lang::trans('games.city') }}',
                    data: 'city'
                },
                {
                    title: '{{ Lang::trans('games.points') }}',
                    data: 'points'
                },
                // {
                //     title: '{{ Lang::trans('games.type') }}',
                //     data: 'type'
                // },
                {
                    title: '{{ Lang::trans('games.created_at') }}',
                    data: 'created_at'
                },
                {
                title: '{{ Lang::trans('games.status') }}',
                data: 'status', render : function(data, type, row)
                {
                    switch (data)
                    {
                        case '1': return '<span class="btn btn-success">{{ Lang::trans('games.going') }}</span>';
                            break;
                        case '2': return '<span class="btn btn-danger">{{ Lang::trans('games.disabled') }}</span>';
                            break;
                    }
                }
            },
                {
                    title: '{{ Lang::trans('games.actions') }}',
                    data: 'status', render : function(data, type, row)
                    {
                        return '<div class="data-table-buttons-wrapper"><button type="button" class="btn btn-info details-button" title="Details" data-id="'+row['id']+'" data-toggle="modal" data-target="#myModal">{{ Lang::trans('games.view') }}</button></div>';
                    }
                }
//                {
//                    title: '{{ Lang::trans('games.actions') }}',
//                    defaultContent: '<div class="data-table-buttons-wrapper">' +
//                                        '<button type="button" class="btn btn-info details-button" title="Details">{{ Lang::trans('games.view') }}</button> ' +
//                                    '</div>'
//                }
            ]);
//            detailsButton('{{ url('games/{id}') }}');
$(document).ready(function(){
    $('#myModal').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).attr('data-id');
        $.ajax({
            type : 'post',
            url : 'getGameModalHtml', //Here you will fetch records
            data :  {"_token": "{{ csrf_token() }}", 'id': rowid}, //Pass $id
            success : function(data){
            $('#modal-body').html(data);//Show fetched data from database
            }
        });
     });

     $('#myModal2').on('show.bs.modal', function (e) {
         //$('#myModal').modal('hide');
        var rowid = $(e.relatedTarget).attr('data-id');
        $.ajax({
            type : 'post',
            url : 'getGameEditModalHtml', //Here you will fetch records
            data :  {"_token": "{{ csrf_token() }}", 'id': rowid}, //Pass $id
            success : function(data){
            $('#modal-body2').html(data);//Show fetched data from database
            }
        });
     });
});
        </script>
@endsection
