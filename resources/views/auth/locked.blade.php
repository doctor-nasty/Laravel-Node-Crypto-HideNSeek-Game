@extends('layouts.mainlayout')

@section('content')

    <div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Text</a></li>
                <li class="breadcrumb-item active" aria-current="page"><span>Text</span></li>
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

                    <div class="table-sorter-wrapper col-lg-12 table-responsive">
                        <h4 class="card-title mb-0">Contact Us</h4>

                        <div class="container contact-form" style="margin-top:100px">
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
                    
                    <form method="post" action="{{ route('contact.store') }}">
                        {{ csrf_field() }}
                       <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name *"  required />
                         @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                         @endif
                                </div>
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input type="email" name="email" class="form-control" placeholder="Your Email *"  required />
                                     @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                     @endif
                                </div>
                                <div class="form-group {{ $errors->has('subject') ? ' has-error' : '' }}">
                                    <input type="text" name="subject" class="form-control" placeholder="Subject *"  />
                                    @if ($errors->has('subject'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('subject') }}</strong>
                                                </span>
                                     @endif
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="btnSubmit" class="btn btn-primary btn-round btn-sm" value="Send Message" />
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('message') ? ' has-error' : '' }}">
                                    <textarea name="message" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;" required></textarea>
                         @if ($errors->has('message'))
                        <span class="help-block">
                        <strong>{{ $errors->first('message') }}</strong>
                        </span>
                        @endif
                                </div>
                            </div>
                        </div>
                    </form>
        </div>
        
                        

                    </div>

                </div>

            </div>


        </div>
        <br>
@endsection


