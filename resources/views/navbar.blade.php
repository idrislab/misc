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
            <li class="nav-item mr-md-2 mb-2 mt-2 {{ \Route::currentRouteName() == 'hot' ? 'active' : '' }}">
                <a class="nav-link pl-3 pr-3" href="/">Trending</a>
            </li>
            <li class="nav-item mb-2 mt-2 {{ \Route::currentRouteName() == 'best' ? 'active' : '' }}">
                <a class="nav-link pl-3 pr-3" href="/best">Best</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="search" method="get">
            <input class="form-control mr-sm-2" type="text" name="query" placeholder="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>

    <div class="col-md-3  text-right">
        <span class="last-update">Updated </span> <span
                class="time">{{ \Carbon\Carbon::parse($status->updated_at)->diffForHumans() }}</span>
    </div>
</nav>