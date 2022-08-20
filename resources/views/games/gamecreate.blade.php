@extends('layouts.mainlayout')

@section('content')
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<!-- google map api start -->
<!-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyCaWBIHePh4f4bQIROBybqJzKfaqiNCkac"></script> -->
<!-- <script src="http://maps.google.com/maps/api/js?key=AIzaSyDkduGOlqZSICxQ40aTrr_shmIr1Nm5k2Q"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script> -->

<!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
   integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
   integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
   crossorigin=""></script>
   <style type="text/css">
        #map { height: 180px; }
</style> -->
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
<!-- google map api end -->

<div class="content-wrapper section-block ">
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
    <div class="card card-inverse-warning">
        <div class="card-body">
            <p class="card-text">
                {{-- @lang('gamecreate.your_code') ur_{{ $identifier }} --}}
             @lang('gamecreate.warning_text')
            </p>
            <p class="card-text">
                @lang('gamecreate.noedit')
            </p>
        </div>
    </div>
    <div class="change-content-btn">
            <div>
                <a href="{{ url('') }}" class="btn-change">@lang('gamecreate.dashboard')</a>
            </div>
            <div>
                <a href="{{ url('') }}" class="btn-change">@lang('gamecreate.games')</a>
            </div>
            <div class="active">
                <span class="btn-change">@lang('gamecreate.create_new_game')</span>
            </div>
    </div>
    <div class="row"></div>
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12 table-responsive">
                        <h4 class="card-title mb-0">@lang('gamecreate.create_new_game')</h4>
                        <br>
                        <form method="post" action="{{ route('games.store') }}" enctype="multipart/form-data" id="game-form">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="userName">@lang('gamecreate.title') *</label>
                                <input id="userName" name="title" value="{{ old('title') }}" type="text" class="required form-control">
                            </div>
                            <div class="form-group">
                                <label for="confirm">@lang('gamecreate.comment') *</label>
                                <input id="confirm" name="comment" value="{{ old('comment') }}" type="text" class="required form-control">
                            </div>
                            <div class="form-group">
                                <label for="points">@lang('gamecreate.points') *</label>
                                <select id="points" name="points" type="text" class="required form-control">
                                    <option disabled selected></option>
                                    <option>1.00</option>
                                    <option>2.00</option>
                                </select>
                                <small>@lang('gamecreate.points_text')</small>
                            </div>
                            <div class="form-group">
                                <label for="players">Players *</label>
                                <select id="players" name="players" type="text" class="required form-control">
                                    <option disabled selected></option>
                                    <option>10</option>
                                    <option>20</option>
                                    <option>50</option>
                                </select>
                                <small>How many players should join for a game to start</small>
                            </div>
                            <div class="form-group">
                                <label for="full_comment">@lang('gamecreate.full_description') *</label>
                                <textarea type="text" rows="5" id="full_comment" class="required form-control" name="full_comment"></textarea>
                            </div>
                            
                            <!-- <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">@lang('gamecreate.upload_image') *</h4>
                                    <input name="photo" id="clipboardExample2" value="{{ old('photo') }}" type="file" class="required dropify" />
                                </div>
                            </div> -->
                    </div>
                    <div>
                        <div class="input-group map-input-block">
                            <span class="input-group-addon bg-dark" id="basic-addon1">Code to hide:</span>
                            <input required readonly value="{{ $identifier }}" type="text" class="required form-control" id="clipboardExample2" name="identifier" placeholder="Generate Number" aria-label="Generate Nunber" aria-describedby="basic-addon1">
                        </div>
                        <small class="text text-danger">* @lang('gamecreate.code_text')</small>
                        <!-- <input type="hidden" class="required form-control" id="city_lat" name="city_lat">
                        <input type="hidden" class="required form-control" id="city_long" name="city_long"> -->
                        <input type="hidden" class="required form-control" id="mark_lat" name="mark_lat" value="">
                        <input type="hidden" class="required form-control" id="mark_long" name="mark_long" value="">
                        <input type="hidden" class="required form-control" id="tx_hash" name="tx_hash" value="">
                        <input type="hidden" class="required form-control" id="deposit_addr" value="{{ config('web3.wallet.address') }}">
                        <input type="hidden" class="required form-control" id="usdt_addr" value="{{ config('web3.chain.token') }}">
                        <br>

                        <br>
                        <div id="city-error"></div>
                        <div id="suburb-error"></div>
                        <div id="country-error"></div>
                        <div class="col-md-12" id="map"></div>
                        <br>
                        <br>
                        <div class="map-input-block">
                            <div class="form-group">
                                <label for="country">Country *</label>
                                <input readonly id="country" name="country" value="{{ old('country') }}" type="text" class="required form-control">
                            </div>
                            <div class="form-group">
                                <label for="city">City *</label>
                                <input readonly id="city" name="city" value="{{ old('city') }}" type="text" class="required form-control">
                            </div>
                            <div class="form-group">
                                <label for="district">District *</label>
                                <input readonly id="district" name="district" value="{{ old('district') }}" type="text" class="required form-control">
                            </div>
                        </div>
                        <br>
                        <!-- <button type="submit" id="create_game" class="btn btn-inverse-primary" data-toggle="modal" data-target="#terms-modal"> -->
                        <button type="submit" class="btn btn-inverse-primary create-game">
                            @lang('gamecreate.submit')
                        </button>
                        <!-- status -->
                        <div class="form group">
                            <label id="tx_status"></label>
                        </div>
                        <!-- modal agree or disagree -->
                        <div class="modal fade" id="terms-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content terms-modal">
                                    <div class="terms-modal-text">
                                        <h4>Do you agree</h4>
                                        <span>do you agree our terms and conditions</span>
                                    </div>
                                    <div class="terms-modal-buttons">
                                        <button type="button" data-dismiss="modal" data-toggle="modal" data-target="#confirmation-modal"> I agree</button>
                                        <button type="button" data-dismiss="modal"> i dont agree </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal waiting -->
                        <div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content terms-modal">
                                    <div class="terms-modal-text">
                                        <h4>Wait for confirmation</h4>
                                    </div>
                                    <div class="wait-block">
                                        <div class="wait-spin"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- midal success -->
                        <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content terms-modal">
                                    <div class="terms-modal-text">
                                        <h4>You successfully create game</h4>
                                    </div>
                                    <div class="terms-image-block">
                                        <img src="{{ asset('images/success-icon.png') }}" alt="success icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal fail -->
                        <div class="modal fade" id="fail-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content terms-modal">
                                    <div class="terms-modal-text">
                                        <h4>you have failed create game</h4>
                                    </div>
                                    <div class="terms-image-block">
                                        <img src="{{ asset('images/fail-icon.png') }}" alt="success icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// var map = L.map('map').fitWorld();

