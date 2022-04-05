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
    <div class="row user-profile">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="wrapper d-block d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title mb-0">@lang('settings.details')</h4>
                        <ul class="nav nav-tabs tab-solid tab-solid-primary mb-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-expanded="true">@lang('settings.info')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="avatar-tab" data-toggle="tab" href="#avatar" role="tab" aria-controls="avatar">@lang('settings.avatar')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security">@lang('settings.security')</a>
                            </li>
                        </ul>
                    </div>
                    <div class="wrapper">
                        <hr>
                        <div class="tab-content border-0" id="myTabContent">
                            <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info">
                        <form enctype="multipart/form-data" method="post" action="{{ route('settings.update') }}">
                                        @csrf
                                    <div class="form-group">
                                        <label for="username">@lang('settings.username')</label>
                                        <input required class="required form-control"  type="text" name="username" id="username" placeholder="Change Username" value="{{ $user->username }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">@lang('settings.email')</label>
                                        <input required class="required form-control"  type="text" name="email" id="email" placeholder="Change E-Mail" value="{{ $user->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="firstname">@lang('settings.first_name') *</label>
                                        <input required class="required form-control"  type="text" name="firstname" id="firstname" placeholder="Change First Name" value="{{ $user->firstname }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">@lang('settings.last_name') *</label>
                                        <input required class="required form-control"  type="text" name="lastname" id="lastname" placeholder="Change Last Name" value="{{ $user->lastname }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">@lang('settings.gender') *</label>
                                        <input required class="required form-control"  type="text" name="gender" id="gender" placeholder="Change Gender" value="{{ $user->gender }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="date_of_birth">@lang('settings.date_of_birth')</label>
                                        <input required class="required form-control"  type="date" name="date_of_birth" id="date_of_birth" placeholder="Change Date Of Birth" value="{{ $user->date_of_birth }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone_number">@lang('settings.phone_number') *</label>
                                        <input required class="required form-control"  type="number" name="phone_number" id="phone_number" placeholder="Change Phone Number" value="{{ $user->phone_number }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="id_number">@lang('settings.id_number') *</label>
                                        <p>{{ $user->id_number }}</p>
                                    </div>
                                    <div class="form-group mt-5">
                                        <button type="submit" class="btn btn-inverse-success mr-2">@lang('settings.update')</button>
                                    </div>
                        </form>
                            </div><!-- tab content ends -->
                            <div class="tab-pane fade" id="avatar" role="tabpanel" aria-labelledby="avatar-tab">
                                <form action="/settings/avatar" method="post" enctype="multipart/form-data">
                                        @csrf
                                <div class="wrapper mb-5 mt-4">
                                    <span class="badge badge-warning text-white">@lang('settings.note') : </span>
                                    <p class="d-inline ml-3 text-muted">@lang('settings.note_text')</p>.</p>
                                </div>
                                    <div class="form-group">
                                        <input type="file" class="required dropify" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        @endsection
