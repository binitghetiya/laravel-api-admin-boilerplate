<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{{ $page_title or "Dashboard" }}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="{{ asset("/bower_components/bootstrap/dist/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("/bower_components/AdminLTE/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />
        <script src="{{ asset("/bower_components/jquery/dist/jquery.min.js") }}"></script>
        <script src="{{ asset("/bower_components/bootstrap/dist/js/bootstrap.min.js") }}" type="text/javascript"></script>
        <script src=" {{asset("/bower_components/angular/angular.min.js") }}"></script>
    </head>
    <body class="skin-blue">
        <div class="wrapper">
            @include('partial.header')
            @include('partial.sidebar')
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        {{ $page_description or "Welcome Admin" }}
                        <small>{{ $page_description or null }}</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                        <li class="active">Home</li>
                    </ol>
                </section>
                <section class="content">
                    @yield('content')
                </section>
            </div>
            @include('partial.footer')
        </div>
        <script src="{{ asset("/bower_components/AdminLTE/dist/js/adminlte.min.js") }}" type="text/javascript"></script>
    </body>
</html>