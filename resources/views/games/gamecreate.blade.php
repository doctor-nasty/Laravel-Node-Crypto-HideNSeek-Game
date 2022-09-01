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
                            <div class="form-group map-input-block">
                                <label for="points">@lang('gamecreate.points') *</label>
                                <select id="points" name="points" type="text" class="required form-control">
                                    <option disabled selected></option>
                                    <option>1.00</option>
                                    <option>2.00</option>
                                </select>
                                <small>@lang('gamecreate.points_text')</small>
                            </div>
                            <div class="form-group map-input-block">
                                <label for="players">Players *</label>
                                <select id="players" name="players" type="text" class="required form-control">
                                    <option disabled selected></option>
                                    <option>5</option>
                                    <option>10</option>
                                    <option>20</option>
                                    <option>50</option>
                                </select>
                                <small>How many players should join for a game to start.</small>
                            </div>
                            <div class="form-group map-input-block">
                                <label for="full_comment">Hints *</label>
                                <textarea style="font-size: 16px" type="text" rows="5" id="full_comment" class="required form-control" name="full_comment"></textarea>
                                <small>Write a hints, explain how players should find your hidden location.</small>
                            </div>
                            <br>
                            <div style="font-size: 16px" class="col-md-12" id="map"></div>
                            <br>
                            <div class="form-group map-input-block">
                                <label for="country">Country *</label>
                                <input style="font-size: 16px" readonly id="country" name="country" value="{{ old('country') }}" type="text" class="required form-control">
                            </div>
                            <div class="form-group map-input-block">
                                <label for="city">City *</label>
                                <input style="font-size: 16px" readonly id="city" name="city" value="{{ old('city') }}" type="text" class="required form-control">
                            </div>
                            <div class="form-group map-input-block">
                                <label for="district">District *</label>
                                <input style="font-size: 16px" readonly id="district" name="district" value="{{ old('district') }}" type="text" class="required form-control">
                            </div>
                            <div class="form-group map-input-hidden">
                                {{-- <span class="input-group-addon bg-dark" id="basic-addon1">Code to hide:</span> --}}
                                <input type="hidden" required readonly value="{{ $identifier }}" type="text" class="required form-control" id="clipboardExample2" name="identifier" placeholder="Generate Number" aria-label="Generate Nunber" aria-describedby="basic-addon1">
                                <input type="hidden" class="required form-control" id="mark_lat" name="mark_lat" value="">
                                <input type="hidden" class="required form-control" id="mark_long" name="mark_long" value="">        
                                <input type="hidden" class="required form-control" id="osm_id" name="osm_id" value="">
                                <input type="hidden" class="required form-control" id="place_id" name="place_id" value="">
                            </div>
                            <!-- <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">@lang('gamecreate.upload_image') *</h4>
                                    <input name="photo" id="clipboardExample2" value="{{ old('photo') }}" type="file" class="required dropify" />
                                </div>
                            </div> -->
                    </div>
                    <div>
                        {{-- <small class="text text-danger">* @lang('gamecreate.code_text')</small> --}}
                        <!-- <input type="hidden" class="required form-control" id="city_lat" name="city_lat">
                        <input type="hidden" class="required form-control" id="city_long" name="city_long"> -->
                        <input type="hidden" class="required form-control" id="tx_hash" name="tx_hash" value="">
                        <input type="hidden" class="required form-control" id="deposit_addr" value="{{ config('web3.wallet.address') }}">
                        <input type="hidden" class="required form-control" id="usdt_addr" value="{{ config('web3.chain.token') }}">

                        <!-- <button type="submit" id="create_game" class="btn btn-inverse-primary" data-toggle="modal" data-target="#terms-modal"> -->
                        <button type="submit" class="btn btn-inverse-primary create-game">
                            @lang('gamecreate.submit')
                        </button>

                        {{-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#terms-modal">Open Modal</button> --}}

                        <!-- status -->

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
                            <div class="modal-costum-body">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content terms-modal">
                                        <div class="terms-modal-text">
                                            {{-- <h4>Wait for confirmation</h4> --}}
                                            <div class="form group">
                                                <label id="tx_status"></label>
                                            </div>
                                        </div>
                                        <div class="wait-block">
                                            <div class="wait-spin">
                                            </div>
                                        </div>
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

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
}).addTo(map);

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


var poly = null;


map.on('click', function (e) {
    let addressTypes = ["shop", "amenity", "leisure"];

    // clear address values
    $("#city").val('');
    $("#district").val('');
    $("#country").val('');

    // get latitude and longitude
    document.querySelector('#mark_lat').value = e.latlng.lat;
    document.querySelector('#mark_long').value = e.latlng.lng;
    $.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        url: "https://nominatim.openstreetmap.org/reverse?format=jsonv2&accept-language=en-US&lat=" 
            + $('#mark_lat').val() + "&lon=" + $('#mark_long').val(),
        dataType: "json",
        success: function (data) {
            console.log(data);

            if (addressTypes.includes(data.addresstype) === false) {
                return ; // invalid address types
            }

            // display bounding box
            if (poly !== null) {
                map.removeLayer(poly);
                poly = null;
            }
            let points = [
                L.latLng(data.boundingbox[0], data.boundingbox[2]),
                L.latLng(data.boundingbox[1], data.boundingbox[2]),
                L.latLng(data.boundingbox[1], data.boundingbox[3]),
                L.latLng(data.boundingbox[0], data.boundingbox[3]),
            ];
            poly = L.polygon(points,{
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
            }).addTo(map);

            // parse city and disctrict info
            if (data.address.city == null) {
                $('#city').val(data.address.county);
            } else if (data.address.city != null) {
                $('#city').val(data.address.city);
            }

            if (data.address.suburb == null) {
                $('#district').val(data.address.road);
            } else if (data.address.suburb != null) {
                $('#district').val(data.address.suburb);
            }
            
            $('#country').val(data.address.country);
            $('#osm_id').val(data.osm_id);
            $('#place_id').val(data.place_id);
            $("#country-error").remove();
        },
        error: function (result) {
            alert("Can't get location data!");
        }
    })
});
</script>
<script>
$("#game-form").validate({
    rules: {
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
<input type="hidden" id="network_id" value="{{config('web3.chain.network')}}" />
<script src="{{ asset('js/wallet.js') }}"></script>