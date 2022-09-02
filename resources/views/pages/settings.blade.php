@extends('layouts.mainlayout')

@section('content')
<div class="content-wrapper">
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
        <div class="change-content-btn">
            <div>
              <a href="{{ url('') }}" class="btn-change">Dashboard</a>
            </div>
            <div class="active">
              <span class="btn-change">Settings</span>
            </div>
          </div>
    <div class="row user-profile">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="wrapper d-block d-sm-flex align-items-center justify-content-between">
                        <ul class="nav nav-tabs tab-solid tab-solid-primary mb-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="info-tab" data-toggle="tab" href="#referral" role="tab" aria-controls="referral" aria-expanded="true">Referrals</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="avatar-tab" data-toggle="tab" href="#avatar" role="tab" aria-controls="avatar">Avatar</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security">@lang('settings.security')</a>
                            </li> --}}
                        </ul>
                    </div>
                    <div class="wrapper">
                        <hr>
                        <div class="tab-content border-0" id="myTabContent">
                            <div class="tab-pane fade" id="referral" role="tabpanel" aria-labelledby="info">
                                <span class="badge badge-warning text-white"><a href="{{$referral_url}}">{{$referral_url}}</a></span>
                            </div>
                            <div class="tab-pane fade show active" id="avatar" role="tabpanel" aria-labelledby="avatar-tab">
                                <form action="/settings/avatar" method="post" enctype="multipart/form-data">
                                        @csrf
                                <div class="wrapper mb-5 mt-4">
                                    <span class="badge badge-warning text-white">Note : </span>
                                    <p class="d-inline ml-3 text-muted">Max upload size is 2 MB</p>.</p>
                                </div>
                                    <div class="form-group">
                                        <input type="file" class="required dropify" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                            {{-- <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                                    <form action="/settings/password" method="post" role="form">
                                            {{csrf_field()}}
                                        <div class="form-group{{ $errors->has('old') ? ' has-error' : '' }}">
                                        <label for="change-password">@lang('settings.change_password')</label>
                                        <input class="required form-control" type="password" name="old" id="change-password" placeholder="Enter you current password">
                                        @if ($errors->has('old'))
                                        <span class="help-block">
                                          <strong class="text text-danger">{{ $errors->first('old') }}</strong>
                                        </span>
                                      @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <input class="required form-control" name="password" type="password" id="new-password" placeholder="Enter you new password">
                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                          <strong class="text text-danger">{{ $errors->first('password') }}</strong>
                                        </span>
                                      @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        <input class="required form-control" name="password_confirmation" type="password" id="new-password" placeholder="Enter you new password">
                                        @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                          <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                      @endif
                                    </div>
                                    <div class="form-group mt-5">
                                        <button type="submit" class="btn btn-inverse-success mr-2">@lang('settings.update')</button>
                                    </div>
                                </form>
                                </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        @endsection
