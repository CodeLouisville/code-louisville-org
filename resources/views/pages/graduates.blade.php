@extends('layout')
@section('title', 'Graduates')

@section('content')

    @include('components.nav', [ 'home' => false ])

    <section id="graduates" class="content background-white p2-top p4-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <section id="graduates" class="m2-bottom">
                        <div class="filters">
                            <input type="checkbox" v-model="filter" value="Front-end"> Front-end
                            <input type="checkbox" v-model="filter" value="JS"> JS
                            <input type="checkbox" v-model="filter" value="PHP"> PHP
                            <input type="checkbox" v-model="filter" value=".NET"> .NET
                        </div>
                        <h3 class="p1-top m0">{{ $title }}</h3>
                        <hr>
                        <table class="table table-bordered table-striped graduates">
                            <thead>
                                <tr>
                                    <th class="grad-name">Name</th>
                                    <th class="grad-email">Email</th>
                                    <th class="grad-connect">Connect</th>
                                    <th class="grad-date">Cohort Date</th>
                                    <th class="grad-cohort"><i data-toggle="tooltip" data-placement="top" title="" class="devicon-html5-plain colored" data-original-title="Front End"></i></th>
                                    <th class="grad-cohort"><i data-toggle="tooltip" data-placement="top" title="" class="devicon-javascript-plain colored" data-original-title="Javascript"></i></th>
                                    <th class="grad-cohort"><i data-toggle="tooltip" data-placement="top" title="" class="devicon-php-plain colored" data-original-title="PHP"></i></th>
                                    <th class="grad-cohort"><i data-toggle="tooltip" data-placement="top" title="" class="devicon-dot-net-plain colored" data-original-title=".NET"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($grads as $grad)
                                    <tr>
                                        <td>{{ $grad->name }}</td>
                                        <td><span class="pink">{{ $grad->email }}</span></td>
                                        <td class="grad-connect"><a href="https://github.com/{{ $grad->github }}" target="_blank"><span class="fa fa-github-square"></span></a> &nbsp; <a href="https://www.linkedin.com/in/{{ $grad->linkedin }}" target="_blank"><span class="fa fa-linkedin-square"></span></a></td>
                                        <td>{{ $grad->cohort_date }}</td>
                                        <td class="grad-cohort">@if($grad->front_end == 1) <span class="fa fa-check success"></span> @endif</td>
                                        <td class="grad-cohort">@if($grad->full_stack_js == 1) <span class="fa fa-check success"></span> @endif</td>
                                        <td class="grad-cohort">@if($grad->php == 1) <span class="fa fa-check success"></span> @endif</td>
                                        <td class="grad-cohort">@if($grad->dot_net == 1) <span class="fa fa-check success"></span> @endif</td>
                                    </tr>
                                @endforeach
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
