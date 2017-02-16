<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>misQ.me - Bodybuilding Misc</title>

    <link href="https://fonts.googleapis.com/css?family=Lato|Pacifico" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Lato', sans-serif;
            font-size: 15px;
        }

        .rounded-circle {
            width: 40px;
            height: 40px;
        }

        .card-block {
            color: #212121;
            font-size: 16px;

        }

        .navbar-brand {
            font-family: 'Pacifico', cursive;
            font-size: 30px;
            color: #12466D !important;
        }

        .card {
            margin-bottom: 10px;
            margin-top: 10px;
            border: 1px solid rgba(115, 115, 115, 0.125);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        }

        .card-header {
            background-color: #FAFAFA;
            border-bottom: 0px;
        }

        h5 {
            font-size: 17px;
            font-weight: 300;
        }

        .label {
            color: #607D8B;
            font-size: 13px;
        }

        .label-text {
            color: #616161;
            font-size: 14px;
        }

        a {
            color: #283593;
        }

        a.label-link:hover, a.label-link:active, a.label-link:focus {
            text-decoration: none;
        }

        a:visited {
            color: #428BCB;
        }

        .last-update {
            color: #9E9E9E;
            font-size: 16px;
        }

        .time {
            color: #BDBDBD;
            font-size: 15px;
            white-space: nowrap;

        }

        .navbar {
            background-color: #fff;
        }

        li.active {
            background-color: #12466D;
            color: #fff;
        }

        li.active a {
            color: #fff !important;
        }

        .pagination {
            font-size: 65px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
            misQ.me
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ \Route::currentRouteName() == 'hot' ? 'active' : '' }}">
                    <a class="nav-link" href="/">Hot</a>
                </li>
                <li class="nav-item {{ \Route::currentRouteName() == 'best' ? 'active' : '' }}">
                    <a class="nav-link" href="/best">Best</a>
                </li>
            </ul>
        </div>
        <div class="col-md-2">
            <span class="last-update">Updated </span> <span
                    class="time">{{ \Carbon\Carbon::parse($status->updated_at)->diffForHumans() }}</span>
        </div>
    </nav>

    <div id="accordion" class="lazy col-md-12" data-loader="ajaxLoader" role="tablist" aria-multiselectable="true">
        @include('threads')
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>

<script>
    $(function () {
        $('img').attr('class', 'img-fluid');
    });
</script>
</body>
</html>
