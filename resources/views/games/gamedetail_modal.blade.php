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
<h4 class="card-title">{{ $game->title }}</h4>
<button style="color:white" type="button" class="close" data-dismiss="modal">&times;</button>
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
                {{-- <button type="button" class="btn btn-dark icon-btn dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-account"></i>
                </button> --}}
                {{-- <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7">
                    <h6 class="dropdown-header">@lang('gamedetail.actions')</h6>
                    <a id="edit_game" data-id="{{$game->id}}" data-toggle="modal" data-target="#myModal2" class="dropdown-item" href="#">@lang('gamedetail.edit')</a>
                    <form action="{{ route('games.destroy', $game->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are You Sure?')" class="dropdown-item">@lang('gamedetail.remove')</button>
                    </form>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('games.create') }}">@lang('gamedetail.create_new_game')</a>
                </div> --}}
                                    <!--<a id="edit_game" data-id="{{$game->id}}" data-toggle="modal" data-target="#myModal" class="dropdown-item" href="{{ route('games.edit', $game->id) }}">@lang('gamedetail.edit')</a>-->

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
                    @lang('gamedetail.username'): {{ $user->username }}
                </div>
                <div class="tab-pane fade show active" id="profile-6-1" role="tabpanel" aria-labelledby="tab-6-1">
                    @lang('gamedetail.rating'): {{ $user->averageRating }}
                </div>
                <br>
                <div class="tab-pane fade show active" id="profile-6-1" role="tabpanel" aria-labelledby="tab-6-1">
                    <a href="{{ route('users.show',$user->id) }}" class="btn btn-primary btn-sm">@lang('gamedetail.rate')</a>
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
            {{-- @lang('gamedetail.game_code') --}}
            {{-- <span class="input-group-addon bg-dark" id="basic-addon1">ur_{{ $game->identifier }}</span> --}}
        </div>



        @else

        @foreach($game->bids as $bid)
        @if($bid->user_id == Auth::user()->id)

        @php
        $bid_on = 1;
        @endphp

        @endif
        @endforeach

        @if(isset($bid_on) && $bid_on == 1 and count($game->bids) >= 2)
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

        <br>
        <div class="col-md-12" id="map"></div>

        {{ Request::get('https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=47.217954&lon=-1.552918') }}

        @else
        @if(isset($bid_on) && $bid_on == 1 and count($game->bids) <= 2)
        <blockquote class="blockquote blockquote-primary">
            <span>@lang('gamedetail.onemore')</span>
        </blockquote>
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
     @endif


    </div>
</div>

<script>
var map = L.map('map').setView(["{{$game->mark_lat}}", "{{$game->mark_long}}"], 14);

var circle = L.circle(["{{$game->mark_lat}}", "{{$game->mark_long}}"], {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: 500
}).addTo(map);


L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
}).addTo(map);
</script>

