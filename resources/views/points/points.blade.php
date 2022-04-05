@extends('layouts.mainlayout')

@section('content')

    <div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ url('') }}">@lang('points.dashboard')</a></li>
                <li class="breadcrumb-item active" aria-current="page"><span>@lang('points.points')</span></li>
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
                        <div align="center">
                        <h3>@lang('points.your_points_1') 
                            <span style="color: green;">
                                <b>{{ Auth::user()->points }}</b>
                            </span> 
                            @lang('points.your_points_2')
                        </h3>
                        <br>
                        <a href="{{ route('buy_points') }}">
                            <button class="btn btn-primary">
                                @lang('points.buy_points')
                            </button>
                        </a>
                        </div>
                        <br>
                        <table class="table sortable-table table-hover" id="data-table" cellspacing="0" width="100%"></table>
                    </div>

                </div>

            </div>
        </div>

        </div>
        <script>
            dataTableInit('#data-table', [3, 'desc'], 'POST', '{{ url('list/points') }}', [
                {
                    title: '{{ Lang::trans('points.photo') }}',
                    data: 'avatar', render : function(data, type, row){
                      return '<img src="/storage/avatars/'+data+'" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">'
                }},
                {
                    title: '{{ Lang::trans('points.username') }}',
                    data: 'username'
                },
                {
                    title: '{{ Lang::trans('points.created_at') }}',
                    data: 'created_at'
                },
                {
                    title: '{{ Lang::trans('points.points') }}',
                    data: 'points'
                },
                {
                title: '{{ Lang::trans('points.status') }}',
                data: 'status', render : function(data, type, row)
                {
                    switch (data)
                    {
                        case '1': return '<span class="btn btn-success">{{ Lang::trans('points.active') }}</span>';
                            break;
                        case '0': return '<span class="btn btn-danger">{{ Lang::trans('points.disabled') }}</span>';
                            break;
                        case '3': return '<span class="btn btn-danger">{{ Lang::trans('points.unverified') }}</span>';
                            break;
                    }
                }
                }
            ]);
        </script>
@endsection