var map = L.map('map').setView([42.3154, 43.3569], 3);

var circle = null;

map.on('click', function (e) {
    if (circle !== null) {
        map.removeLayer(circle);
    }
    circle = L.circle(e.latlng,{
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: 500
}).addTo(map);
var ll = circle.getLatLng();
document.querySelector('#mark_lat').value = ll.lat;
document.querySelector('#mark_long').value = ll.lng;

});



L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
}).addTo(map);
</script>


<script>
    function isEmpty(value) {//Function to check if value is Empty or Null
              switch (typeof(value)) {
                case "string": return (value.length === 0);
                case "number":
                case "boolean": return false;
                case "undefined": return true;
                case "object": return !value ? true : false; // handling for null.
                default: return !value ? true : false
              }
            }

map.on('click', function (e) {
    $("#city").val('');
    $("#district").val('');
    $("#country").val('');
$.ajax({
type: "POST",
contentType: "application/json; charset=utf-8",
url: "https://nominatim.openstreetmap.org/reverse?format=jsonv2&accept-language=en-US&lat=" + $('#mark_lat').val() + "&lon=" + $('#mark_long').val(),
dataType: "json",
success: function (data) {
    $('#city').val(data.address.city);
    $("#city-error").remove();
    $('#district').val(data.address.suburb);
    $("#district-error").remove();
    $('#country').val(data.address.country);
    $("#country-error").remove();
},
error: function (result) {
    alert("Error");
}
})
});
    </script>
<script>
$("#game-form").validate({
    rules: {
        title: {
            required: true
        },
        comment: {
            required: true
        },
        full_comment: {
            required: true
        },
        players: {
            required: true
        },
        points: {
            required: true
        },
        mark_lat: {
            required: true
        },
        mark_long: {
            required: true
        },
        city: {
            required: true
        },
        district: {
            required: true
        },
        country: {
            required: true
        }
    },
    messages: {
        title: {
            required: "Please enter a valid title."
        },
        comment: {
            required: "Please provide a comment."
        },
        full_comment: {
            required: "Please provide a full comment."
        },
        players: {
            required: "Please choose a players amount."
        },
        points: {
            required: "Please choose a price."
        },
        mark_lat: {
            required: "Incorrect location."
        },
        mark_long: {
            required: "Incorrect location."
        },
        city: {
            required: "Incorrect city."
        },
        district: {
            required: "Incorrect district."
        },
        country: {
            required: "Incorrect country."
        }
    },
    submitHandler: function(form) {
        createNewGame(form);
        //form.submit();
    }
});
    </script>
@endsection

<!-- jQuery -->
<script src="{{ asset('js/login/jquery-3.0.0.min.js') }}"></script>

<!-- wallet scripts -->
<script src="https://cdn.ethers.io/lib/ethers-5.2.umd.min.js" type="application/javascript"></script>
<script src="{{ asset('js/wallet.js') }}"></script>