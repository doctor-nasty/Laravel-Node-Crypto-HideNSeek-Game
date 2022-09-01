@foreach ($sales as $value => $nft)
<div class="col-lg-4 mb-mb-120 d-flex">
    <div class="card-list-block">

        <img src="{{ $nft->image }}" alt="controller icon">

        <h3>{{ $nft->name }}</h3>
        <p>Price: {{ $nft->token_id <= 125 ? 500 : 100 }} USDC</p>
        <button onclick="javascript:buyNft({{$nft->token_id}})">Buy</button>
    </div>
</div>
@endforeach
<div id="search">
    <form id="searchform" name="searchform">
      <div class="form-group">
        <label>Search by Token ID</label>
        <input type="text" name="token_id" value="{{request()->get('token_id','')}}" class="form-control" />
        @csrf

      </div>
      <a class='btn btn-success' href='{{url("login")}}' id='search_btn'>Search</a>
    </form>


  </div>

<div id="pagination">
    {{-- {!{$sales->appends(['per_page' => '20'])->links() !!} --}}
    {{$sales->links()}}
</div>
  
<form>
  <input type="hidden" name="token_id" id="purchase_token_id">
  <input type="hidden" name="tx_hash" id="purchase_tx_hash">
  <input type="hidden" id="usdc_addr" value="{{ config('web3.chain.token') }}">
  <input type="hidden" id="vendor_addr" value="{{ config('web3.chain.vendor') }}">
  @csrf
</form>
