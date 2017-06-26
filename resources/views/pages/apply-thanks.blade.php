@extends('layout')
@section('title', 'Thanks for Applying')

@section('content')

    @include('components.nav', [ 'home' => false ])

    <section id="enroll" class="content background-white p2-top p4-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <h3 class="m0" @include('edit', ['key' => 'apply_thanks_title'])>{!! $apply_thanks_title !!}</h3>
                    <hr>
                    <div @include('edit', ['key' => 'apply_thanks_desc'])>{!! $apply_thanks_desc !!}</div>
                </div>
            </div>
        </div>
    </section>
@endsection
