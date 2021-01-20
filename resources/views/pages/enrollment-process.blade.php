@extends('layout')
@section('title', 'Learn')

@section('content')

    @include('components.nav', [ 'home' => false ])

    <section id="candidates" class="content background-white p2-top p4-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <section id="main" class="m2-bottom">
                        <h3 class="p1-top m0" @include('edit', ['key' => 'enrollment_main_title'])>{!! $enrollment_main_title !!}</h3>
                        <hr>
                        <div @include('edit', ['key' => 'enrollment_main_desc'])>{!! $enrollment_main_desc !!}</div>
                    </section>
                    <section id="questions" class="faqs m2-top m2-bottom">
                        <hr>
                        <h3 class="m0" @include('edit', ['key' => 'enrollment_questions_title'])>{!! $enrollment_questions_title !!}</h3>
                        <hr>
                        <div @include('edit', ['key' => 'enrollment_questions_desc'])>{!! $enrollment_questions_desc !!}</div>
                    </section>
                </div>
                <div class="col-sm-3">
                    <nav class="subnav" data-spy="affix" data-offset-top="83" data-offset-bottom="752">
                        <h1 class="m0">{{ $title }}</h1>
                        <ul class="nav">
                            <li><a href="#main">Main</a></li>
                            <li><a href="#questions">FAQs</a></li>
                            <li><a href="/learn/apply" class="button pink" onclick="fbq('trackCustom', 'ClickApplyButton')"><i class="fa fa-clipboard"></i><span>Apply</span><span>Apply</span></a></li>
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
