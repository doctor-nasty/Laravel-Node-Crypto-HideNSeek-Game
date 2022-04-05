@extends('layouts.mainlayout')

@section('content')

<div class="content-wrapper">
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="{{ url('') }}">@lang('contact.dashboard')</a></li>
            <li class="breadcrumb-item active" aria-current="page"><span>@lang('documentation.title')</span></li>
        </ol>
    </nav>
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">@lang('documentation.title')</h4>
          <p class="card-description">@lang('documentation.warning')</p>
          <div class="accordion" id="accordion-3" role="tablist">
            <div class="card">
              <div class="card-header" role="tab" id="headingOne-1">
                <h5 class="mb-0">
                  <a data-toggle="collapse" href="#collapseOne-3" aria-expanded="false" aria-controls="collapseOne-3" class="collapsed"> @lang('documentation.q1') </a>
                </h5>
              </div>
              <div id="collapseOne-3" class="collapse" role="tabpanel" aria-labelledby="headingOne-3" data-parent="#accordion-3" style="">
                <div class="card-body"> @lang('documentation.a1') </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" role="tab" id="headingTwo-2">
                <h5 class="mb-0">
                  <a class="collapsed" data-toggle="collapse" href="#collapseTwo-3" aria-expanded="false" aria-controls="collapseTwo-3"> @lang('documentation.q2') </a>
                </h5>
              </div>
              <div id="collapseTwo-3" class="collapse" role="tabpanel" aria-labelledby="headingTwo-3" data-parent="#accordion-3">
                <div class="card-body">
                    <div class="card-body"> @lang('documentation.a2') </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" role="tab" id="headingThree-3">
                <h5 class="mb-0">
                  <a class="collapsed" data-toggle="collapse" href="#collapseThree-3" aria-expanded="false" aria-controls="collapseThree-3"> @lang('documentation.q3') </a>
                </h5>
              </div>
              <div id="collapseThree-3" class="collapse" role="tabpanel" aria-labelledby="headingThree-3" data-parent="#accordion-3">
                <div class="card-body"> @lang('documentation.a3') </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" role="tab" id="headingFour-4">
                <h5 class="mb-0">
                  <a class="collapsed" data-toggle="collapse" href="#collapseFour-3" aria-expanded="false" aria-controls="collapseFour-3"> @lang('documentation.q4') </a>
                </h5>
              </div>
              <div id="collapseFour-3" class="collapse" role="tabpanel" aria-labelledby="headingFour-3" data-parent="#accordion-3">
                <div class="card-body"> @lang('documentation.a4') </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" role="tab" id="headingFive-5">
                <h5 class="mb-0">
                  <a class="collapsed" data-toggle="collapse" href="#collapseFive-3" aria-expanded="false" aria-controls="collapseFive-3"> @lang('documentation.q5') </a>
                </h5>
              </div>
              <div id="collapseFive-3" class="collapse" role="tabpanel" aria-labelledby="headingFive-3" data-parent="#accordion-3">
                <div class="card-body"> @lang('documentation.a5') </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" role="tab" id="headingSix-6">
                <h5 class="mb-0">
                  <a class="collapsed" data-toggle="collapse" href="#collapseSix-3" aria-expanded="false" aria-controls="collapseSix-3"> @lang('documentation.q6') </a>
                </h5>
              </div>
              <div id="collapseSix-3" class="collapse" role="tabpanel" aria-labelledby="headingSix-3" data-parent="#accordion-3">
                <div class="card-body"> @lang('documentation.a6') </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


