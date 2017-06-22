@extends('layout')
@section('title', 'Thanks for Enrolling')

@section('content')

    @include('components.nav', [ 'home' => false ])

    <section id="enroll" class="content background-white p2-top p4-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <h3 class="p1-top m0">Your enrollment has been submitted.</h3>
                    <hr>
                    <p>Thank you</p>
                </div>
            </div>
        </div>
    </section>
@endsection
