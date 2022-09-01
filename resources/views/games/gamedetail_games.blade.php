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
    <div class="card-body">
        <div class="tab-pane fade show active" id="contact-6-3" role="tabpanel" aria-labelledby="tab-6-3">

            <td>{{ $game->points }} USDC required to join this game.</td>
            <td>
                <form method="post" action="{{route('bid', ['game_id' => $game->id])}}" enctype="multipart/form-data" id="form_join">
                {{csrf_field()}}
                <input type="hidden" class="required form-control" id="usdt_addr" value="{{ config('web3.chain.token') }}">
                <input type="hidden" class="required form-control" id="deposit_addr" value="{{ config('web3.wallet.address') }}">
                <input type="hidden" class="required form-control" id="points" name="points" value="{{ $game->points }}">
                <input type="hidden" class="required form-control" id="tx_hash" name="tx_hash" value="">
                <br>
                <br>
                <!-- <a href="{{route('bid', ['game_id' => $game->id])}}" id="join_game"> -->
                    <button class="btn btn-inverse-success" id="join_game">
                        @lang('gamedetail.start_playing')
                    </button>
                <!-- </a> -->
                </form>
                <div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            </td>
        </div>
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

<script src="https://cdn.ethers.io/lib/ethers-5.2.umd.min.js" type="application/javascript"></script>
<input type="hidden" id="network_id" value="{{config('web3.chain.network')}}" />
<script src="{{ asset('js/wallet.js') }}"></script>