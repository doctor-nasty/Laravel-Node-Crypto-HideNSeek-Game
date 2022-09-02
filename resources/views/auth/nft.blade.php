<h2 class="w-100">Marketplace</h2>
<div class="row">
@foreach ($sales as $value => $nft)
<div class="col-lg-4 mb-mb-120 d-flex">
    <div class="purchase-block">
        <div class="purchase-img">
          <img src="{{ $nft->image }}" alt="controller icon">
        </div>
        <h3>{{ $nft->name }}</h3>
        <span class="price">
        {{ $nft->token_id <= 125 ? 500 * $ratio : 100 * $ratio }} USDC <img src="{{ asset('svgs/usdc-icon.svg') }}" alt="controller icon">
        </span>
        <button onclick="javascript:buyNft({{$nft->token_id}})">Purchase</button>
    </div>
</div>
@endforeach
</div>
<form id="search_form" name="search_form">
  <div class="form-group">
    {{-- <label>Search by Token ID</label> --}}
    @csrf
    <input hidden type="text" id="nft_type" name="type" value="{{ $nft_type }}" class="form-control" />
    <input hidden type="text" name="referrer" value="{{ $referrer }}" class="form-control" />
  </div>
</form>

<div id="search" class="purchase-buttons">
    <form id="playerform" name="playerform">
        <div class="form-group">
          {{-- <label>Search by Token ID</label> --}}
          <input hidden type="text" name="player" value="" class="form-control" />
          @csrf
  
        </div>
        <a class='btn btn-success' href='{{url("login")}}' id='playersbtn'>Players NFT</a>
      </form>
      <form id="creatorform" name="creatorform">
          <div class="form-group">
            {{-- <label>Search by Token ID</label> --}}
            <input hidden type="text" name="creator" value="" class="form-control" />
            @csrf
    
          </div>
          <a class='btn btn-success' href='{{url("login")}}' id='creatorsbtn'>Creators NFT</a>
        </form>
</div>

<div id="pagination" class="purchase-pagination">
    {{-- {!{$sales->appends(['per_page' => '20'])->links() !!} --}}
    {{$sales->links()}}
</div>
  
<form method="post" action='{{url("/check_purchase")}}' enctype="multipart/formdata" id="purchase_form">
  <input type="hidden" name="token_id" id="purchase_token_id">
  <input type="hidden" id="referrer" name="referrer" value="{{ $referrer }}">
  <input type="hidden" name="tx_hash" id="purchase_tx_hash">
  <input type="hidden" id="usdt_addr" value="{{ config('web3.chain.token') }}">
  <input type="hidden" id="vendor_addr" value="{{ config('web3.chain.vendor') }}">
  @csrf
</form>
