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

<div class="show-btns">
    <button id="showUsers" type="button" class="btn near-moon-gradient waves-effect">Show Users</button>
    <button id="showRepos" type="button" class="btn btn-outline-default waves-effect">Show Repositories</button>
</div>


<div class="users">

    <div class="results-wrapper">

        @foreach($users as $user)

            <div class="result-card">

                <div class="img">
                    <img src="{{ $user -> avatar_url }}" alt="Profile image" />
                </div>

                <div class="login">
                    <h2>{{ $user -> login }}</h2>
                </div>

                <div>
                    <a type="button" class="btn peach-gradient" href="{{ $user -> repos_url }}">Check repositories</a>
                </div>

                <div>
                    <a type="button" class="btn btn blue-gradient" href="{{ $user -> html_url }}">Visit profile</a>
                </div>

            </div>

        @endforeach

    </div>

</div>


<div class="repos hidden">

    <div class="results-wrapper">

        @foreach($repos as $repo)

            <div class="result-card">

                <div>
                    <h1>{{ $repo -> language }}</h1>
                </div>

                <div class="login">
                    <h2>{{ $repo -> name }}</h2>
                </div>

                <div>
                    <p>By: {{ $repo -> owner -> login }}</p>
                </div>

                <div>
                    <p>Description: {{ $repo -> description }}</p>
                </div>

                <div>
                    <a type="button" class="btn peach-gradient" href="{{ $repo -> owner -> html_url }}">Visit owner GitHub</a>
                </div>

                <div>
                    <a type="button" class="btn btn blue-gradient" href="{{ $repo -> html_url }}">Visit repository</a>
                </div>

            </div>

        @endforeach

    </div>

</div>

</body>

<script>

    $("#showUsers").click(function() {
        $("#showRepos").removeClass("near-moon-gradient");
        $("#showRepos").addClass("btn-outline-default");

        $("#showUsers").removeClass("btn-outline-default");
        $("#showUsers").addClass("near-moon-gradient");

        $(".users").show( "slow" );
        $(".repos").hide( "slow" );
    });

    $("#showRepos").click(function() {
        $("#showUsers").removeClass("near-moon-gradient");
        $("#showUsers").addClass("btn-outline-default");

        $("#showRepos").removeClass("btn-outline-default");
        $("#showRepos").addClass("near-moon-gradient");

        $(".users").hide( "slow" );
        $(".repos").show( "slow" );
    });

</script>

</html>
