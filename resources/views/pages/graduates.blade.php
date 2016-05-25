@extends('layout')
@section('title', 'Graduates')

@section('content')

    @include('components.nav', [ 'home' => false ])

    <section id="graduates" class="content background-white p2-top p4-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <section id="graduates" class="m2-bottom">
                        <h3 class="p1-top m0">{{ $title }}</h3>
                        <hr>
                        <table class="table table-bordered table-striped graduates">
                            <thead>
                                <tr>
                                    <th class="grad-name">Name</th>
                                    <th class="grad-email">Email</th>
                                    <th class="grad-connect">Connect</th>
                                    <th class="grad-date">Last Cohort</th>
                                    <th class="grad-cohort"><label><input type="checkbox" v-model="filter" value="front-end"><i data-toggle="tooltip" data-placement="top" title="" class="devicon-html5-plain colored" data-original-title="Front End"></i></label></th>
                                    <th class="grad-cohort"><label><input type="checkbox" v-model="filter" value="js"><i data-toggle="tooltip" data-placement="top" title="" class="devicon-javascript-plain colored" data-original-title="Javascript"></i></label></th>
                                    <th class="grad-cohort"><label><input type="checkbox" v-model="filter" value="php"><i data-toggle="tooltip" data-placement="top" title="" class="devicon-php-plain colored" data-original-title="PHP"></i></label></th>
                                    <th class="grad-cohort"><label><input type="checkbox" v-model="filter" value="net"><i data-toggle="tooltip" data-placement="top" title="" class="devicon-dot-net-plain colored" data-original-title=".NET"></i></label></th>
                                </tr>
                            </thead>
                            <tbody v-bind:class="filter">
                                @foreach($grads as $grad)
                                    <tr class="grad {{ $grad->cohorts }}">
                                        <td class="grad-name">{{ $grad->name }}</td>
                                        <td class="grad-email"><span class="pink">{{ $grad->email }}</span></td>
                                        <td class="grad-connect"><a href="https://github.com/{{ $grad->github }}" target="_blank"><span class="fa fa-github-square"></span></a> &nbsp; <a href="https://www.linkedin.com/in/{{ $grad->linkedin }}" target="_blank"><span class="fa fa-linkedin-square"></span></a></td>
                                        <td class="grad-date">{{ $grad->cohort_date }}</td>
                                        <td class="grad-cohort">@if($grad->front_end == 1) <span class="fa fa-check success"></span> @endif</td>
                                        <td class="grad-cohort">@if($grad->full_stack_js == 1) <span class="fa fa-check success"></span> @endif</td>
                                        <td class="grad-cohort">@if($grad->php == 1) <span class="fa fa-check success"></span> @endif</td>
                                        <td class="grad-cohort">@if($grad->dot_net == 1) <span class="fa fa-check success"></span> @endif</td>
                                    </tr>
                                @endforeach
                                <tr v-if="filter.length == 0">
                                    <td colspan="8" class="text-right">Click programming language icons to begin your search <span class="fa fa-hand-o-up m1-left"></span></td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                    </section>
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
            data:{
                filter: []
            }
        })
    </script>

@endsection
