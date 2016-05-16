@extends('layout')
@section('title', 'Employers')

@section('content')

    @include('components.nav', [ 'home' => false ])

    <section id="employers" class="content background-white p2-top p4-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <section id="partners" class="m2-bottom">
                        <h3 class="p1-top m0" @include('edit', ['key' => 'employers_partners_title'])>{!! $employers_partners_title !!}</h3>
                        <hr>
                        <div class="p2-top p2-bottom" @include('edit', ['key' => 'employers_partners_images'])>
                            {!! $employers_partners_images !!}
                        </div>
                        <hr>
                    </section>
                    <section id="why" class="m0-top m2-bottom">
                        <h3 class="p1-top m0" @include('edit', ['key' => 'employers_why_title'])>{!! $employers_why_title !!}</h3>
                        <hr>
                        <div @include('edit', ['key' => 'employers_why_desc'])>
                            {!! $employers_why_desc !!}
                        </div>
                        <hr>
                    </section>
                    <h3 class="form-title" id="form">Learn more</h3>
                    <section class="employer-form inset">
                        @if(Session::has('success'))
                            <div class="inset">
                                <p class="m0"><span class="fa fa-check success"></span> Thank you for your interest in Code Louisville. We&rsquo;ll be in contact soon.</p>
                            </div>
                        @else
                            <validator name="employer">
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
                                        <div class="col-sm-4">
                                            <label>
                                                <p>Organization</p>
                                                <input type="text" name="organization" v-validate:organization="['required']">
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>
                                                <p>Message</p>
                                                <textarea name="message" v-validate:message="['required']"></textarea>
                                            </label>
                                        </div>
                                    </div>
                                    <div v-if="$employer.valid">
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
                    <nav class="subnav" data-spy="affix" data-offset-top="83" data-offset-bottom="753">
                        <h1 class="m0">{{ $title }}</h1>
                        <ul class="nav">
                            <li><a href="#partners">Partners</a></li>
                            <li><a href="#why">Why partner?</a></li>
                            <li><a href="#form">Learn more</a></li>
                            <li><a href="/employers/graduates" class="button pink">Graduate List</a></li>
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
            el: '#employers',
            methods: {
                onReset: function () {
                    this.$resetValidation()
                }
            }
        })
    </script>

@endsection
