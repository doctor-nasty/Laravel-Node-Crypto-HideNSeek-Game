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
<div class="tab-content tab-content-solid">

    <div class="tab-pane fade show active" id="contact-6-3" role="tabpanel" aria-labelledby="tab-6-3">
        @if($game->status === 2)
        <span class="text text-danger">@lang('gamedetail.game_has_finished')</span>
        @elseif(count($game->bids) >= $game->players)
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
        @else
        <blockquote class="blockquote blockquote-primary">
            <span>{{$game->players - count($game->bids)}} more players are required to join before game starts.</span>
        </blockquote>
        @endif


    </div>
</div>

<script>
var map = L.map('map').setView(["{{$game->mark_lat}}", "{{$game->mark_long}}"], 14);

setInterval(function () {
   map.invalidateSize();
}, 100);
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

<script src="https://cdn.ethers.io/lib/ethers-5.2.umd.min.js" type="application/javascript"></script>
<script src="{{ asset('js/wallet.js') }}"></script>