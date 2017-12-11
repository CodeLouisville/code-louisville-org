@extends('layout')
@section('title', 'Graduates')

@section('content')

    @include('components.nav', [ 'home' => false ])

    <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="modal-connect"></div>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <td>Email</td>
                            <td class="modal-email"></td>
                        </tr>
                        <tr>
                            <td>Last Cohort</td>
                            <td class="modal-date"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <section id="graduates" class="content background-white p2-top p4-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <section id="graduates" class="m2-bottom">
                        <div class="pull-right grad-tip">Click on the icons to narrow your results</div>
                        <h3 class="p1-top m0">{{ $title }} </h3>
                        <hr>
                        <table class="table table-bordered table-striped graduates">
                            <thead>
                                <tr>
                                    @if (Auth::check() && Auth::user()->admin) <th class="grad-edit"></td> @endif
                                    <th class="grad-name">Name</th>
                                    <th class="grad-email">Email</th>
                                    <th class="grad-connect">Connect</th>
                                    <th class="grad-date">Last Cohort</th>
                                    <th class="grad-cohort"><label><input type="checkbox" v-model="filter" value="1"><i data-toggle="tooltip" data-placement="top" title="" class="devicon-html5-plain colored" data-original-title="Front End"></i></label></th>
                                    <th class="grad-cohort"><label><input type="checkbox" v-model="filter" value="2"><i data-toggle="tooltip" data-placement="top" title="" class="devicon-javascript-plain colored" data-original-title="Javascript"></i></label></th>
                                    <th class="grad-cohort"><label><input type="checkbox" v-model="filter" value="4"><i data-toggle="tooltip" data-placement="top" title="" class="devicon-php-plain colored" data-original-title="PHP"></i></label></th>
                                    <th class="grad-cohort"><label><input type="checkbox" v-model="filter" value="8"><i data-toggle="tooltip" data-placement="top" title="" class="devicon-dot-net-plain colored" data-original-title=".NET"></i></label></th>
                                    <th class="grad-cohort"><label><input type="checkbox" v-model="filter" value="32"><i data-toggle="tooltip" data-placement="top" title="" class="devicon-apple-plain colored" data-original-title="iOS Swift Development"></i></label></th>
                                    <th class="grad-cohort"><label><input type="checkbox" v-model="filter" value="32"><i data-toggle="tooltip" data-placement="top" title="" class="devicon-python-plain colored" data-original-title="Python"></i></label></th>
                                    <th class="grad-cohort"><label><input type="checkbox" v-model="filter" value="16"><i data-toggle="tooltip" data-placement="top" title="" class="devicon-rails-plain colored" data-original-title="Ruby on Rails (discontinued)"></i></label></th>
                                    <th class="grad-cohort"><label><input type="checkbox" v-model="filter" value="64"><i data-toggle="tooltip" data-placement="top" title="" class="devicon-android-plain colored" data-original-title="Android (discontinued)"></i></label></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="grad" data-cohorts="@{{ grad.cohorts }}" v-if="filter.length > 0" v-for="grad in grads | filterBy selected in 'cohorts' | orderBy 'cohort_datetime' -1">
                                    @if (Auth::check() && Auth::user()->admin) <td class="grad-edit"><a class="pink" href="/hire/graduates/edit/@{{ grad.id }}"><span class="fa fa-edit"></span></a></td>@endif
                                    <td class="grad-name" v-text="grad.name"></td>
                                    <td class="grad-email"><span class="pink" v-text="grad.email"></span></td>
                                    <td class="grad-connect"><a href="https://github.com/@{{ grad.github }}" target="_blank"><span class="fa fa-github-square"></span></a> &nbsp; <a href="https://www.linkedin.com/in/@{{ grad.linkedin }}" target="_blank"><span class="fa fa-linkedin-square"></span></a></td>
                                    <td class="grad-date" v-text="grad.cohort_date"></td>
                                    <td class="grad-cohort"><span class="fa fa-check success" v-if="grad.front_end == 1"></span></td>
                                    <td class="grad-cohort"><span class="fa fa-check success" v-if="grad.js == 1"></span></td>
                                    <td class="grad-cohort"><span class="fa fa-check success" v-if="grad.php == 1"></span></td>
                                    <td class="grad-cohort"><span class="fa fa-check success" v-if="grad.net == 1"></span></td>
                                    <td class="grad-cohort"><span class="fa fa-check success" v-if="grad.ios == 1"></span></td>
                                    <td class="grad-cohort"><span class="fa fa-check success" v-if="grad.python == 1"></span></td>
                                    <td class="grad-cohort"><span class="fa fa-check success" v-if="grad.rails == 1"></span></td>
                                    <td class="grad-cohort"><span class="fa fa-check success" v-if="grad.android == 1"></span></td>
                                </tr>
                                <tr v-if="filter.length == 0">
                                    <td colspan="@if (Auth::check() && Auth::user()->admin) 12 @else 11 @endif" class="text-right" style="height:50px">Click language icons to begin your search <span class="fa fa-level-up"></span></td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        @if (Auth::check() && Auth::user()->admin) <a class="button pink" href="/hire/graduates/add">Add graduate</a> @endif
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
                filter: [0],
                grads: [
                    @foreach($grads as $grad){
                        id: '{{ $grad->id }}',
                        name: '{{ $grad->name }}',
                        email: '{{ $grad->email }}',
                        github: '{{ $grad->github }}',
                        linkedin: '{{ $grad->linkedin }}',
                        cohort_date: '{{ $grad->cohort_date }}',
                        cohort_datetime: '{{ $grad->cohort_datetime }}',
                        cohorts: '{!! $grad->cohorts !!}',
                        front_end: '{{ $grad->front_end }}',
                        js: '{{ $grad->full_stack_js }}',
                        php: '{{ $grad->php }}',
                        net: '{{ $grad->dot_net }}',
                        rails: '{{ $grad->rails }}',
                        ios: '{{ $grad->ios }}',
                        android: '{{ $grad->android }}'
                    },
                    @endforeach
                ],
                selected: "|0|"
            }
        })

        vm.$watch('filter', function (val) {
            var sum = 0
            $.each(val, function(){
                sum += parseInt(this)
            })
            this.selected = '|' + sum.toString() + '|'
        })
    </script>

@endsection
