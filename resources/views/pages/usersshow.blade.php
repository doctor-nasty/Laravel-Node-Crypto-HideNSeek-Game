@extends('layouts.mainlayout')

@section('content')
<div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                  <li class="breadcrumb-item"><a href="{{ url('') }}">@lang('games.dashboard')</a></li>
                  <li class="breadcrumb-item"><a href="{{ url('users') }}">@lang('settings.users')</a></li>
                <li class="breadcrumb-item active" aria-current="page"><span>{{ $user->username }}</span></li>
                </ol>
              </nav>

    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
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
        <div class="card">

            <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <h3 class="product-title">{{ $user->username}}</h3>
                    @if($user->username == Auth::user()->username)
                    <blockquote>საკუთარი თავის შეფასება შეუძლებელია</blockquote>
                    @else
                    @if($user->username != Auth::user()->username)
                    <form method="POST" action="{{ route('users.post') }}">
                        @csrf
                    <div class="rating">

                        {{-- <span id="input-id"></span> --}}

                        <input id="input-1" name="rate" class="rating rating-stars" data-min="0" data-max="5" data-step="1" value="{{ $user->userAverageRating }}" data-size="xs">

                        <input type="hidden" name="id" required="" value="{{ $user->id }}">

                        <span class="review-no">სულ შეფასებულია: {{ $user->userSumRating }}</span>

                        <br>
                        <br>

                        <button class="btn btn-success" type="submit">@lang('settings.submit')</button>

                    </div>
                </form>
                    @endif
                    @endif
                </div>

                </div>

            </div>
          </div>

        <script type="text/javascript">

            $("#input-id").rating();

        </script>

@endsection
