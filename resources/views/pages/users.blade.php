@extends('layouts.mainlayout')

@section('content')
<div class="content-wrapper">
        <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                  <li class="breadcrumb-item"><a href="{{ url('') }}">@lang('games.dashboard')</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><span>@lang('settings.users')</span></li>
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
        <div class="card">

            <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    {{-- <table class="table table-hover table-responsive-md" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th> @lang('settings.avatar') </th>
                            <th> @lang('settings.username') </th>
                            <th> @lang('settings.rating') </th>
                            <th> @lang('settings.actions') </th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                          <tr>
                            <td class="py-1">
                              <img src="/storage/avatars/{{ $user->avatar }}" alt="image">
                            </td>
                            <td> {{$user->username}} </td>
                            <td>
                                <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $user->averageRating }}" data-size="xs" disabled="">
                            </td>
                            <td><a href="{{ route('users.show',$user->id) }}" class="btn btn-primary btn-sm">@lang('settings.view')</a>
                            </td>
                          </tr>
                          @endforeach
                        </ul> </nav> </div>
                        </tbody>
                      </table> --}}
                    {{-- <div class="nav-scroller py-1 mb-2">
                 <nav class="nav d-flex justify-content-center">
                     <ul class="pagination pagination-sm flex-sm-wrap">
                      {{ $users->links() }}
                    </ul>
                 </nav>
                 </div> --}}

                 <div class="table-responsive">
                    <table class="table sortable-table table-hover" id="data-table" cellspacing="0" width="100%"></table>
                </div>
                    </div>

                </div>

            </div>
          </div>
          <script>
            dataTableInit('#data-table', [4, 'desc'], 'POST', '{{ url('list/users') }}', [
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
                 },
                {
                    title: 'რეიტინგი',
                    data: 'average_rating'
                },
                {
                    title: '{{ Lang::trans('games.actions') }}',
                    data: 'status', render : function(data, type, row)
                    {
                        return '<div class="data-table-buttons-wrapper"><a class="btn btn-success details-button" href="user/'+row['id']+'" title="Details">{{ Lang::trans('games.rate') }}</a></div>';
                    }
                }
            ]);
        </script>
        <script type="text/javascript">

            $("#input-id").rating();

        </script>

@endsection
