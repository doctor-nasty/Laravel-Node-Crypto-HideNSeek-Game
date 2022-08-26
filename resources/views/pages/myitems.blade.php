@extends('layouts.mainlayout')

@section('content')
    <!-- google map api start -->
    <!-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyCaWBIHePh4f4bQIROBybqJzKfaqiNCkac"></script> -->
    <!-- <script src="http://maps.google.com/maps/api/js?key=AIzaSyDkduGOlqZSICxQ40aTrr_shmIr1Nm5k2Q"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script> -->


    <!-- <style type="text/css">
        #mymap {
            border: 1px solid red;
            width: 100%;
            height: 500px;
        }

        #mymap_create_game {
            border: 1px solid red;
            width: 800px;
            height: 500px;
        }
    </style> -->
    @if (session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
<div class="content-wrapper section-block table-size">
            <div class="change-content-btn">
                <div class="active" aria-current="page">
                    <span class="btn-change">My Items</span>
                </div>
            </div>
    
            <div class="card">
                <div class="card-body">
                    <div class="dashboard-slider">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                @foreach ($tokens as $index => $token)
                                    <div class="swiper-slide">
                                        <img class="img-fluid" src="{{ $nft_image[$index] }}"></img>
                                        <div class="slider-content">
                                            <div class="slider-text">
                                                <h4>{{ $nft_name[$index] }}</h4>
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
          "@1.10": {
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
