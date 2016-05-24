@if ($home == true)

    <nav class="nav mainnav">
        <a href="/candidates"><span class="fa fa-user"></span> Candidates</a><a href="/mentors"><span class="fa fa-stack-overflow"></span> Mentors</a><a href="/employers"><span class="fa fa-building"></span> Employers</a>
    </nav>

@else

    <nav class="nav mainnav subpage">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <a class="cl-logo" href="/"><img src="{{ env('CLOUDFRONT') }}/assets/img/code-louisville-navy-one-line.svg" alt="Code Louisville"></a>
                </div>
                <div class="col-sm-9 links">
                    <a @if(Request::segment(1) == 'candidates') class="active" @endif href="/candidates"><span class="fa fa-user"></span> Candidates</a><a @if(Request::segment(1) == 'mentors') class="active" @endif href="/mentors"><span class="fa fa-stack-overflow"></span> Mentors</a><a @if(Request::segment(1) == 'employers') class="active" @endif href="/employers"><span class="fa fa-building"></span> Employers</a>
                </div>
            </div>
        </div>
    </nav>

@endif
