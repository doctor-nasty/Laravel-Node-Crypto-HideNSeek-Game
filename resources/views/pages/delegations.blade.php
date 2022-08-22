@extends('layouts.mainlayout')

@section('content')

<div class="content-wrapper">
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
                  <div class="swiper-slide">
                    <img src="{{ asset('images/slider-test.png') }}" alt="point icon">
                    <div class="slider-content">
                      <div class="slider-text">
                        <h4>Pirate with hat</h4>
                        <span>Expiration Date: 01:02:2022</span>
                      </div>
                      <div class="slider-buttons">
                        <button class="slider-button-cancel">
                          Cancel
                        </button>
                        <button class="slider-button-delegate">
                          Delegate
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <img src="{{ asset('images/slider-test.png') }}" alt="point icon">
                    <div class="slider-content">
                      <div class="slider-text">
                        <h4>Pirate with hat</h4>
                        <span>Expiration Date: 01:02:2022</span>
                      </div>
                      <div class="slider-buttons">
                        <button class="slider-button-cancel">
                          Cancel
                        </button>
                        <button class="slider-button-delegate">
                          Delegate
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <img src="{{ asset('images/slider-test.png') }}" alt="point icon">
                    <div class="slider-content">
                      <div class="slider-text">
                        <h4>Pirate with hat</h4>
                        <span>Expiration Date: 01:02:2022</span>
                      </div>
                      <div class="slider-buttons">
                        <button class="slider-button-cancel">
                          Cancel
                        </button>
                        <button class="slider-button-delegate">
                          Delegate
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    <script>
      var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
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


