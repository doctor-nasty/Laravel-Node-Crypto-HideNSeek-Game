<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}>

  @include('layouts.partials.head')

    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth-pages">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
              @if(session()->get('message'))
                  <div class="alert alert-success">
                      {{ session()->get('message') }}
                  </div>
              @endif
                <h3 class="card-title text-left mb-3">{{ Lang::trans('verify.verify') }}</h3>
                <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __(Lang::trans('verify.resend')) }}
                            </div>
                        @endif
    
                        {{ __(Lang::trans('verify.first')) }}
                        {{ __(Lang::trans('verify.ifnot')) }}, <a href="{{ route('verification.resend') }}">{{ __(Lang::trans('verify.ifnot2')) }}</a>.</a>
                    </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
@include('layouts.partials.footer-scripts')
</html>