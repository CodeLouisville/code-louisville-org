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
                    </section>
                    @if ($error)
                        <div class="alert alert-danger">There was an error with submitting your form. Please try again later.</div>
                    @endif
                    <h3 class="form-title" id="enrollment">Application Form</h3>
                    @if ($secure == 'true')
                        <section class="enrollment-form inset">
                            @if (env('APPLY_LIVE') == 'true')
                                <div id="uu-container" class="m1-top" style="height:1000px;"></div>
                                <script src="https://widgets.uniteus.io/public/widget.js"></script>
                                <script>
                                    // rwCgMGIns9neas-DZ16qnsqC-Y682cxfcdxgFV5G
                                    window.Uniteus.assistanceRequestWidget('x7_QV06JBb7h77E0aN8v46iqe1SLtmQA8yMTV2ro')
                                </script>
                            @else
                                Applications are temporarily on hold. We expect to be accepting new applications within a week; please check back soon.
                            @endif
                        </section>
                    @else
                        <section class="enrollment-form inset">
                            <p class="m0">Application is down. Please check back soon, we&rsquo;re working hard to fix this issue.</p>
                        </section>
                    @endif
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

@section('vue')

    @include('components.vue')

    <script>
        const vm = new Vue({
            el: '#enroll',
            data: {
                locLou: 0,
                locJeff: 0,
                locLaGrange: 0,
                codeOfConduct: 0,
                submitted: false
            },
            computed: {
                coc: function () {
                    return this.codeOfConduct == true ? true : null
                },
                location: function () {
                    if (this.locLou || this.locJeff || this.locLaGrange) {
                        return 'yes'
                    } else {
                        return ''
                    }
                },
                race: function () {
                    if (this.amerIndian || this.asian || this.black || this.white || this.islander || this.didNotIdentifyRace) {
                        return 'yes'
                    } else {
                        return ''
                    }
                },
                recTANF: function () {
                    return this.tRecTANF ? 'Y' : 'N'
                },
                recGeneralAsst: function () {
                    return this.tRecGeneralAsst ? 'Y' : 'N'
                },
                recOther: function () {
                    return this.tRecOther ? 'Y' : 'N'
                }
            },
            methods: {
                onReset: function () {
                    this.$resetValidation()
                }
            }
        })
    </script>

@endsection
