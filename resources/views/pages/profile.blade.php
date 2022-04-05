@extends('layouts.mainlayout')

@section('content')
<div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                  <li class="breadcrumb-item"><a href="{{ url('') }}">@lang('games.dashboard')</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><span>@lang('settings.profile')</span></li>
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
        <div id="myModal" id="darkModalForm" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">@lang('settings.verification')</h4>
                      <button style="color:white" type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                            <p>@lang('settings.verify')</p>
                      </div>
                    {{-- <div class="modal-footer">
                            <p>test</p>
                    </div> --}}
                  </div>

                </div>
        </div>
            <div class="row">
                <div class="col-md-4 grid-margin">
                    <div class="card text-center">
                        <div class="card-body">
                                <h4 class="card-title">Info</h4>
                                <img src="/storage/avatars/{{ $user->avatar }}" alt="" width="200" height="200">
                                <div class="card-body">
                                @if ($user->status == 3)
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                                    <span>@lang('settings.unverified')</span>
                                </button>                            @else
                                <p style="text-align:center;" class="btn btn-success">@lang('settings.verified')</p>
                                @endif
                                </div>
                                <p class="name">{{ $user->firstname }} {{ $user->lastname }}</p>
                                <p class="designation">- {{ $user->phone_number }} -</p>
                                <a class="d-block text-center text-white" href="#">{{ $user->email }}</a>
                                <a class="d-block text-center text-white" href="#">{{ $user->username }}</a>
                                <a class="d-block text-center text-white" href="#">{{ $user->date_of_birth }}</a>
                                <a class="d-block text-center text-white" href="#">{{ $user->id_number }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin">
                    <div class="card text-center">
                        <div class="card-body">
                            @forelse(auth()->user()->getReferrals() as $referral)
                                <h4 class="card-title">{{ $referral->program->name }}</h4>
                                <p>@lang('settings.link')</p>
                                <code>
                                    {{ $referral->link }}
                                </code>
                                <br>
                                <br>
                                <p>
                                    @lang('settings.referred_users'): {{ $referral->relationships()->count() }}
                                </p>
                            @empty
                            @lang('settings.noreferrals')
                            @endforelse

                        </div>
                    </div>
                </div>

            </div>
</div>
@endsection
