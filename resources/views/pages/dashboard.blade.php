@extends('layouts.mainlayout')

@section('content')

<div id="app">
</div>
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
            <div class="player-card">
                <div class="payer-avatar-block">
                    <div class="payer-avatar-image">
                        <img src="{{ asset('images/avatar.jpg') }}" alt="random avatar">
                    </div>
                    <button class="avatar-edit-button">
                        <img src="{{ asset('svgs/pencil.png') }}" alt="">
                    </button>
                </div>
                <div class="player-content">
                    <div class="player-info">
                        <h4>Player Name</h4>
                    </div>
                    <div class="player-point-row">
                        <div class="player-point-block">
                            <div class="point-icon"></div>
                            <div class="point-text">
                                <h5></h5>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<div class="">
  <div class="menu">
    <button class="button_active">Games Bidded</button>
    <button>Own Games</button>
    <button>Test</button>
  </div>
  <div class="content">
    <div class="content_inside content_inside_active">
        <div class="table-responsive">
            <table class="display dashboard-table table" id="data-table-bid" cellspacing="0" style="width:100%"></table>
        </div>
    </div>
    <div class="content_inside">
        <div class="table-responsive">
            <table class="display dashboard-table table" id="data-table" cellspacing="0" style="width:100%"></table>
        </div>
    </div>
    </div>
    <div class="content_inside">
<span>test</span>
</div>
  </div>
</div>
<div>
    
</div>
<script>
    $(window).resize(function() {
        $(".dtr-hidden").prev().css("border-radius", "0 30px 30px 0")
    });
    $(document).ready(function() {
        $(".dtr-hidden").prev().css("border-radius", "0 30px 30px 0")
    });
</script>
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
            dataTableInit('#data-table', [4, 'desc'], 'POST', '{{ url('list/own_games') }}', [
                {
                    title: 'Photo',
                    data: 'photo', render : function(data, type, row){
                      return '<div class="table-image"><img src="/storage/game-photos/'+data+'" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt=""></div>'
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
                      return '<div class="table-image"><img src="/storage/game-photos/'+data+'" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt=""></div>'
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
            @if (session('can_play'))
                {
                    title: 'Actions',
                    data: 'status', render : function(data, type, row)
                    {
                        return '<div class="data-table-buttons-wrapper"><button type="button" class="btn btn-info details-button" title="Details" data-id="'+row['id']+'" data-toggle="modal" data-target="#myModal">Play</button></div>';
                    }
                }
            @endif
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
<script>
let button = document.querySelectorAll('.menu button');
let content_inside = document.querySelectorAll('.content_inside');

Array.from(button).forEach(function(buttonArray, i) {
buttonArray.addEventListener('click', function() {

    Array.from(button).forEach(buttonAll => buttonAll.classList.remove('button_active'));
    
    Array.from(content_inside).forEach(content_insideAll => content_insideAll.classList.remove('content_inside_active'));
    
    button[i].classList.add('button_active'); 
    
    content_inside[i].classList.add('content_inside_active');  
  });
});
</script>
<style>
    .menu {
  display: flex;
}

.menu button {
  margin: 10px;
  cursor: pointer;
}

.button_active {
  color: teal;
}

.content_inside {
  display: none;
  border: 1px solid #000000;
  border-radius: 10px;
  padding: 10px;
}

.content_inside_active {
  display: block;
}
</style>
@endsection
