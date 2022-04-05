@extends('layouts.mainlayout')

@section('content')

    <div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ url('') }}">@lang('contact.dashboard')</a></li>
                <li class="breadcrumb-item active" aria-current="page"><span>@lang('contact.contact')</span></li>
            </ol>
        </nav>
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="card">

            <div class="card-body">
                <div class="row">

                    <div class="col-lg-12 table-responsive">
                        <h4 class="card-title mb-0">@lang('contact.contact')</h4>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if (session('warning'))
                                <div class="alert alert-warning">
                                    {{ session('warning') }}
                                </div>
                            @endif
                    
                    <form method="post" action="{{ route('save_contact') }}">
                       @csrf
                       <div class="row">
                            <div class="col-lg-12">
                                    <input hidden type="text" name="username" class="form-control" value="{{ Auth::user()->username }}"/>
                                    <input hidden type="email" name="email" class="form-control"/ value="{{ Auth::user()->email }}">
                                    <input hidden type="numbers" name="user_id" class="form-control"/ value="{{ Auth::user()->id }}">
                                <div class="form-group {{ $errors->has('subject') ? ' has-error' : '' }}">
                                    <input required type="text" name="subject" class="form-control" placeholder="Subject *"  />
                                    @if ($errors->has('subject'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('subject') }}</strong>
                                                </span>
                                     @endif
                                </div>
                                <div class="form-group {{ $errors->has('message') ? ' has-error' : '' }}">
                                    <textarea name="message" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;" required></textarea>
                         @if ($errors->has('message'))
                        <span class="help-block">
                        <strong>{{ $errors->first('message') }}</strong>
                        </span>
                        @endif
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="btnSubmit" class="btn btn-primary btn-round btn-sm" value="Submit" />
                                    
                                </div>
                            </div>

                        </div>
                    </form>
        </div>
        
                        

                    </div>

                </div>

            </div>


        </div>
    </div>
@endsection


