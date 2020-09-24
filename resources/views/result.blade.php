<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GitHub Search</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">

<body>

<div class="results-wrapper">

    @foreach($users as $user)

        <div class="result-card">

            <div class="img">
                <img src="{{ $user -> avatar_url }}" alt="Profile image" />
            </div>

            <div>
                <h1>{{ $user -> login }}</h1>
            </div>

            <div>
                <a href="{{ $user -> repos_url }}">Check reprositories</a>
            </div>

            <div>
                <a href="{{ $user -> html_url }}">Check profile</a>
            </div>

        </div>


    @endforeach

</div>

</body>
</html>
