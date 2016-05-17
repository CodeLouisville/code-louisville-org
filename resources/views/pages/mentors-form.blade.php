@extends('layout')
@section('title', 'Mentors')

@section('content')

    @include('components.nav', [ 'home' => false ])

    <section id="mentors" class="content background-white p2-top p4-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    @if(Session::has('success')) <div class="alert alert-info">{{ Session::get('success') }}</div> @endif
                    <h3 class="form-title" id="form">@if(isset($mentor)) Edit @else Add @endif Mentor</h3>
                    <section class="mentor-form inset">
                        <validator name="mentor">
                            <form method="POST">
                                @if(isset($mentor)) <input type="hidden" name="_method" value="PUT"> @endif
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>
                                            <p>First name</p>
                                            <input type="text" name="first" value="@if(isset($mentor)){{ $mentor->first }}@endif" v-validate:first="['required']">
                                        </label>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>
                                            <p>Last name</p>
                                            <input type="text" name="last" value="@if(isset($mentor)){{ $mentor->last }}@endif" v-validate:last="['required']">
                                        </label>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>
                                            <p>Status</p>
                                        </label>
                                        <input type="radio" name="active" value="1" @if (isset($mentor) && $mentor->active == 1) checked @endif> Active &nbsp;&nbsp; <input type="radio" name="active" value="0" @if (isset($mentor) && $mentor->active != 1) checked @endif> Inactive</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <span class="fa fa-linkedin-square fa-2x"></span>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="linkedin" value="@if(isset($mentor)){{ $mentor->linkedin }}@endif">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <span class="fa fa-github-square fa-2x"></span>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="github" value="@if(isset($mentor)){{ $mentor->github }}@endif">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <span class="fa fa-twitter-square fa-2x"></span>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="twitter" value="@if(isset($mentor)){{ $mentor->twitter }}@endif">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>
                                            <p>Track</p>
                                            <select name="track">
                                                <option value="js" @if (isset($mentor) && $mentor->track == 'js') selected @endif>Full-stack Javascript</option>
                                                <option value="front" @if (isset($mentor) && $mentor->track == 'front') selected @endif>Front-end</option>
                                                <option value="php" @if (isset($mentor) && $mentor->track == 'php') selected @endif>PHP</option>
                                                <option value="dotnet" @if (isset($mentor) && $mentor->track == 'dotnet') selected @endif>.NET</option>
                                                <option value="ruby" @if (isset($mentor) && $mentor->track == 'ruby') selected @endif>Ruby</option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>
                                            <p>Night</p>
                                            <select name="night">
                                                <option value="Monday" @if (isset($mentor) && $mentor->night == 'Monday') selected @endif>Monday</option>
                                                <option value="Tuesday" @if (isset($mentor) && $mentor->night == 'Tuesday') selected @endif>Tuesday</option>
                                                <option value="Wednesday" @if (isset($mentor) && $mentor->night == 'Wednesday') selected @endif>Wednesday</option>
                                                <option value="Thursday" @if (isset($mentor) && $mentor->night == 'Thursday') selected @endif>Thursday</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div v-if="$mentor.valid">
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <button type="submit" class="button button-block pink">@if (isset($mentor)) Update @else Save @endif</button>
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
                            <li><a href="/mentors"><span class="fa fa-arrow-left"></span> Back to Mentors</a></li>
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
