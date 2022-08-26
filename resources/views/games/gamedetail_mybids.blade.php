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
<div class="modal-header">
    <h4 class="card-title"></h4>
    <button style="color:white" type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="tab-content tab-content-solid">
    <div class="body">
        <div class="tab-pane fade show active" id="contact-6-3" role="tabpanel" aria-labelledby="tab-6-3">
        
            @if($game->status === 2)
            <span class="text text-danger">@lang('gamedetail.game_has_finished')</span>
            @elseif(count($game->bids) >= $game->players)
            <blockquote class="blockquote blockquote-primary blockquote-table">
                <span>{{ $game->full_comment }}</span>
            </blockquote>

            <div class="col-md-12" id="map"></div>
            <br>

            <form action="{{route('bid.answer')}}" method="POST">
                {{csrf_field()}}
                <input name="game_id" type="hidden" value="{{$game->id}}" />
                <label>After selecting location on the map press submit button</label>
                <input name="answer" type="text" type="hidden" class="form-group form-control"/>
                <input name="osm_id" id="osm_id" type="hidden" required />
                <input name="place_id" id="place_id" type="hidden" required />
                <button class="btn btn-inverse-success" type="submit">Submit</button>
            </form>

            @else
            <blockquote class="blockquote blockquote-primary">
                <span>{{$game->players - count($game->bids)}} more players are required to join before game starts.</span>
            </blockquote>
            @endif

        </div>
    </div>
</div>

<script>
var map = L.map('map').setView(["{{$game->mark_lat + mt_rand() / mt_getrandmax() * 0.01 - 0.005}}", "{{$game->mark_long + mt_rand() / mt_getrandmax() * 0.01 - 0.005}}"], 14);

setInterval(function () {
   map.invalidateSize();
}, 100);

var poly = null;

map.on('click', function (e) {
    let addressTypes = ["shop", "amenity", "leisure"];
    $.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        url: "https://nominatim.openstreetmap.org/reverse?format=jsonv2&accept-language=en-US&lat=" 
            + e.latlng.lat + "&lon=" + e.latlng.lng,
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

            $('#osm_id').val(data.osm_id);
            $('#place_id').val(data.place_id);
        },
        error: function (result) {
            alert("Can't get location data!");
        }
    })
});


L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
}).addTo(map);
</script>

<script src="https://cdn.ethers.io/lib/ethers-5.2.umd.min.js" type="application/javascript"></script>
<script src="{{ asset('js/wallet.js') }}"></script>