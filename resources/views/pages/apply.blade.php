@extends('layout')
@section('title', 'Application Form')

@section('content')

    @include('components.nav', [ 'home' => false ])

    <section id="enroll" class="content background-white p2-top p4-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <section id="structure" class="m2-bottom">
                        <h3 class="m0" @include('edit', ['key' => 'apply_intro_title'])>{!! $apply_intro_title !!}</h3>
                        <hr>
                        <div @include('edit', ['key' => 'apply_intro_desc'])>{!! $apply_intro_desc !!}</div>
                        <div class="apply-now">
                          <button type="button" class="button pink" onclick="window.open('https://docs.google.com/forms/d/e/1FAIpQLSdXlC-rsEQBbNgmTiJlbwWVWYXbrfJGziyP3p0NoY-zzN2Jgg/viewform?usp=sf_link')">Apply Now</button>
                        </div>
                    </section>
                </div>
                <div class="col-sm-3">
                    <nav class="subnav" data-spy="affix" data-offset-top="83" data-offset-bottom="752">
                        <h1 class="m0">{{ $title }}</h1>
                        <ul class="nav">
                            <li><a href="/learn"><span class="fa fa-arrow-left"></span> Back to Learn</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

@endsection