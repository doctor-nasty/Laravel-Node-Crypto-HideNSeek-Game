@extends('layouts.mainlayout')

@section('content')

<div class="content-wrapper">
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

    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="{{ url('') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><span>Delegations</span></li>
        </ol>
    </nav>
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Delegations</h4>
          <p class="card-description">Borrow NFTs</p>
          <div class="dashboard-slider">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                  @foreach ($tokens as $token)
                  <div class="swiper-slide">
                    <img src="{{ $token->image }}" alt="point icon">
                    <div class="slider-content">
                      <div class="slider-text">
                        <h4>
                          {{ $token->name }}
                          @if ($token->borrower == $my_address)
                            - Borrowed
                          @endif
                        </h4>
                        @if ($token->status == 1)
                        <span>Duration: {{ $token->duration }} days</span>
                        @elseif ($token->status == 2)
                        <span>Expiration Date: {{ $token->expiresAt }}</span>
                        @endif
                      </div>
                      <div class="slider-buttons">
                        @if ($token->status == 0)
                        <button class="slider-button-delegate" onclick="javascript:createDelegationOffer({{ $token->token_id }})">
                          Delegate
                        </button>
                        @elseif ($token->status == 1)
                        <button class="slider-button-cancel" onclick="javascript:cancelDelegationOffer({{ $token->token_id }})">
                          Cancel
                        </button>
                        @elseif ($token->borrower == $my_address)
                        <button class="slider-button-cancel" onclick="javascript:removeBorrowing({{ $token->token_id }})">
                          Remove
                        </button>
                        @endif
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <input type="hidden" class="required form-control" id="nft_addr" value="{{ config('web3.chain.nft') }}">
    <span id="tx_status"></span>
  </div>
</div>

<form method="post" action="{{ route('web3.delegation') }}" enctype="multipart/form-data" id="form_delegation">
  @csrf
  <input type="hidden" name="token_id" id="token_id">
  <input type="hidden" name="duration" id="duration">
  <input type="hidden" name="type" id="type">
  <input type="hidden" name="tx_hash" id="tx_hash">
</form>
    <script>
      var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
         breakpoints: {
          "@0.00": {
            slidesPerView: 1,
            spaceBetween: 10,
          },
          "@1.00": {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          "@1.50": {
            slidesPerView: 3,
            spaceBetween: 40,
          },
        },
      });
    </script>
@endsection

<!-- jQuery -->
<script src="{{ asset('js/login/jquery-3.0.0.min.js') }}"></script>
<script src="https://cdn.ethers.io/lib/ethers-5.2.umd.min.js" type="application/javascript"></script>
<script src="{{ asset('js/wallet.js') }}"></script>