@if ($home == true)

    <nav class="nav mainnav">
        <a href="/learn"><span class="fa fa-user"></span> Learn</a><a href="/mentor"><span class="fa fa-stack-overflow"></span> Mentor</a><a href="/hire"><span class="fa fa-building"></span> Hire</a>
    </nav>

@else

    <nav class="nav mainnav subpage">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <a class="cl-logo" href="/"><img src="{{ env('CLOUDFRONT') }}/assets/img/code-louisville-navy-one-line.svg" alt="Code Louisville"></a>
                </div>
                <div class="col-sm-9 links">
                    <a @if(Request::segment(1) == 'learn') class="active" @endif href="/learn"><span class="fa fa-user"></span> Learn</a><a @if(Request::segment(1) == 'mentor') class="active" @endif href="/mentor"><span class="fa fa-stack-overflow"></span> Mentor</a><a @if(Request::segment(1) == 'hire') class="active" @endif href="/hire"><span class="fa fa-building"></span> Hire</a>
                </div>
            </div>
        </div>
    </nav>

@endif
