<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} &ndash; Code Louisville</title>
    <link rel="stylesheet" href="https://cdn.rawgit.com/konpa/devicon/master/devicon.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600,900">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/codelouisville.css">
    <link rel="icon" href="{{ env('CLOUDFRONT') }}/assets/img/favicon.png">
</head>
<body data-spy="scroll" data-target=".subnav" @if($title == 'Home') class="home" @endif>
    @if (Auth::check())
        @include('components.modal')
    @endif

    @yield('content')

    @include('components.map')
    @include('components.footer')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    @yield('vue')
    @stack('scripts')

    <script src="/assets/js/code-louisville.js"></script>
    @if (Auth::check()) <script src="/assets/js/edit.js"></script> @endif
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</body>
</html>
