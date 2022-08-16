@extends('layouts.mainlayout')

@section('content')

<!-- google map api start -->
<!-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyCaWBIHePh4f4bQIROBybqJzKfaqiNCkac"></script> -->
<!-- <script src="http://maps.google.com/maps/api/js?key=AIzaSyDkduGOlqZSICxQ40aTrr_shmIr1Nm5k2Q"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script> -->


<!-- <style type="text/css">
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
</style> -->
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
<!-- <script src="https://cdn.tailwindcss.com"></script>
    <script>
      // Work-around node polyfills missing in Vite.
      window.global = window;
    </script>     -->
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
              <div class="col-md-6 grid-margin">
                <div class="dashboard-card">
                  <div class="dashboard-card-text">
                    <h5>@lang('dashboard.games_played')</h5>
                    <span class="dashboard-card-number">{{$games_played}}</span>
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
                  <!-- <span class="dashboard-card-number">{{Auth::user()->total_winning_points}}</span> -->
                  <div class="dashboard-card-image">
                    <img src="{{ asset('images/component.png') }}" alt="">
                  </div>
                </div>
              </div>
            </div>
            <div class="row grid-margin">
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
                    title: 'Photo',
                    data: 'photo', render : function(data, type, row){
                      return '<img src="/storage/game-photos/'+data+'" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">'
                }},
                {
                    title: 'Title',
                    data: 'title'
                },
                {
                    title: 'City',
                    data: 'city'
                },
                {
                    title: 'District',
                    data: 'district'
                },
                {
                    title: 'Price',
                    data: 'points'
                },
                // {
                //     title: 'Type',
                //     data: 'type'
                // },
                {
                    title: 'Created At',
                    data: 'created_at'
                }
                ,
                {
                title: 'Status',
                data: 'status', render : function(data, type, row)
                {
                    switch (data)
                    {
                        case 1: return '<span class="btn btn-success">Going</span>';
                            break;
                        case 2: return '<span class="btn btn-danger">Disabled</span>';
                            break;
                        case 3: return '<a href="game/activate/'+row['id']+'" class="btn btn-warning" onclick=" name="activate" value="1">Activate</a>';
                        break;
                        
//                        case '3': return '<form enctype="multipart/form-data" action="{{ route('games.activate') }}" method="post">' +
//                          '<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />'+
//                          '<input hidden type="numbers" name="user_id" class="form-control"/ value="{{ Auth::user()->id }}">'+
//                                        ' <button class="btn btn-warning" name="activate" value="1">Activate</button>' +
//                                    '</form>';

                    }
                }
            },
            {
                    title: 'Actions',
                    data: 'status', render : function(data, type, row)
                    {
                        return '<div class="data-table-buttons-wrapper"><button type="button" class="btn btn-info details-button" title="Details" data-id="'+row['id']+'" data-toggle="modal" data-target="#myModal">View</button></div>';
                    }
                }
//                {
//                    title: 'Actions',
//                    defaultContent: '<div class="data-table-buttons-wrapper">' +
//                                        '<button type="button" class="btn btn-info details-button" title="Details">View</button> ' +
//                                    '</div>'
//                }
            ]);
//            detailsButton('{{ url('games/{id}') }}');
        </script>
        <script>
              dataTableInit('#data-table-bid', [4, 'desc'], 'POST', '{{ url('list/bid_games') }}', [
                {
                    title: 'Photo',
                    data: 'photo', render : function(data, type, row){
                      return '<img src="/storage/game-photos/'+data+'" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">'
                }},
                {
                    title: 'Title',
                    data: 'title'
                },
                {
                    title: 'City',
                    data: 'city'
                },
                {
                    title: 'District',
                    data: 'district'
                },
                {
                    title: 'Price',
                    data: 'points'
                },
                // {
                //     title: 'Type',
                //     data: 'type'
                // },
                {
                    title: 'Created At',
                    data: 'created_at'
                },
                {
                title: 'Status',
                data: 'status', render : function(data, type, row)
                {
                    switch (data)
                    {
                        case 1: return '<span class="btn btn-success">Going</span>';
                            break;
                        case 2: return '<span class="btn btn-danger">Disabled</span>';
                            break;
                    }
                }
            },
                {
                    title: 'Actions',
                    data: 'status', render : function(data, type, row)
                    {
                        return '<div class="data-table-buttons-wrapper"><button type="button" class="btn btn-info details-button" title="Details" data-id="'+row['id']+'" data-toggle="modal" data-target="#myModal">View</button></div>';
                    }
                }
//                {
//                    title: 'Actions',
//                    defaultContent: '<div class="data-table-buttons-wrapper">' +
//                                        '<button type="button" class="btn btn-info details-button" title="Details">View</button> ' +
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
<!-- <script>
    $(function() {
        $.ajax({
            url: 'https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=&lon=',
            type: 'GET',
            dataType: 'html',
            success: function(data, status, xhr)
            {
                var suburb = JSON.parse(data).address.suburb;

                $("#city").html(suburb);
            },
            error: function(xhr, status, error)
            {
                $("#city").html("Error: " + status + " " + error);
            }
        });
    });
</script> -->
@endsection
