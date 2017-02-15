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

        h1.logo {
            font-family: 'Pacifico', cursive;
            font-size: 50px;
            color: #12466D;
        }
        .card {
            margin-bottom: 10px;
            margin-top: 10px;
            border: 1px solid rgba(115, 115, 115, 0.125);
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
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
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="mb-3 mt-3 text-center">
        <h1 class="logo">misQ.me</h1>
        <span class="last-update">Updated <span class="time">{{ \Carbon\Carbon::parse($status->updated_at)->diffForHumans() }}</span></span>
    </div>

    <div id="accordion" role="tablist" aria-multiselectable="true">
        @foreach ($threads as $thread)
            <div class="card">
                <div class="card-header" role="tab" id="headingOne">
                    <h5 class="mb-3">
                        <a href="http://forum.bodybuilding.com/showthread.php?t={{$thread->url}}" target="_blank">
                            {{ $thread->title }}
                        </a>
                    </h5>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$thread->url}}"
                       aria-expanded="true" aria-controls="collapseOne" class="label-link">
                        <div class="row text-center">
                            <div class="col-md-1">
                                <img src="{{ $thread->avatar }}" class="rounded-circle">
                            </div>
                            <div class="col-md-2 align-middle">
                                <div class="col-md-12 label">
                                    {{ $thread->author }}
                                </div>
                                <div class="col-md-12 label-text">
                                    <span class="align-middle">{{ \Carbon\Carbon::parse($thread->startDate)->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="col-md-12 label">
                                    Last Post
                                </div>
                                <div class="col-md-12 label-text">
                                    {{ \Carbon\Carbon::parse($thread->lastPostDate)->diffForHumans() }}
                                </div>
                            </div>

                            <div class="col-md-2 text-center">
                                <div class="col-md-12 label">
                                    Replies
                                </div>
                                <div class="col-md-12 label-text">
                                    {{ $thread->replies }}
                                </div>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="col-md-12 label">
                                    Views
                                </div>
                                <div class="col-md-12 label-text">
                                    {{ $thread->views }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                    <div id="collapse{{$thread->url}}" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="card-block">
                            {!! $thread->description !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
            integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
            integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
            integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
            crossorigin="anonymous"></script>
</body>
</html>
