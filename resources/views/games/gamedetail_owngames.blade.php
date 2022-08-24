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
        @if($game->user_id === auth()->user()->id)
        <div class="card-body">
            <span>Players: {{count($game->bids)}}</span>
        </div>
        @endif
    </div>
</div>


<script src="https://cdn.ethers.io/lib/ethers-5.2.umd.min.js" type="application/javascript"></script>
<script src="{{ asset('js/wallet.js') }}"></script>