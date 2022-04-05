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
<!-- google map api end -->

    <div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
          <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="{{ url('') }}">@lang('games.dashboard')</a></li>
            <li class="breadcrumb-item active" aria-current="page"><span>@lang('games.mybids')</span></li>
          </ol>
        </nav>
        <!--<a href="{{ route('games.create') }}" class="btn btn-success btn-rounded btn-fw">@lang('games.create_game')</a>-->
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
      <div class="card">

        <div class="card-body">
            <div class="row">

              <div class="col-12">
                  <table class="table sortable-table table-hover" id="data-table" cellspacing="0" width="100%"></table>
              </div>

            </div>

        </div>
      </div>
    </div>


<div id="myModal" id="darkModalForm" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
<!--        <div class="modal-header">
          <h4 class="modal-title">Details</h4>
          <button style="color:white" type="button" class="close" data-dismiss="modal">&times;</button>
        </div>-->
        <div id="modal-body" class="modal-body">

        </div>
      </div>

    </div>
  </div>

        <script>
            dataTableInit('#data-table', [5, 'desc'], 'POST', '{{ url('list/bid_games') }}', [
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
                {
                    title: '{{ Lang::trans('games.type') }}',
                    data: 'type'
                },
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
});

        </script>
@endsection
