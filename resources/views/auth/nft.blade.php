@foreach ($data as $value => $nft)
<div class="col-lg-4 mb-mb-120 d-flex">
    <div class="card-list-block">

        <img src="{{ $nftimage[$value] }}" alt="controller icon">

        <h3>{{ $nftname[$value] }}</h3>
        <p>Price: 0 USDC</p>
        <button>Buy</button>
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
    {{-- {!{$data->appends(['per_page' => '20'])->links() !!} --}}
    {{$data->links()}}
</div>
  

