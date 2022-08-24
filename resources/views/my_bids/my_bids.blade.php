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

    <div class="content-wrapper table-size section-block">
        <div class="change-content-btn">
            <div>
                <a href="{{ url('') }}" class="btn-change">@lang('gamecreate.dashboard')</a>
            </div>
            <div class="active">
                <span class="btn-change">My Bids</span>
            </div>
        </div>
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

                <div class="table-responsive">
                    <table id="mybids" class="display dashboard-table table" style="width:100%">
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
    var dt = $('#mybids').DataTable({
        responsive: true,
        paging: false,
        searching: false
    });
</script>
        <script>
$(document).ready(function(){
    $('#myModal').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).attr('data-id');
        $.ajax({
            type : 'post',
            url : 'getMyBids', //Here you will fetch records
            data :  {"_token": "{{ csrf_token() }}", 'id': rowid}, //Pass $id
            success : function(data){
            $('#modal-body').html(data);//Show fetched data from database
            }
        });
     });
});

        </script>
@endsection
