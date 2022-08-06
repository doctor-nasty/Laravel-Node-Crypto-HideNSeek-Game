@extends('layouts.mainlayout')

@section('content')

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

<div class="content-wrapper">
    @if(session()->get('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="{{ url('') }}">@lang('gamecreate.dashboard')</a></li>
            <li class="breadcrumb-item"><a href="{{ url('games') }}">@lang('gamecreate.games')</a></li>
            <li class="breadcrumb-item active" aria-current="page"><span>@lang('gamecreate.create_new_game')</span></li>
        </ol>
    </nav>

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
    <div class="row">

        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12 table-responsive">
                        <h4 class="card-title mb-0">@lang('gamecreate.create_new_game')</h4>
                        <br>
                        <form method="post" action="{{ route('games.store') }}" enctype="multipart/form-data" id="form">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="userName">@lang('gamecreate.title') *</label>
                                <input id="userName" name="title" value="{{ old('title') }}" type="text" class="required form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">@lang('gamecreate.type') *</label>
                                <select id="type" name="type" type="text" class="required form-control">
                                    <!-- <option disabled selected></option> -->
                                    <option selected>@lang('gamecreate.item')</option>
                                    <!-- <option>@lang('gamecreate.code')</option> -->
                                </select>
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
                                <label for="full_comment">@lang('gamecreate.full_description') *</label>
                                <textarea type="text" rows="5" id="full_comment" class="required form-control" name="full_comment"></textarea>
                            </div>

                            {{-- <script>
                                $(document).ready(function() {
                                    $('#city').on('change', function() {
                                        if (this.value == 'თბილისი')
                                        //.....................^.......
                                        {
                                            $("#district2").hide();
                                            $("#district").show();
                                        } else if (this.value == 'ბ�?თუმი') {
                                            $("#district").hide();
                                            $("#district2").show();
                                        } else {
                                            $("#district").hide();
                                        }
                                    });
                                });
                            </script> --}}
                            <!-- <div class="form-group">
                                <label for="city">@lang('gamecreate.city') *</label>
                                <select id="city" name="city" type="text" class="required js-example-basic-single" style="width:100%">
                                    <option disabled selected></option>
                                    <option data-lat="42" data-long="43.499998">Georgia</option>
                                    <option data-lat="40" data-long="21.499998">USA</option>
                                </select>
                            </div> -->

                            {{-- <div id="district" style='display:none;' class="form-group">
                                <label for="district">@lang('gamecreate.district') *</label>
                                <select id="district" name="district" type="text" class="required js-example-basic-single" style="width:100%">
                                    <option disabled selected></option>
                                    <option>აბანოთუბანი</option>
                                    <option>ავლაბარი</option>
                                    <option>ავჭალა</option>
                                    <option>ანჩისხატის უბანი</option>
                                    <option>ბეთლემი</option>
                                    <option>ბაგები</option>
                                    <option>გარეთუბანი</option>
                                    <option>გლდანი</option>
                                    <option>გლდანულა</option>
                                    <option>დამპალო</option>
                                    <option>დელისი</option>
                                    <option>დიდი დიღომი</option>
                                    <option>დიდუბე</option>
                                    <option>დიღმის მასივი</option>
                                    <option>ვაზისუბანი</option>
                                    <option>ვაკე</option>
                                    <option>ვარკეთილი</option>
                                    <option>ვაშლიჯვარი</option>
                                    <option>ვერა</option>
                                    <option>ვეძისი</option>
                                    <option>ზემელი</option>
                                    <option>ზღვისუბანი</option>
                                    <option>კრწანისი</option>
                                    <option>ლეღვთახევი</option>
                                    <option>ლოტკინი</option>
                                    <option>მეტეხი</option>
                                    <option>მთაწმინდა</option>
                                    <option>მუხიანი</option>
                                    <option>რიყე</option>
                                    <option>ნავთლუღი</option>
                                    <option>ნაძალადევი</option>
                                    <option>ორთაჭალა</option>
                                    <option>საბურთალო</option>
                                    <option>სამგორი</option>
                                    <option>სანზონა</option>
                                    <option>სვანეთისუბანი</option>
                                    <option>სოლოლაკი</option>
                                    <option>ფიქრის გორა</option>
                                    <option>ფონიჭალა</option>
                                    <option>ჩუღურეთი</option>
                                </select>
                            </div> --}}
                            {{-- <div id="district2" style='display:none;' class="form-group">
                                            <label for="district2">@lang('gamecreate.district') *</label>
                                            <select id="district2" name="district2" type="text" class="required js-example-basic-single" style="width:100%">
                                                <option disabled selected></option>
                                                <option>Test</option>
                                            </select>
                                        </div> --}}
                            <small>(*) @lang('gamecreate.mandatory')</small>
                            <!-- <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">@lang('gamecreate.upload_image') *</h4>
                                    <input name="photo" id="clipboardExample2" value="{{ old('photo') }}" type="file" class="required dropify" />
                                </div>
                            </div> -->
                    </div>
                    <div>
                        <div class="input-group">
                            <span class="input-group-addon bg-dark" id="basic-addon1">Code to hide:</span>
                            <input required readonly value="{{ $identifier }}" type="text" class="required form-control" id="clipboardExample2" name="identifier" placeholder="Generate Number" aria-label="Generate Nunber" aria-describedby="basic-addon1">
                        </div>
                        <small class="text text-danger">* @lang('gamecreate.code_text')</small>
                        <!-- <input type="hidden" class="required form-control" id="city_lat" name="city_lat">
                        <input type="hidden" class="required form-control" id="city_long" name="city_long"> -->
                        <input type="hidden" class="required form-control" id="mark_lat" name="mark_lat" value="">
                        <input type="hidden" class="required form-control" id="mark_long" name="mark_long" value="">

                        <br>

                        <br>
                        <div class="col-md-12" id="map"></div>

                        <br>
                        <br>
                        <button type="submit" class="btn btn-inverse-primary">@lang('gamecreate.submit')</button>
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




<!-- <script>

    var resStr = "Lonesome Dove,Bobby’s,Melting Pot,Daytime Place,Easy Eats,Macro Bites,Grubber Hub,Cheerful Rhino,Home Cooking Experience,Fare & Feed,Golden Palace,Soups & Snacks,Quick Bite,Fast & Friendly,Big Bites,Blind Pig,Eatable,Eatery,Goodies,Lard Boy,Many Foods,Me Likey,Wonton Express,Great Burger,Awesome Burger,Amazing Sauce,Asian Express,Fearless Wander,Crate Express,Smothered In Love,Sweet Delectable,Appetizing As Heck,Appetizing Bird,Scrumptious Temptations,Smile N’ Delight,Choice Foods,Dainty Dog,Hungry Dog,Heavenly Creations,Food For Thought,Food In My Tummy,Tum Tum Express,Lil Johnny’s,Bill’s Burgers,A Night In Paris,Distinctive Creations,Spicy Heat,Spicy Jack’s,Pepper Jack’s,Rich Meat,Fit For A King,King of Meat,Delicious Donuts,Rare Meats,Rare Cuts,Rare Choice,Sapid Salads,Soup & Salad Express,Seasoned,Smitten,Love Street,Ice Cream Sandwiches,For The Love Of Ice Cream,Infatuated Creations,Smack Dab,Frozen Yogurt,Sherbet,Mickey’s Foodstuff,Pick & Go,The Satiated Drink,Pearl,Bless This Mess Hall,Grits & Gravy,Cheerful Hippo,Mealtime,Summer’s End,Winter Comes,Nightcap,It’s Good Food,Leggo My Wagyu,Tokyo Beat,New York Pulse,Chicago Style Pizza,Hill Country Fare,TidBits,No Place Like Home,Trial & Error,Rinse & Repeat,Cook & Boil,Broiler,Broiled Duck,Prancing Pig,Sweet Duck,Aaron’s,Salt & Snow,Roaring Tiger,Fig’s BBQ,Odd Pig,Southside,Northend,Roaring Ridgemont,Tia’s Mexican Hut,Atomic Good,L’Gran,Casa Del Rio,Clio,Bartholomew’s,Villa,Sushi Roll,Hand Roll,By Hand,Made by Hand,Scratch House,Los Alma’s,Upstate,Fatty’s,Halal Meats,Shake It Up,Bridge,Uptown Park,Parrots,No Way,Prince’s,Ramen & Rolls,Flavor Town,Madison,Fig Tree,Lonely Grape";
    var resArr = resStr.split(",");
    console.log(resArr[Math.floor(Math.random() * 101)]);

    var map;
    var marker;

    function init_map(lat, long) {
        var bounds = new google.maps.LatLngBounds();
        var myLatLng = new google.maps.LatLng(lat, long);
        bounds.extend(myLatLng);

        var NEW_ZEALAND_BOUNDS = {
            north: -34.36,
            south: -47.35,
            west: 166.28,
            east: -175.81,
        };

        var lt = lat;
        var lg = long;

        $('#city_lat').val(lt);
        $('#city_long').val(lg);

        var opts = {
            'center': new google.maps.LatLng(lt, lg),
            // restriction: {
            //     latLngBounds: NEW_ZEALAND_BOUNDS,
            //     strictBounds: false,
            // },
            'zoom': 13,
            'mapTypeId': google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById('mymap'), opts);
        // map.fitBounds(bounds);

        // google.maps.event.addListener(map, 'bounds_changed', function() {
        //     console.log(map.getBounds());
        // });

        // console.log('--------------------------------');
        // console.log(map.getBounds());
        // console.log(map.LatLngBounds.getNorthEast());

        google.maps.event.addListener(map, 'click', function(event) {

            var host = window.location.origin;
            var image = host + '/img/res3.png';

            var resName = resArr[Math.floor(Math.random() * 101)];
            var xAxis = resName.length - 67;

            var icon = {
                url: image, // url
                labelOrigin: { x: 0, y: 45},
                scaledSize: new google.maps.Size(26, 40), // scaled size
                // origin: new google.maps.Point(0, 0), // origin
                // anchor: new google.maps.Point(0, 0) // anchor
            };

            if (marker) {
                marker.setMap(null);
            }
            $('#mark_lat').val(event.latLng.lat());
            $('#mark_long').val(event.latLng.lng());
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()),
                map: map,
                draggable: false,
                animation: google.maps.Animation.DROP,
                title: 'ANS',
                label: {
                    text: resName,
                    color: 'orange',
                    fontSize: '12px'
                },
                icon: icon
            });

            google.maps.event.addListener(marker, 'click', function() {
                // alert('SHOW CODE HERE');
            });
        });
    }
    google.maps.event.addDomListener(window, 'load', init_map(41.716667, 44.783333));

    $(document).ready(function() {
        $("body").on('change', '#city', function(e) {
            var lat = $('option:selected', this).attr('data-lat');
            var long = $('option:selected', this).attr('data-long');
            init_map(lat, long);
        });
        $("body").on('change', '#type', function(e) {
            if($(this).val() == 'gamecreate.code' || $(this).val() == 'კოდი'){
                $('#mymap').css('display', 'block');
            }
            else{
                $('#mymap').css('display', 'none');
            }
        });
    });
