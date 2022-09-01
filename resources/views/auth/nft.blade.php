<div class="row">
@foreach ($data as $value => $nft)
<div class="col-lg-4 mb-mb-120 d-flex">
    <div class="purchase-block">
        <div class="purchase-img">
          <img src="{{ $nftimage[$value] }}" alt="controller icon">
        </div>
        <h3>{{ $nftname[$value] }}</h3>
        <span class="price">
          0 USDC <img src="{{ asset('svgs/usdc-icon.svg') }}" alt="controller icon">
        </span>
        <button>Purchase</button>
    </div>
</div>
@endforeach
</div>
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

<div id="pagination" style="cent">
    {{-- {!{$data->appends(['per_page' => '20'])->links() !!} --}}
    {{$data->links()}}
</div>
  

