<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="spin,iep,spin-iep,space,insight">
    <meta name="description" content="Individualized Education plan for Insight">
    <meta name="author" content="Jithin Thankachan">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/>
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Expires" content="0"/>
    <!-- <meta http-equiv="refresh" content="30"> -->
    <meta charset="utf-8" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!--from the theme  -->



    <!--External Stylesheets  -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/stylesheets/styles.css') }}" />

    <link href="{{ URL::asset('css/jasny-bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('css/summernote.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('css/select2.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('css/bootstrap-select.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('css/datetimepicker.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('css/bootstrap-formhelpers.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/fullcalendar/fullcalendar/fullcalendar.print.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.css') }}" rel="stylesheet">
<!--for live search  -->

<link rel="stylesheet" href="{{ URL::asset('livesearch/css/fontello.css') }}">
<link rel="stylesheet" href="{{ URL::asset('livesearch/css/animation.css') }}">

<link rel="stylesheet" type="text/css" href="{{ URL::asset('livesearch/css/ajaxlivesearch.min.css') }}">
<!-- end of live search -->

    <!--External Scripts  -->
    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap-filestyle.min.js')}}"></script>
    <script src="{{ URL::asset('js/bootstrap-select.js')}}"></script>
    <script src="{{ URL::asset('js/bootstrap-formhelpers.js') }}"></script>






</head>
<body>
  @yield('body')

    <script src="/js/app.js"></script>
</body>
</html>
