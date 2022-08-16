@extends('layouts.mainlayout')

@section('content')

<div class="content-wrapper">
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="{{ url('') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><span>Delegations</span></li>
        </ol>
    </nav>
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Delegations</h4>
          <p class="card-description">Borrow NFTs</p>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection


