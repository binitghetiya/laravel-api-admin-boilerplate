<!DOCTYPE html>
<html ng-app="myApp">
    <head>
        <meta charset="UTF-8">
        <title>{{ $page_title or "Admin Module"}}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.8.1/jquery.timepicker.css" rel="stylesheet" type="text/css" />
        <link href="{{config('app.url')}}/css/include/all_angular.css" rel="stylesheet" >
        <script src="{{config('app.url')}}/js/include/all_head_angular.js" type="text/javascript"></script>
        <script type="text/javascript">
            var CallUrl = "{{config('app.url')}}/api";
            var client_id = 'e340e7d3ce77625c';
        </script>
        <script src=" {{config('app.url')}}/js/angular_app.js"></script>
        <style>
            img{
                object-fit: cover; 
            }
        </style>


    </head>
    <body class="skin-blue">
    <toaster-container toaster-options="{'time-out': 3000}"></toaster-container>
    <div class="wrapper">
        @include('partial.header')
        @include('partial.sidebar')
        <div class="content-wrapper">
            <section class="content">
                @yield('content')
            </section>
        </div>
        @include('partial.footer')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.8.1/jquery.timepicker.js" type="text/javascript"></script>
    <script src="{{config('app.url')}}/js/include/all_footer_angular.js"></script>
    <script>
        $(document).ready(function () {
            $('.dropdown-toggle').dropdown();
        });
    </script>

</body>
</html>