<!-- <script>

    var resStr = "Lonesome Dove,Bobby’s,Melting Pot,Daytime Place,Easy Eats,Macro Bites,Grubber Hub,Cheerful Rhino,Home Cooking Experience,Fare & Feed,Golden Palace,Soups & Snacks,Quick Bite,Fast & Friendly,Big Bites,Blind Pig,Eatable,Eatery,Goodies,Lard Boy,Many Foods,Me Likey,Wonton Express,Great Burger,Awesome Burger,Amazing Sauce,Asian Express,Fearless Wander,Crate Express,Smothered In Love,Sweet Delectable,Appetizing As Heck,Appetizing Bird,Scrumptious Temptations,Smile N’ Delight,Choice Foods,Dainty Dog,Hungry Dog,Heavenly Creations,Food For Thought,Food In My Tummy,Tum Tum Express,Lil Johnny’s,Bill’s Burgers,A Night In Paris,Distinctive Creations,Spicy Heat,Spicy Jack’s,Pepper Jack’s,Rich Meat,Fit For A King,King of Meat,Delicious Donuts,Rare Meats,Rare Cuts,Rare Choice,Sapid Salads,Soup & Salad Express,Seasoned,Smitten,Love Street,Ice Cream Sandwiches,For The Love Of Ice Cream,Infatuated Creations,Smack Dab,Frozen Yogurt,Sherbet,Mickey’s Foodstuff,Pick & Go,The Satiated Drink,Pearl,Bless This Mess Hall,Grits & Gravy,Cheerful Hippo,Mealtime,Summer’s End,Winter Comes,Nightcap,It’s Good Food,Leggo My Wagyu,Tokyo Beat,New York Pulse,Chicago Style Pizza,Hill Country Fare,TidBits,No Place Like Home,Trial & Error,Rinse & Repeat,Cook & Boil,Broiler,Broiled Duck,Prancing Pig,Sweet Duck,Aaron’s,Salt & Snow,Roaring Tiger,Fig’s BBQ,Odd Pig,Southside,Northend,Roaring Ridgemont,Tia’s Mexican Hut,Atomic Good,L’Gran,Casa Del Rio,Clio,Bartholomew’s,Villa,Sushi Roll,Hand Roll,By Hand,Made by Hand,Scratch House,Los Alma’s,Upstate,Fatty’s,Halal Meats,Shake It Up,Bridge,Uptown Park,Parrots,No Way,Prince’s,Ramen & Rolls,Flavor Town,Madison,Fig Tree,Lonely Grape";
    var resArr = resStr.split(",");
    console.log(resArr);
    $(document).ready(function() {

            if('{{$game->type}}' == 'gamecreate.code' || '{{$game->type}}' == 'კოდი'){
                $('#mymap').css('display', 'block');
            }
            else{
                $('#mymap').css('display', 'none');
            }
    });

    var map;
    var marker;

    function init_map(lat, long) {
        var NEW_ZEALAND_BOUNDS = {
            north: -34.36,
            south: -47.35,
            west: 166.28,
            east: -175.81,
        };

        var lt = lat;
        var lg = long;

        var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
        var isDraggable = !('ontouchstart' in document.documentElement);

        var opts = {
            'center': new google.maps.LatLng(lt, lg),
            // restriction: {
            //     latLngBounds: NEW_ZEALAND_BOUNDS,
            //     strictBounds: false,
            // },
            'zoom': 18,
            'gestureHandling': 'greedy',
            'zoomControl': false,
            'scrollwheel': false,
            // 'draggable': true,
            // 'panControl': true,
            // 'scaleControl': true,
            // 'disableDefaultUI': true,
            // 'disableDoubleClickZoom': true,
            // 'navigationControl': false,
            // 'mapTypeControl': false,
            // 'scaleControl': false,
            'mapTypeId': google.maps.MapTypeId.ROADMAP,
            'componentRestrictions': {country: "geo"},
        }
        map = new google.maps.Map(document.getElementById('mymap'), opts);

        // var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';

        var host = window.location.origin;
        var image = host + '/img/res3.png';

        var resName = resArr[Math.floor(Math.random() * 101)];
        var xAxis = resName.length - 67;

        var icon = {
            url: image, // url
            labelOrigin: {
                x: 0,
                y: 45
            },
            // labelOrigin: {
            //     x: -50,
            //     y: 18
            // },
            scaledSize: new google.maps.Size(26, 40), // scaled size
            // origin: new google.maps.Point(0, 0), // origin
            // anchor: new google.maps.Point(0, 0) // anchor
        };

        marker = new google.maps.Marker({
            position: new google.maps.LatLng("{{$game->mark_lat}}", "{{$game->mark_long}}"),
            map: map,
            draggable: true,
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
            alert('Your answer is: {{$game->identifier}}');
        });

        google.maps.event.addListener(map, 'zoom_changed', function() {
            zoomLevel = map.getZoom();
            console.log(zoomLevel);
            if(zoomLevel == 17 || zoomLevel == 18){
                marker.setVisible(true);
            }
            else{
                marker.setVisible(false);
            }
            //this is where you will change your icon...
        });
    }
    if('{{$game->type}}' == 'gamecreate.code' || '{{$game->type}}' == 'კოდი')
    {
        google.maps.event.addDomListener(window, 'load', init_map("{{$game->city_lat}}", "{{$game->city_long}}"));
    }
</script> -->

