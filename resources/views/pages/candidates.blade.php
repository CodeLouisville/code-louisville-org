@extends('layout')
@section('title', 'Candidates')

@section('content')

    @include('components.nav', [ 'home' => false ])

    <section id="candidates" class="content background-white p2-top p4-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <section id="upcoming" class="m0-top m2-bottom">
                        <h3 class="p1-top m0" @include('edit', ['key' => 'candidates_upcoming_title'])>{!! $candidates_upcoming_title !!}</h3>
                        <hr>
                        <div class="inset">
                            <h3 class="m0-top m0-bottom pink">September 2016 &ndash; Full-Stack JavaScript Development</h3>
                            <hr>
                            <div class="icons m0">
                                <div class="row">
                                    <div class="col-lg-2 col-sm-4 col-xs-3 col-xxs-6"><i data-toggle="tooltip" data-placement="bottom" title="" class="devicon-javascript-plain colored" data-original-title="Javascript"></i></div>
                                    <div class="col-lg-2 col-sm-4 col-xs-3 col-xxs-6"><i data-toggle="tooltip" data-placement="bottom" title="" class="devicon-mongodb-plain colored" data-original-title="MongoDB"></i></div>
                                    <div class="col-lg-2 col-sm-4 col-xs-3 col-xxs-6"><i data-toggle="tooltip" data-placement="bottom" title="" class="devicon-angularjs-plain colored" data-original-title="AngularJS"></i></div>
                                    <div class="col-lg-2 col-sm-4 col-xs-3 col-xxs-6"><i data-toggle="tooltip" data-placement="bottom" title="" class="devicon-nodejs-plain colored" data-original-title="NodeJS"></i></div>
                                </div>
                            </div>
                            <hr>
                            <p class="m1-top m0-bottom"><a class="button white" href="#register">Register now</a></p>
                        </div>
                        <hr>
                        <div @include('edit', ['key' => 'candidates_upcoming_desc'])>
                            {!! $candidates_upcoming_desc !!}
                        </div>
                    </section>
                    <hr>
                    <h3 class="form-title" id="eligibility">Eligibility</h3>
                    <section class="eligiblity-form inset m2-bottom">
                        <validator name="eligibility">
                            <p>Please input your zip code</p>
                            <div class="row">
                                <div class="col-sm-2">
                                    <p class="m0"><input type="text" name="zip" v-validate:zip="['required','zip','zipFormat']"></p>
                                    <p class="error m0" v-if="$eligibility.zip.touched&$eligibility.zip.zipFormat">Invalid zip code</p>
                                </div>
                            </div>
                            <hr>
                            <p>Do you have a high school diploma or GED?</p>
                            <p><input type="radio" name="education" value="y" v-validate:education="['required','true']"> Yes &nbsp;&nbsp; <input type="radio" name="education" value="n" v-validate:education> No</p>
                            <hr>
                            <p>Are you legally able to work in the United States?</p>
                            <p><input type="radio" name="work" value="y" v-validate:work="['required','true']"> Yes &nbsp;&nbsp; <input type="radio" name="work" value="n" v-validate:work> No</p>
                            <hr>
                            <p>Do you have access to a laptop (or tablet w/ keyboard) and an internet connection?</p>
                            <p><input type="radio" name="tech" value="y" v-validate:tech="['required','true']"> Yes &nbsp;&nbsp; <input type="radio" name="tech" value="n" v-validate:tech> No</p>
                            <hr>
                            <p>Will you adhere to our <a href="https://drive.google.com/file/d/0B28qs3pVLuXSTGhWbU1JWng0YWM/view" target="_blank">Code of Conduct</a>?</p>
                            <p><input type="radio" name="conduct" value="y" v-validate:conduct="['required','true']"> Yes &nbsp;&nbsp; <input type="radio" name="conduct" value="n" v-validate:conduct> No</p>
                            <div v-if="!$eligibility.zip.required&!$eligibility.zip.zipFormat&!$eligibility.conduct.required&!$eligibility.work.required&!$eligibility.education.required&!$eligibility.tech.required">
                                <hr>
                                <div class="eligibility-result inset">
                                    <p class="m0-bottom" v-if="$eligibility.valid"><span class="fa fa-check fa-2x success"></span> Congratulations, you are eligible to participate in Code Louisville!</p>
                                    <p class="m0-bottom" v-if="$eligibility.invalid"><span class="fa fa-remove fa-2x error"></span> Unfortunately you are not eligible to participate in Code Louisville.</p>
                                </div>
                            </div>
                        </validator>
                    </section>
                    <section id="structure" class="m2-top m2-bottom">
                        <hr>
                        <h3 class="m0" @include('edit', ['key' => 'candidates_program_title'])>{!! $candidates_program_title !!}</h3>
                        <hr>
                        <div @include('edit', ['key' => 'candidates_program_desc'])>
                            {!! $candidates_program_desc !!}
                        </div>
                    </section>
                    <section id="pricing" class="m2-top m2-bottom">
                        <hr>
                        <h3 class="m0" @include('edit', ['key' => 'candidates_pricing_title'])>{!! $candidates_pricing_title !!}</h3>
                        <hr>
                        <div @include('edit', ['key' => 'candidates_pricing_desc'])>
                            {!! $candidates_pricing_desc !!}
                        </div>
                    </section>
                    <section id="questions" class="m2-top m2-bottom">
                        <hr>
                        <h3 class="m0" @include('edit', ['key' => 'candidates_questions_title'])>{!! $candidates_questions_title !!}</h3>
                        <hr>
                        <div @include('edit', ['key' => 'candidates_questions_desc'])>
                            {!! $candidates_questions_desc !!}
                        </div>
                    </section>
                    <h3 class="form-title" id="register">Registration</h3>
                    <section class="registration-form inset">
                        @if(Session::has('success'))
                            <div class="inset">
                                <p class="m0"><span class="fa fa-check success"></span> Thank you for your interest in Code Louisville. We&rsquo;ll be in contact soon.</p>
                            </div>
                        @else
                            <div class="inset" @include('edit', ['key' => 'candidates_form_desc'])>
                                {!! $candidates_form_desc !!}
                            </div>
                            <hr>
                            <validator name="register">
                                <form method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>
                                                <p>First name</p>
                                                <input type="text" name="first" v-validate:first="['required']">
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>
                                                <p>Last name</p>
                                                <input type="text" name="last" v-validate:last="['required']">
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
                                    <p>I am <a href="#eligibility">eligible</a> to participate in Code Louisville</p>
                                    <p><input type="radio" name="eligible" value="y" v-validate:eligible="['required','true']"> Yes &nbsp;&nbsp; <input type="radio" name="eligible" value="n" v-validate:eligible> No</p>
                                    <div v-if="$register.valid">
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
                        <h1 class="m0">{{ $title }}</h1>
                        <ul class="nav">
                            <li><a href="#upcoming">Upcoming sessions</a></li>
                            <li><a href="#eligibility">Eligibility</a></li>
                            <li><a href="#structure">Program structure</a></li>
                            <li><a href="#pricing">Pricing</a></li>
                            <li><a href="#questions">Questions</a></li>
                            <li><a href="#register" class="button pink"><i class="fa fa-clipboard"></i><span>Register</span><span>Register</span></a></li>
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
            el: '#candidates',
            methods: {
                onReset: function () {
                    this.$resetValidation()
                }
            }
        })
    </script>

@endsection
