@extends('layout')
@section('title', 'Mentors')

@section('content')

    @include('components.nav', [ 'home' => false ])

    <section id="mentors" class="content background-white p2-top p4-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <section id="who">
                        <h3 class="p1-top m0" @include('edit', ['key' => 'mentors_who_title'])>{!! $mentors_who_title !!}</h3>
                        <hr>
                        <div @include('edit', ['key' => 'mentors_who_desc'])>
                            {!! $mentors_who_desc !!}
                        </div>
                        <hr>
                    </section>
                    <section id="what">
                        <h3 class="p1-top m0" @include('edit', ['key' => 'mentors_what_title'])>{!! $mentors_what_title !!}</h3>
                        <hr>
                        <div @include('edit', ['key' => 'mentors_what_desc'])>
                            {!! $mentors_what_desc !!}
                        </div>
                        <hr>
                    </section>
                    <section id="tech">
                        <h3 class="p1-top m0">Technologies</h3>
                        <hr>
                        <p>At the moment, Code Louisville is offering two tracks:</p>
                        <div class="inset m2-bottom">
                            <h4 class="m0">Full-stack Javascript <small class="m1-left">Monday, Tuesday, Wednesday, Thursday</small></h4>
                        </div>
                        <div class="icons">
                            <div class="row">
                                <div class="col-lg-2 col-sm-4 col-xs-4 col-xxs-6"><i data-toggle="tooltip" data-placement="bottom" title="" class="devicon-javascript-plain colored" data-original-title="Javascript"></i></div>
                                <div class="col-lg-2 col-sm-4 col-xs-4 col-xxs-6"><i data-toggle="tooltip" data-placement="bottom" title="" class="devicon-mongodb-plain colored" data-original-title="MongoDB"></i></div>
                                <div class="col-lg-2 col-sm-4 col-xs-4 col-xxs-6"><i data-toggle="tooltip" data-placement="bottom" title="" class="devicon-angularjs-plain colored" data-original-title="AngularJS"></i></div>
                                <div class="col-lg-2 col-sm-4 col-xs-4 col-xxs-6"><i data-toggle="tooltip" data-placement="bottom" title="" class="devicon-nodejs-plain colored" data-original-title="NodeJS"></i></div>
                            </div>
                        </div>
                        <div class="inset m2-bottom">
                            <h4 class="m0">PHP <small class="m1-left">Tuesday, Thursday</small></h4>
                        </div>
                        <div class="icons">
                            <div class="row">
                                <div class="col-lg-2 col-sm-4 col-xs-4 col-xxs-6"><i data-toggle="tooltip" data-placement="bottom" title="" class="devicon-php-plain colored" data-original-title="PHP"></i></div>
                            </div>
                        </div>
                        <hr>
                    </section>
                    <div id="current" class="profiles">
                        @if (Auth::check() && Auth::user()->admin) <span class="pull-right"><a href="/mentors/add" class="button small pink m1-top"><span class="fa fa-plus"></span> Add mentor</a></span> @endif
                        <h3 class="p1-top m0">Current mentors</h3>
                        <hr>
                        <div class="row">
                            @foreach ($mentors as $mentor)
                                @if ( Auth::check() && ( Auth::user()->admin || $mentor->active == 1 ) )
                                    <div class="col-sm-2">
                                        <div class="card text-center @if ($mentor->active == 0) inactive @endif">
                                            @if(Auth::check())
                                                @if (Auth::user()->admin)
                                                    <a class="edit-profile pink" href="/mentors/edit/{{ $mentor->id }}"> <span class="fa fa-edit"></span></a>
                                                @elseif ($mentor->github_id == Auth::user()->github_id)
                                                    <a class="edit-profile pink" href="/mentors/edit/{{ $mentor->id }}"> <span class="fa fa-edit"></span></a>
                                                @endif
                                            @endif
                                            <img class="photo" src="@if ($mentor->github) https://github.com/{{ $mentor->github }}.png @else /assets/img/default-person.png @endif" alt="{{ $mentor->name }}">
                                            <div class="info">
                                                <div>
                                                    <h4 class="name">{{ $mentor->first }} <small>{{ $mentor->last }}</small></h4>
                                                    @if ($mentor->linkedin) <a href="https://www.linkedin.com/in/{{ $mentor->linkedin }}" target="_blank"><span class="fa fa-linkedin-square"></span></a> @endif
                                                    @if ($mentor->github) <a href="https://github.com/{{ $mentor->github }}" target="_blank"> <span class="fa fa-github-square"></span></a> @endif
                                                    @if ($mentor->twitter) <a href="https://twitter.com/{{ $mentor->twitter }}" target="_blank"> <span class="fa fa-twitter-square"></span></a> @endif
                                                </div>
                                                <div>
                                                    @if ($mentor->track == 'js')
                                                        <h4 class="name">Javascript <small>{{ $mentor->night }}</small></h4>
                                                        <a><span class="devicon-javascript-plain colored"></span></a>
                                                        <a><span class="devicon-nodejs-plain colored"></span></a>
                                                    @elseif ($mentor->track == 'front')
                                                        <h4 class="name">Front-end <small>{{ $mentor->night }}</small></h4>
                                                        <a><span class="devicon-html5-plain-wordmark colored"></span></a>
                                                        <a><span class="devicon-css3-plain-wordmark colored"></span></a>
                                                        <a><span class="devicon-javascript-plain colored"></span></a>
                                                    @elseif ($mentor->track == 'ruby')
                                                        <h4 class="name">Ruby <small>{{ $mentor->night }}</small></h4>
                                                        <a><span class="devicon-rails-plain colored"></span></a>
                                                    @elseif ($mentor->track == 'php')
                                                        <h4 class="name">PHP <small>{{ $mentor->night }}</small></h4>
                                                        <a><span class="devicon-php-plain colored"></span></a>
                                                    @elseif ($mentor->track == 'dotnet')
                                                        <h4 class="name">.NET <small>{{ $mentor->night }}</small></h4>
                                                        <a><span class="devicon-dot-net-plain colored"></span></a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    <h3 class="form-title" id="form">Become a mentor</h3>
                    <section class="mentor-form inset">
                        @if(Session::has('success'))
                            <div class="inset">
                                <p class="m0"><span class="fa fa-check success"></span> Thank you for your interest in Code Louisville. We&rsquo;ll be in contact soon.</p>
                            </div>
                        @else
                            <div class="inset" @include('edit', ['key' => 'mentors_form_desc'])>
                                {!! $mentors_form_desc !!}
                            </div>
                            <hr>
                            <validator name="mentor">
                                <form method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>
                                                <p>Name</p>
                                                <input type="text" name="name" v-validate:name="['required']">
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>
                                                <p>Email address</p>
                                                <input type="text" name="email" v-validate:email="['required','email']">
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>
                                                <p>Which track would you like to mentor?</p>
                                                <select name="track" v-model="track">
                                                    <option value="js" selected>Full-stack Javascript</option>
                                                    <option value="PHP">PHP</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p>Which day(s) are you available to mentor?</p>
                                            <p v-if="track == 'js'"><input type="checkbox" name="availability[]" value="M" v-validate:availability="['required']"> &nbsp; Monday</p>
                                            <p><input type="checkbox" name="availability[]" value="T" v-validate:availability> &nbsp; Tuesday</p>
                                            <p v-if="track == 'js'"><input type="checkbox" name="availability[]" value="W" v-validate:availability> &nbsp; Wednesday</p>
                                            <p><input type="checkbox" name="availability[]" value="Th" v-validate:availability> &nbsp; Thursday</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>
                                                <p>How long have you been a developer?</p>
                                                <input type="text" name="experience" v-validate:experience="['required']">
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>
                                                <p>Current employer?</p>
                                                <input type="text" name="employer" v-validate:employer="['required']">
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>
                                                <p>Do you have any questions for us?</p>
                                                <textarea name="questions"></textarea>
                                            </label>
                                        </div>
                                    </div>
                                    <div v-if="$mentor.valid">
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <button type="submit" class="button button-block pink">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </validator>
                        @endif
                    </section>
                </div>
                <div class="col-sm-3">
                    <nav class="subnav" data-spy="affix" data-offset-top="83" data-offset-bottom="752">
                        <h1 class="m0-top m0-bottom">{{ $title }}</h1>
                        <ul class="nav">
                            <li><a href="#who">What is a mentor?</a></li>
                            <li><a href="#what">What does it take?</a></li>
                            <li><a href="#tech">Technologies</a></li>
                            <li><a href="#current">Current mentors</a></li>
                            <li><a href="#form" class="button pink">Become a Mentor</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('vue')

    @include('components.vue')

    <script>
        new Vue({
            el: '#mentors',
            methods: {
                onReset: function () {
                    this.$resetValidation()
                }
            }
        })
    </script>

@endsection
