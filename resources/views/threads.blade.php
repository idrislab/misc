@foreach ($threads as $thread)
    <div class="card mb-3">
        <div class="card-header" role="tab" id="headingOne">
            <h5 class="mb-3">
                <a href="http://forum.bodybuilding.com/showthread.php?t={{$thread->url}}" target="_blank">
                <!-- <img src="{{ $thread->avatar }}" class="rounded-circle mr-3"> --> {{ $thread->title }}
                    {!! str_repeat('<img width="16px" height="16px" src="img/star.png">', $thread->rating ) !!}
                </a>
            </h5>
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$thread->url}}"
               aria-expanded="true" aria-controls="collapseOne" class="label-link">
                <div class="row text-center">
                    <div class="col-6 col-md-2">
                        <div class="col-md-12 label">
                            {{ $thread->author }}
                        </div>
                        <div class="col-md-12 label-text">
                            <span class="align-middle">{{ \Carbon\Carbon::parse($thread->startDate)->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div class="col-md-12 label">
                            Last Post
                        </div>
                        <div class="col-md-12 label-text">
                            {{ \Carbon\Carbon::parse($thread->lastPostDate)->diffForHumans() }}
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div class="col-md-12 label">
                            Replies
                        </div>
                        <div class="col-md-12 label-text">
                            {{ $thread->replies }}
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
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

{{ $threads->links() }}
