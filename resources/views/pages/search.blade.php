@extends('layouts.mainlayout')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form method="GET" action="{{ url('search') }}">
                                    <div class="form-group d-flex">
                                        <input type="text" name="search" class="form-control" placeholder="Search">
                                        <button class="btn btn-inverse-primary ml-3">Search</button>
                                    </div>
                                </form>
                            </div>
                            @if(count($games) > 0)
                            @foreach($games as $game)
                            <div class="col-12 results">
                                <div class="pt-4 border-bottom">
                                    <p class="d-block h4 mb-0">{{ $game->comment }}</p>
                                    <a class="page-url text-primary" href="{{ route('games.show', $game->id) }}">{{ $game->title }}</a>
                                    <p class="page-description mt-1 w-75 text-muted">{{ $game->type }}</p>
                                </div>
                            </div>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-danger">Results not found.</td>
                                </tr>
                            @endif
                            <nav class="col-12" aria-label="Page navigation">
                                <ul class="pagination mt-5">
                                    {{-- {{ $games->links() }} --}}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
