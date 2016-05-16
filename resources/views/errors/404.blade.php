@extends('layout')
@section('title', 'Not Found')

@section('content')

    @include('components.nav', [ 'home' => false ])

    <section id="not-found" class="content p4-top p4-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="m0">You&rsquo;ve made a huge mistake.</h3>
                    <hr>
                    <p>I don&rsquo;t know how to tell you this, but the page you&rsquo;re looking for simply does not exist.</p>
                    <p class="m0">Maybe <a href="/">head back to the beginning</a> and try again?</p>
                </div>
            </div>
        </div>
    </section>

@endsection
