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
                            <div>
                                <a class="buy-with-crypto"
                                   href="https://commerce.coinbase.com/checkout/c2f601d5-7ac1-4564-b837-4b8d6f09a05c">
                                    <span>Buy with Crypto</span>
                                </a>
                                <script src="https://commerce.coinbase.com/v1/checkout.js?version=201807">
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection