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
                                            <p>First name</p>
                                            <input type="text" name="name" value="@if(isset($grad)){{ $grad->name }}@endif" v-validate:name="['required']">
                                        </label>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>
                                            <p>Email</p>
                                            <input type="text" name="email" value="@if(isset($grad)){{ $grad->email }}@endif" v-validate:email="['required','email']">
                                        </label>
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
                                                <input type="text" name="linkedin" value="@if(isset($grad)){{ $grad->linkedin }}@endif" v-validate:name="['required']">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <span class="fa fa-github-square fa-2x"></span>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="github" value="@if(isset($grad)){{ $grad->github }}@endif" v-validate:name="['required']">
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
                            <li><a href="/employers/graduates"><span class="fa fa-arrow-left"></span> Back to Graduates</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')

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
