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
                                    <th class="grad-cohort"><label><input type="checkbox" v-model="filter" value="1"><i data-toggle="tooltip" data-placement="top" title="" class="devicon-html5-plain colored" data-original-title="Front End"></i></label></th>
                                    <th class="grad-cohort"><label><input type="checkbox" v-model="filter" value="2"><i data-toggle="tooltip" data-placement="top" title="" class="devicon-javascript-plain colored" data-original-title="Javascript"></i></label></th>
                                    <th class="grad-cohort"><label><input type="checkbox" v-model="filter" value="4"><i data-toggle="tooltip" data-placement="top" title="" class="devicon-php-plain colored" data-original-title="PHP"></i></label></th>
                                    <th class="grad-cohort"><label><input type="checkbox" v-model="filter" value="8"><i data-toggle="tooltip" data-placement="top" title="" class="devicon-dot-net-plain colored" data-original-title=".NET"></i></label></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="grad" v-if="filter.length > 0" v-for="grad in grads | filterBy selected in 'cohorts'">
                                    <td class="grad-name" v-text="grad.name"></td>
                                    <td class="grad-email"><span class="pink" v-text="grad.email"></span></td>
                                    <td class="grad-connect"><a href="https://github.com/@{{ grad.github }}" target="_blank"><span class="fa fa-github-square"></span></a> &nbsp; <a href="https://www.linkedin.com/in/@{{ grad.linkedin }}" target="_blank"><span class="fa fa-linkedin-square"></span></a></td>
                                    <td class="grad-date" v-text="grad.cohort_date"></td>
                                    <td class="grad-cohort"><span class="fa fa-check success" v-if="grad.front_end == 1"></span></td>
                                    <td class="grad-cohort"><span class="fa fa-check success" v-if="grad.js == 1"></span></td>
                                    <td class="grad-cohort"><span class="fa fa-check success" v-if="grad.php == 1"></span></td>
                                    <td class="grad-cohort"><span class="fa fa-check success" v-if="grad.net == 1"></span></td>
                                </tr>
                                <tr v-if="filter.length == 0">
                                    <td colspan="8" class="text-right" style="height:50px">Click programming language icons to begin your search <span class="fa fa-level-up"></span></td>
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
        var vm = new Vue({
            el: '#graduates',
            data: {
                filter: [],
                grads: [
                    @foreach($grads as $grad){
                        name: '{{ $grad->name }}',
                        email: '{{ $grad->email }}',
                        github: '{{ $grad->github }}',
                        linkedin: '{{ $grad->linkedin }}',
                        cohort_date: '{{ $grad->cohort_date }}',
                        cohorts: [{!! $grad->cohorts !!}],
                        front_end: '{{ $grad->front_end }}',
                        js: '{{ $grad->full_stack_js }}',
                        php: '{{ $grad->php }}',
                        net: '{{ $grad->dot_net }}'
                    },
                    @endforeach
                ],
                selected: 0
            }
        })

        vm.$watch('filter', function (val) {
            var sum = 0
            $.each(val, function(){
                sum += parseInt(this)
            })
            this.selected = sum
        })
    </script>

@endsection