</script> -->




{{--<div class="row grid-margin">--}}
{{--<div class="col-lg-12">--}}
{{--<div class="card">--}}
{{--<div class="card-body">--}}
{{--<h4 class="card-title">Create Game</h4>--}}
{{--<div class="row">--}}
{{--<div class="col-12">--}}
{{--<table class="table">--}}
{{--<tbody>--}}
{{--<tr>--}}
{{--<form method="post" action="{{ route('games.store') }}">--}}
{{--<fieldset>--}}
{{--<div class="form-group">--}}
{{--@csrf--}}
{{--<label for="type">Your ID:</label>--}}
{{--<div class="card card-inverse-primary">--}}
{{--<div class="card-body">--}}
{{--<p id="clipboardExample3"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="form-group">--}}
{{--@csrf--}}
{{--<label for="type">Title:</label>--}}
{{--<input type="text" class="form-control" name="title"/>--}}
{{--</div>--}}
{{--<div class="form-group">--}}
{{--@csrf--}}
{{--<label for="type">Type:</label>--}}
{{--<input type="text" class="form-control" name="type"/>--}}
{{--</div>--}}
{{--<div class="form-group">--}}
{{--<label for="comment">Description :</label>--}}
{{--<input type="text" rows="5" id="clipboardExample2" class="form-control" name="comment" />--}}
{{--</div>--}}
{{--<div class="form-group">--}}
{{--<label for="comment">Long Description :</label>--}}
{{--<textarea type="text" rows="5" id="clipboardExample2" class="form-control" name="full_comment"></textarea>--}}
{{--</div>--}}
{{--<div class="card">--}}
{{--<div class="card-body">--}}
{{--<h4 class="card-title">Upload Image</h4>--}}
{{--<input type="file" class="dropify" />--}}
{{--</div>--}}
{{--</div>--}}
{{--<small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 4MB.</small>--}}
{{--</div>--}}
{{--<br>--}}
{{--<button type="submit" class="btn btn-inverse-primary">Submit</button>--}}
{{--</fieldset>--}}
{{--</form>--}}
{{--</tr>--}}
{{--</tbody>--}}
{{--</table>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
@endsection
