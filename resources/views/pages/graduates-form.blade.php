@extends('layout')
@section('title', 'Graduates')

@section('content')

    @include('components.nav', [ 'home' => false ])

    <section id="graduates" class="content background-white p2-top p4-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    @if(Session::has('success')) <div class="alert alert-info">{{ Session::get('success') }}</div> @endif
                    <h3 class="form-title" id="form">@if(isset($grad)) Edit @else Add @endif Graduate</h3>
                    <section class="grad-form inset">
                        <validator name="grad">
                            <form method="POST">
                                @if(isset($grad)) <input type="hidden" name="_method" value="PUT"> @endif
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>
                                            <p>Name</p>
                                            <input type="text" name="name" value="@if(isset($grad)){{ $grad->name }}@endif" v-validate:name="['required']">
                                        </label>
                                    </div>
                                    <div class="col-sm-6 col-sm-offset-2 grad-cohort">
                                        <p class="m1-bottom">Cohorts</p>
                                        <div>
                                            <input type="hidden" name="front_end" value="@{{ front_end }}">
                                            <label><input type="checkbox" v-model="front_end" v-bind:true-value="1" v-bind:false-value="0" @if(isset($grad) && $grad->front_end == 1) checked @endif><i data-toggle="tooltip" data-placement="bottom" title="" class="devicon-html5-plain colored" data-original-title="Front End"></i></label>
                                            <input type="hidden" name="full_stack_js" value="@{{ full_stack_js }}">
                                            <label><input type="checkbox" v-model="full_stack_js" v-bind:true-value="1" v-bind:false-value="0" @if(isset($grad) && $grad->full_stack_js == 1) checked @endif><i data-toggle="tooltip" data-placement="bottom" title="" class="devicon-javascript-plain colored" data-original-title="Javascript"></i></label>
                                            <input type="hidden" name="php" value="@{{ php }}">
                                            <label><input type="checkbox" v-model="php" v-bind:true-value="1" v-bind:false-value="0" @if(isset($grad) && $grad->php == 1) checked @endif><i data-toggle="tooltip" data-placement="bottom" title="" class="devicon-php-plain colored" data-original-title="PHP"></i></label>
                                            <input type="hidden" name="dot_net" value="@{{ dot_net }}">
                                            <label><input type="checkbox" v-model="dot_net" v-bind:true-value="1" v-bind:false-value="0" @if(isset($grad) && $grad->dot_net == 1) checked @endif><i data-toggle="tooltip" data-placement="bottom" title="" class="devicon-dot-net-plain colored" data-original-title=".NET"></i></label>
                                            <input type="hidden" name="rails" value="@{{ rails }}">
                                            <label><input type="checkbox" v-model="rails" v-bind:true-value="1" v-bind:false-value="0" @if(isset($grad) && $grad->rails == 1) checked @endif><i data-toggle="tooltip" data-placement="bottom" title="" class="devicon-rails-plain colored" data-original-title="Ruby on Rails"></i></label>
                                            <input type="hidden" name="ios" value="@{{ ios }}">
                                            <label><input type="checkbox" v-model="ios" v-bind:true-value="1" v-bind:false-value="0" @if(isset($grad) && $grad->ios == 1) checked @endif><i data-toggle="tooltip" data-placement="bottom" title="" class="devicon-apple-plain colored" data-original-title="iOS"></i></label>
                                            <input type="hidden" name="android" value="@{{ android }}">
                                            <label><input type="checkbox" v-model="android" v-bind:true-value="1" v-bind:false-value="0" @if(isset($grad) && $grad->android == 1) checked @endif><i data-toggle="tooltip" data-placement="bottom" title="" class="devicon-android-plain colored" data-original-title="Android"></i></label>
                                            <input type="hidden" name="python" value="@{{ python }}">
                                            <label><input type="checkbox" v-model="python" v-bind:true-value="1" v-bind:false-value="0" @if(isset($grad) && $grad->python == 1) checked @endif><i data-toggle="tooltip" data-placement="bottom" title="" class="devicon-python-plain colored" data-original-title="Python"></i></label>
                                            <input type="hidden" name="java" value="@{{ java }}">
                                            <label><input type="checkbox" v-model="java" v-bind:true-value="1" v-bind:false-value="0" @if(isset($grad) && $grad->java == 1) checked @endif><i data-toggle="tooltip" data-placement="bottom" title="" class="devicon-java-plain colored" data-original-title="Java"></i></label>
                                            <input type="hidden" name="groupproject" value="@{{ groupproject }}">
                                            <label><input type="checkbox" v-model="groupproject" v-bind:true-value="1" v-bind:false-value="0" @if(isset($grad) && $grad->groupproject == 1) checked @endif><i data-toggle="tooltip" data-placement="bottom" title="" class="fa fa-users" data-original-title="Group Project"></i></label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>
                                            <p>Email</p>
                                            <input type="text" name="email" value="@if(isset($grad)){{ $grad->email }}@endif" v-validate:email="['required','email']">
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <p>Last cohort</p>
                                        <input type="hidden" name="cohort_date" value="@{{ month }} @{{ year }}">
                                        <select name="cohort_month" v-model="month" v-validate:cohortmonth="['required']">
                                            <option value="January" @if(isset($grad) && $grad->cohort_month == 'January') selected @endif>January</option>
                                            <option value="February" @if(isset($grad) && $grad->cohort_month == 'February') selected @endif>February</option>
                                            <option value="March" @if(isset($grad) && $grad->cohort_month == 'March') selected @endif>March</option>
                                            <option value="April" @if(isset($grad) && $grad->cohort_month == 'April') selected @endif>April</option>
                                            <option value="May" @if(isset($grad) && $grad->cohort_month == 'May') selected @endif>May</option>
                                            <option value="June" @if(isset($grad) && $grad->cohort_month == 'June') selected @endif>June</option>
                                            <option value="July" @if(isset($grad) && $grad->cohort_month == 'July') selected @endif>July</option>
                                            <option value="August" @if(isset($grad) && $grad->cohort_month == 'August') selected @endif>August</option>
                                            <option value="September" @if(isset($grad) && $grad->cohort_month == 'September') selected @endif>September</option>
                                            <option value="October" @if(isset($grad) && $grad->cohort_month == 'October') selected @endif>October</option>
                                            <option value="November" @if(isset($grad) && $grad->cohort_month == 'November') selected @endif>November</option>
                                            <option value="December" @if(isset($grad) && $grad->cohort_month == 'December') selected @endif>December</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <p>&nbsp;</p>
                                        <select name="cohort_year" v-model="year" v-validate:cohortyear="['required']">
                                            <option value="2013" @if(isset($grad) && $grad->cohort_year == '2013') selected @endif>2013</option>
                                            <option value="2014" @if(isset($grad) && $grad->cohort_year == '2014') selected @endif>2014</option>
                                            <option value="2015" @if(isset($grad) && $grad->cohort_year == '2015') selected @endif>2015</option>
                                            <option value="2016" @if(isset($grad) && $grad->cohort_year == '2016') selected @endif>2016</option>
                                            <option value="2017" @if(isset($grad) && $grad->cohort_year == '2017') selected @endif>2017</option>
                                            <option value="2018" @if(isset($grad) && $grad->cohort_year == '2018') selected @endif>2018</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p>Social</p>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <span class="fa fa-linkedin-square fa-2x"></span>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="linkedin" value="@if(isset($grad)){{ $grad->linkedin }}@endif" v-validate:linkedin="['required']">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <p>&nbsp;</p>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <span class="fa fa-github-square fa-2x"></span>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="github" value="@if(isset($grad)){{ $grad->github }}@endif" v-validate:github="['required']">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="$grad.valid">
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <button type="submit" class="button button-block pink">@if (isset($grad)) Update @else Save @endif</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </validator>
                    </section>
                </div>
                <div class="col-sm-3">
                    <nav class="subnav" data-spy="affix" data-offset-top="83" data-offset-bottom="666">
                        <h1 class="m0-top m0-bottom">{{ $title }}</h1>
                        <ul class="nav">
                            <li><a href="/hire/graduates"><span class="fa fa-arrow-left"></span> Back to Graduates</a></li>
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
            el: '#graduates',
            methods: {
                onReset: function () {
                    this.$resetValidation()
                }
            }
        })
    </script>

@endsection
