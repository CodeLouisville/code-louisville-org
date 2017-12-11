@extends('layout')
@section('content')

    <header class="hero center p5-top p5-bottom">
        <video autoplay loop width="100%">
            <source type="video/mp4" src="{{ env('CLOUDFRONT') }}/assets/vid/code.mp4">
        </video>
        <div class="vid-overlay"></div>
        <div class="container">
            <img class="cl-logo" src="{{ env('CLOUDFRONT') }}/assets/img/code-louisville-white.svg" alt="Code Louisville">
            <div>
                <a href="#intro" class="button button-large white m1-right">Tell me more</a><a href="/learn#upcoming" class="button button-large pink">Sign up today</a>
            </div>
        </div>
    </header>

    @include('components.nav', [ 'home' => true ])

    <section id="intro" class="about background-white p4-top p4-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="weak m0-top m0-bottom" @include('edit', ['key' => 'home_info_title'])>{!! $home_info_title !!}</h3>
                    <h2 class="m0-top" @include('edit', ['key' => 'home_info_title2'])>{!! $home_info_title2 !!}</h2>
                    <p class="m1-top m1-bottom" @include('edit', ['key' => 'home_info_p1'])>{!! $home_info_p1 !!}</p>
                    <p class="m1-top m0-bottom" @include('edit', ['key' => 'home_info_p2'])>{!! $home_info_p2 !!}</p>
                </div>
                <div class="col-sm-6 icons">
                    <div class="row">
                        <div class="col-lg-3 col-sm-4 col-xs-4 col-xxs-6 m3-bottom"><i data-toggle="tooltip" data-placement="bottom" title="HTML5" class="devicon-html5-plain-wordmark colored"></i></div>
                        <div class="col-lg-3 col-sm-4 col-xs-4 col-xxs-6 m3-bottom"><i data-toggle="tooltip" data-placement="bottom" title="CSS3" class="devicon-css3-plain-wordmark colored"></i></div>
                        <div class="col-lg-3 col-sm-4 col-xs-4 col-xxs-6 m3-bottom"><i data-toggle="tooltip" data-placement="bottom" title="Javascript" class="devicon-javascript-plain colored"></i></div>
                        <div class="col-lg-3 col-sm-4 col-xs-4 col-xxs-6 m3-bottom"><i data-toggle="tooltip" data-placement="bottom" title="jQuery" class="devicon-jquery-plain colored"></i></div>
                        <div class="col-lg-3 col-sm-4 col-xs-4 col-xxs-6 m3-bottom"><i data-toggle="tooltip" data-placement="bottom" title="AngularJS" class="devicon-angularjs-plain colored"></i></div>
                        <div class="col-lg-3 col-sm-4 col-xs-4 col-xxs-6 m3-bottom"><i data-toggle="tooltip" data-placement="bottom" title="NodeJS" class="devicon-nodejs-plain colored"></i></div>
                        <div class="col-lg-3 col-sm-4 col-xs-4 col-xxs-6 m3-bottom"><i data-toggle="tooltip" data-placement="bottom" title="MongoDB" class="devicon-mongodb-plain colored"></i></div>
                        <div class="col-lg-3 col-sm-4 col-xs-4 col-xxs-6 m3-bottom"><i data-toggle="tooltip" data-placement="bottom" title="PHP" class="devicon-php-plain colored"></i></div>
                        <div class="col-lg-3 col-sm-4 col-xs-4 col-xxs-6 m3-bottom"><i data-toggle="tooltip" data-placement="bottom" title="Dot Net" class="devicon-dot-net-plain colored"></i></div>
                        <div class="col-lg-3 col-sm-4 col-xs-4 col-xxs-6 m3-bottom"><i data-toggle="tooltip" data-placement="bottom" title="Python" class="devicon-python-plain colored"></i></div>
                        <div class="col-lg-3 col-sm-4 col-xs-4 col-xxs-6 m3-bottom"><i data-toggle="tooltip" data-placement="bottom" title="Swift IOS Development" class="devicon-swift-plain colored"></i></div>
                        <div class="col-lg-3 col-sm-4 col-xs-4 col-xxs-6 m3-bottom"><i data-toggle="tooltip" data-placement="bottom" title="Git" class="devicon-git-plain colored"></i></div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="get-involved center p4-top p4-bottom">
        <div class="container">
            <h2 class="m0-top m4-bottom" @include('edit', ['key' => 'home_get_involved_title'])>{!! $home_get_involved_title !!}</h2>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <span class="fa fa-user pink m2-top"></span>
                        <h2 class="pink weak m2-bottom" @include('edit', ['key' => 'home_get_involved_col1_title'])>{!! $home_get_involved_col1_title !!}</h2>
                        <hr>
                        <p class="left m2-top m2-bottom" @include('edit', ['key' => 'home_get_involved_col1_desc'])>{!! $home_get_involved_col1_desc !!}</p>
                        <div class="right"><a class="button pink" href="/learn">Learn more</a></div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <span class="fa fa-stack-overflow pink m2-top"></span>
                        <h2 class="pink weak m2-bottom" @include('edit', ['key' => 'home_get_involved_col2_title'])>{!! $home_get_involved_col2_title !!}</h2>
                        <hr>
                        <p class="left m2-top m2-bottom" @include('edit', ['key' => 'home_get_involved_col2_desc'])>{!! $home_get_involved_col2_desc !!}</p>
                        <div class="right"><a class="button pink" href="/mentor">Learn more</a></div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <span class="fa fa-building-o pink m2-top"></span>
                        <h2 class="pink weak m2-bottom" @include('edit', ['key' => 'home_get_involved_col3_title'])>{!! $home_get_involved_col3_title !!}</h2>
                        <hr>
                        <p class="left m2-top m2-bottom" @include('edit', ['key' => 'home_get_involved_col3_desc'])>{!! $home_get_involved_col3_desc !!}</p>
                        <div class="right"><a class="button pink" href="/hire">Learn more</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
