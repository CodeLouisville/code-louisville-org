@extends('layout')
@section('title', 'Mentor')

@section('content')

    @include('components.nav', [ 'home' => false ])

    <section id="mentors" class="content background-white p2-top p4-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <section id="who" class="m2-bottom">
                        <h3 class="p1-top m0" @include('edit', ['key' => 'mentor_who_title'])>{!! $mentor_who_title !!}</h3>
                        <hr>
                        <div @include('edit', ['key' => 'mentor_who_desc'])>{!! $mentor_who_desc !!}</div>
                    </section>
                    <section id="what" class="m2-top m2-bottom">
                        <hr>
                        <h3 class="m0" @include('edit', ['key' => 'mentor_what_title'])>{!! $mentor_what_title !!}</h3>
                        <hr>
                        <div @include('edit', ['key' => 'mentor_what_desc'])>{!! $mentor_what_desc !!}</div>
                    </section>
                    <section id="tech" class="m2-top m2-bottom">
                        <hr>
                        <h3 class="m0" @include('edit', ['key' => 'mentor_tech_title'])>{!! $mentor_tech_title !!}</h3>
                        <hr>
                        <div @include('edit', ['key' => 'mentor_tech_desc'])>{!! $mentor_tech_desc !!}</div>
                    </section>
                    <div id="current" class="profiles" class="m2-top m2-bottom">
                        <hr>
                        @if (Auth::check() && Auth::user()->admin) <a href="/mentor/add" class="button small pink pull-right">Add mentor</a> @endif
                        <h3 class="m0">Current mentors</h3>
                        <hr>
                        <div class="row">
                            @foreach ($mentors as $mentor)
                                @if ( $mentor->active == 1 || ( Auth::check() && Auth::user()->admin ) )
                                    <div class="col-md-2 col-sm-3 col-xs-4">
                                        <div class="card text-center @if ($mentor->active == 0) inactive @endif">
                                            @if(Auth::check())
                                                @if (Auth::user()->admin)
                                                    <a class="edit-profile pink" href="/mentor/edit/{{ $mentor->id }}"> <span class="fa fa-edit"></span></a>
                                                @elseif ($mentor->github_id == Auth::user()->github_id)
                                                    <a class="edit-profile pink" href="/mentor/edit/{{ $mentor->id }}"> <span class="fa fa-edit"></span></a>
                                                @endif
                                            @endif
                                            @if ($mentor->github)
                                                <img class="photo" src="https://github.com/{{ $mentor->github }}.png" alt="{{ $mentor->name }}">
                                            @else
                                                <img class="photo" src="https://deppclvsgi2as.cloudfront.net/assets/img/default-person.png" alt="{{ $mentor->name }}">
                                            @endif
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
                    <section id="questions" class="faqs m2-top m2-bottom">
                        <hr>
                        <h3 class="m0" @include('edit', ['key' => 'mentor_questions_title'])>{!! $mentor_questions_title !!}</h3>
                        <hr>
                        <div @include('edit', ['key' => 'mentor_questions_desc'])>{!! $mentor_questions_desc !!}</div>
                    </section>
                    <hr>
                    <h3 class="form-title anchor" id="form">Become a mentor</h3>
                    <section class="mentor-form inset">
                        @if(Session::has('success'))
                            <div class="inset">
                                <p class="m0"><span class="fa fa-check success"></span> Thank you for your interest in Code Louisville. We&rsquo;ll be in contact soon.</p>
                            </div>
                        @else
                            <div class="inset" @include('edit', ['key' => 'mentor_form_desc'])>{!! $mentor_form_desc !!}</div>
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
                                                    <option value="Javascript" selected>Full-stack Javascript</option>
                                                    <option value=".NET">.NET</option>
                                                    <option value="PHP">PHP</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p>Which day(s) are you available to mentor?</p>
                                            <p v-if="track == 'Javascript'"><input type="checkbox" name="availability[]" value="M" v-validate:availability="['required']"> &nbsp; Monday</p>
                                            <p><input type="checkbox" name="availability[]" value="T" v-validate:availability> &nbsp; Tuesday</p>
                                            <p v-if="track == 'Javascript'"><input type="checkbox" name="availability[]" value="W" v-validate:availability> &nbsp; Wednesday</p>
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
                            <li><a href="#questions">FAQs</a></li>
                            <li><a href="#form" class="button pink"><i class="fa fa-clipboard"></i><span>Sign up</span><span>Become a Mentor</span></a></li>
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
