@extends('layouts.mainlayout')

@section('content')

    <div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ url('') }}">@lang('redeem.main')</a></li>
                <li class="breadcrumb-item active" aria-current="page"><span>@lang('redeem.redeem')</span></li>
            </ol>
        </nav>
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
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

        {{-- <div class="card card-inverse-warning">
                <div class="card-body">
                    <p class="card-text">
                       Withdrawal process can take up to 3 business day. You will receive confirmation by email
                    </p>
                </div>
            </div> --}}
        <div class="card">

            <div class="card-body">
                <div class="row">

                    <div class="col-lg-12 table-responsive">
                        <h4 class="card-title mb-0">@lang('redeem.title')</h4>

                        <div class="card-body">
                            @if(Auth::user()->points > 999)
                    <form method="post" action="{{ route('redeem.store') }}">
                        @csrf
                            <div class="row">
                            <div class="col-lg-12">
                                    <input hidden type="text" name="username" class="form-control" value="{{ Auth::user()->username }}"/>
                                    <input hidden type="email" name="email" class="form-control"/ value="{{ Auth::user()->email }}">
                                    <input hidden type="numbers" name="user_id" class="form-control"/ value="{{ Auth::user()->id }}">
                                    <script>
                                            $(document).ready(function(){
                                                $('#type').on('change', function() {
                                                if ( this.value == '{{ Lang::trans('redeem.gift_card') }}')
                                                //.....................^.......
                                                {
                                                    $("#wallet").hide();
                                                    $("#giftcard").show();
                                                }
                                                else  if ( this.value == '{{ Lang::trans('redeem.vcc') }}')
                                                {
                                                    $("#giftcard").hide();
                                                    $("#wallet").show();
                                                }
                                                else  
                                                {
                                                    $("#giftcard").hide();
                                                }
                                                });
                                            });
                                    </script>
                                <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                        <label>@lang('redeem.type')</label>
                                        <div class="input-group">
                                            <select name="type" id="type" required class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}">
                                                <option selected disabled></option>
                                                <option>@lang('redeem.gift_card')</option>
                                                <option>@lang('redeem.vcc')</option>
                                            </select>
                                        </div>
                                        <div style='display:none;' id="wallet" class="form-group {{ $errors->has('wallet') ? ' has-error' : '' }}">
                                                <label>@lang('redeem.wallet')</label>
                                                <input required type="text" name="wallet" class="form-control" placeholder=" @lang('redeem.wallet')*"  />
                                                @if ($errors->has('wallet'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('wallet') }}</strong>
                                                            </span>
                                                 @endif
                                            </div>                                        
                                            <div style='display:none;' id="giftcard" class="form-group {{ $errors->has('giftcard') ? ' has-error' : '' }}">
                                                    <label>@lang('redeem.giftcard')</label>
                                                    <div class="input-group">
                                                            <select name="giftcard" id="giftcard" required class="form-control{{ $errors->has('giftcard') ? ' is-invalid' : '' }}">
                                                                <option selected disabled></option>
                                                                <option>@lang('redeem.1giftcard')</option>
                                                                <option>@lang('redeem.2giftcard')</option>
                                                                <option>@lang('redeem.3giftcard')</option>
                                                                <option>@lang('redeem.4giftcard')</option>
                                                                <option>@lang('redeem.5giftcard')</option>
                                                            </select>
                                                    @if ($errors->has('giftcard'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('giftcard') }}</strong>
                                                                </span>
                                                     @endif
                                                    </div>
                                            </div>
                                </div>
                                <div class="form-group {{ $errors->has('points') ? ' has-error' : '' }}">
                                        <label>@lang('redeem.points')</label>
                                        <div class="input-group">
                                            <select name="points" id="points" required class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}">
                                                <option selected disabled></option>
                                                <option>1000</option>
                                                @if (auth()->user()->points > 1999)
                                                <option>2000</option>
                                                @endif
                                                @if (auth()->user()->points > 3999)
                                                <option>4000</option>
                                                @endif
                                                @if (auth()->user()->points > 5999)
                                                <option>6000</option>
                                                @endif
                                                @if (auth()->user()->points > 7999)
                                                <option>8000</option>
                                                @endif
                                                @if (auth()->user()->points > 9999)
                                                <option>10000</option>
                                                @endif
                                            </select>
                                        </div>                                             
                                        <small>@lang('redeem.text')</small><br>
                                        <strong class="text text-danger">@lang('redeem.text2')</strong>
                                    @if ($errors->has('points'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('points') }}</strong>
                                                </span>
                                     @endif
                                </div>
                                <div class="form-group">
                                    <input name="btnSubmit" class="btn btn-primary btn-round btn-sm" value="Submit" OnClick="submit()"/>

                                </div>
                            </div>

                        </div>
                    </form>
                    @else
                    <div class="card-body">
                        <span class="text text-danger">To Redeem Points You Must Have Minimum 1000 Points in Your Balance!</span>
                    </div>
                    @endif
        </div>
        
                        

                    </div>

                </div>

            </div>
        </div>

        </div>
@endsection


