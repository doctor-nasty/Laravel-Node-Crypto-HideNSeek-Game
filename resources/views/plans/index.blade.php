@extends('layouts.mainlayout')

@section('content')
    <div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ url('') }}">@lang('subscriptions.dashboard')</a></li>
                <li class="breadcrumb-item active" aria-current="page"><span>@lang('subscriptions.subscriptions')</span></li>
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
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="container text-center">
                <div class="row pricing-table">
                  @foreach($plans as $plan)
                  <div class="col-md-4 grid-margin stretch-card pricing-card">
                    <div class="card border-primary border pricing-card-body">
                      <div class="text-center pricing-card-head">
                        <h3 class="text-success">{{ $plan->name }}</h3>
                        <h1 class="font-weight-normal mb-4">{{ number_format($plan->cost, 2) }} @lang('subscriptions.gel_month')</h1>
                      </div>
                      <ul class="list-unstyled plan-features">
                        <li>{{ $plan->description }}</li>
                      </ul>
                      <div class="wrapper">
                        @csrf
                        @if(!auth()->user()->subscribedToPlan($plan->stripe_plan, 'main'))
                        <a href="{{ route('plans.show', $plan->slug) }}" class="btn btn-inverse-primary btn-block">@lang('subscriptions.choose')</a>
                        @else
                        <p class="text text-warning">@lang('subscriptions.subscribed')</li>
                      <form action="{{ route('subscription.cancel') }}" method="post">
                          {!! csrf_field() !!}
                          <input type="hidden" name="_method" value="DELETE">              
                          <button class="btn btn-inverse-danger">@lang('subscriptions.cancel')</button>
                        </form>
                        @endif
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    @endsection