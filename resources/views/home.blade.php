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

        .navbar li.active {
            background-color: #12466D;
        }

        .navbar li:hover:not(.active) {
            background-color: #12466D;
        }

        .navbar li:not(.active):hover a {
            color: #fff !important;
        }

        .navbar li.active a {
            color: #fff !important;
        }

        .navbar li a {
            color: #424242;
        }

        .pagination {
            font-size: 65px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    @include('navbar')
    @include('threads')
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
        $('iframe').wrap("<div class='embed-responsive embed-responsive-16by9'></div>");
    });
</script>
</body>
</html>
