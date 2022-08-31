@foreach ($data as $value => $nft)
<div class="col-lg-4 mb-mb-120 d-flex">
    <div class="card-list-block">

        <img src="{{ $nftimage[$value] }}" alt="controller icon">

        <h3>{{ $nftname[$value] }}</h3>
        <button>Buy</button>
    </div>
</div>
@endforeach
<div id="pagination">
    {{-- {!{$data->appends(['per_page' => '20'])->links() !!} --}}
    {{$data->links()}}
</div>
  

