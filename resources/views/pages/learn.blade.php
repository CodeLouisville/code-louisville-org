@extends('layout')
@section('title', 'Learn')

@section('content')

    @include('components.nav', [ 'home' => false ])

    <section id="candidates" class="content background-white p2-top p4-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <section id="upcoming" class="m2-bottom">
                        <h3 class="p1-top m0" @include('edit', ['key' => 'learn_upcoming_title'])>{!! $learn_upcoming_title !!}</h3>
                        <hr>
                        <div @include('edit', ['key' => 'learn_upcoming_sessions'])>{!! $learn_upcoming_sessions !!}</div>
                        <hr>
                        <div @include('edit', ['key' => 'learn_upcoming_desc'])>{!! $learn_upcoming_desc !!}</div>
                    </section>
                    <section id="structure" class="m2-bottom">
                        <hr>
                        <h3 class="m0" @include('edit', ['key' => 'learn_program_title'])>{!! $learn_program_title !!}</h3>
                        <hr>
                        <div @include('edit', ['key' => 'learn_program_desc'])>{!! $learn_program_desc !!}</div>
                    </section>
                    <section id="pricing" class="m2-top m2-bottom">
                        <hr>
                        <h3 class="m0" @include('edit', ['key' => 'learn_pricing_title'])>{!! $learn_pricing_title !!}</h3>
                        <hr>
                        <div @include('edit', ['key' => 'learn_pricing_desc'])>{!! $learn_pricing_desc !!}</div>
                    </section>
                    <section id="questions" class="faqs m2-top m2-bottom">
                        <hr>
                        <h3 class="m0" @include('edit', ['key' => 'learn_questions_title'])>{!! $learn_questions_title !!}</h3>
                        <hr>
                        <div @include('edit', ['key' => 'learn_questions_desc'])>{!! $learn_questions_desc !!}</div>
                    </section>
                </div>
                <div class="col-sm-3">
                    <nav class="subnav" data-spy="affix" data-offset-top="83" data-offset-bottom="752">
                        <h1 class="m0">{{ $title }}</h1>
                        <ul class="nav">
                            <li><a href="#upcoming">Upcoming sessions</a></li>
                            <li><a href="#structure">Program structure</a></li>
                            <li><a href="#pricing">Pricing</a></li>
                            <li><a href="#questions">FAQs</a></li>
                            <li><a href="/learn/apply" class="button pink"><i class="fa fa-clipboard"></i><span>Apply</span><span>Apply</span></a></li>
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
