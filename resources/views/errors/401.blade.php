@extends('layout')
@section('title', 'Unauthorized')

@section('content')

    @include('components.nav', [ 'home' => false ])

    <section id="unauthorized" class="content p4-top p4-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="m0">Pump your brakes, kid.</h3>
                    <hr>
                    <p>Looks like you don&rsquo;t have the proper authorizations to be mucking around these parts.</p>
                    <p class="m0">Might I suggest you go back the way you came?</p>
                </div>
            </div>
        </div>
    </section>

@endsection
