<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GitHub Search</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">


    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>


<body>

@if($entity == "users")

    <div class="results-wrapper">

        @foreach($items as $user)

            <div class="result-card">

                <div class="img">
                    <img src="{{ $user -> avatar_url }}" alt="Profile image" />
                </div>

                <div class="login">
                    <h2>{{ $user -> login }}</h2>
                </div>

                <div>
                    <a type="button" class="btn peach-gradient" href="{{ $user -> html_url }}">Visit profile</a>
                </div>

            </div>

        @endforeach

    </div>

@else

    <div class="results-wrapper">

        @foreach($items as $repo)

            <div class="result-card">

                <div class="login">
                    <h4>{{ $repo -> name }}</h4>
                    <h5>{{ $repo -> language }}</h5>
                </div>

                <div class="desc">
                    <p><b>Description:</b> {{ mb_strimwidth($repo -> description, 0, 400, '...') }}</p>
                    <p style="text-align: center"><i>By {{ $repo -> owner -> login }}</i></p>
                </div>


                <div>
                    <a type="button" class="btn peach-gradient" href="{{ $repo -> owner -> html_url }}">Visit owner's GitHub</a>
                    <a type="button" class="btn purple-gradient" href="{{ $repo -> html_url }}">Visit repository</a>
                </div>

            </div>

        @endforeach

    </div>

@endif

<div class="pagination-container">

    <div class="pagination-side">
        <h6><a href="{{route('home')}}"><i class="fas fa-search" aria-hidden="true"></i> Search again</a></h6>
    </div>


    <div class="pagination">
        {{--    if current page is first page   --}}
        @if($page == 1)
            <div class="current-page">
                @else
                    <div>
                        @endif
                        {{--    always display link to first page   --}}
                        <a href="{{route('results', [$entity, $search, 1, $sort, $order])}}">{{ 1 }}</a>
                    </div>

                    <div>
                        {{--    if the page number is greater than 3, then display first page with "..."    --}}
                        @if($page > 3)
                            <p>...</p>
                        @endif
                    </div>

                    <div>
                        {{--    display two pages backstep, unless it is first page--}}
                        @if($page-2 > 1)
                            <a href="{{route('results', [$entity, $search, $page - 2, $sort, $order])}}">{{ $page - 2 }}</a>
                        @endif
                    </div>

                    <div>
                        {{--    display one page backstep, unless it is first page--}}
                        @if($page-1 > 1)
                            <a href="{{route('results', [$entity, $search, $page-1, $sort, $order])}}">{{ $page - 1 }}</a>
                        @endif
                    </div>

                    {{--    display current page, unless it is first or last page        --}}
                    <div class="current-page">
                        @if($page != ceil($total_items / 30) && $page != 1)
                            <a href="{{route('results', [$entity, $search, $page, $sort, $order])}}">{{ $page }}</a>
                        @endif
                    </div>

                    {{--    display one page forward, unless it is more than last page        --}}
                    <div>
                        @if($page+1 < ceil($total_items / 30))
                            <a href="{{route('results', [$entity, $search, $page+1, $sort, $order])}}">{{ $page + 1 }}</a>
                        @endif
                    </div>

                    {{--    display two pages forward, unless it is more than last page        --}}
                    <div>
                        @if($page+2 < ceil($total_items / 30))
                            <a href="{{route('results', [$entity, $search, $page+2, $sort, $order])}}">{{ $page + 2 }}</a>
                        @endif
                    </div>

                    {{--    if the page number is greater than total pages - 2, then display last page without "..."    --}}
                    <div>
                        @if($page < ceil($total_items / 30)-3)
                            <p>...</p>
                        @endif
                    </div>


                    {{--    if current page is last page   --}}
                    @if($page == ceil($total_items / 30))
                        <div class="current-page">
                            @else
                                <div>
                                    @endif
                                    {{--    always display last page, unless it is the equal to first page        --}}
                                    @if(ceil($total_items / 30) != 1)
                                        <a href="{{route('results', [$entity, $search, ceil($total_items / 30), $sort, $order])}}">{{ ceil($total_items / 30) }}</a>
                                    @endif
                                </div>
                        </div>

        <div class="pagination-side hide-sm">
            <h6>Results found: {{ $total_items }}</h6>
        </divpagination-left>

</div>

</body>

</html>
