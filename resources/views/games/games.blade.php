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

    <div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
          <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="{{ url('') }}">@lang('games.dashboard')</a></li>
            <li class="breadcrumb-item active" aria-current="page"><span>@lang('games.games')</span></li>
            <li class="breadcrumb-item"><a href="{{ route('games.create') }}">@lang('games.create_game')</a></li>
          </ol>
        </nav>
      @if(session()->get('success'))
        <div class="alert alert-success">
          {{ session()->get('success') }}
        </div>
      @endif
      <div class="card">

        <div class="card-body">
            <div class="container">
                  <table id="data-table" class="display nowrap" style="width:100%"></table>
            </div>

        </div>
      </div>
    </div>

<div id="myModal" id="darkModalForm" class="modal fade" role="dialog">
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

        <script>
            dataTableInit('#data-table', [5, 'desc'], 'POST', '{{ url('list/games') }}', [
                {
                    title: 'Photo',
                    data: 'photo', render : function(data, type, row){
                      return '<img src="/images/bid_to_see.jpg" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">'
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
                    title: 'Points',
                    data: 'points'
                },
                {
                    title: 'Rating',
                    data: 'average_rating'
                },
                {
                    title: 'Created At',
                    data: 'created_at', render : function(data)
                {
                    return moment(data).format("DD MMM YYYY HH:mm:ss");
                }
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
            ],undefined, [], false );
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
});

        </script>




@endsection
