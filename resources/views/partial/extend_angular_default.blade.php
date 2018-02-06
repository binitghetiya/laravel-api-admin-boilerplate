<!DOCTYPE html>
<html ng-app="myApp">
    <head>
        <meta charset="UTF-8">
        <title>{{ $page_title or "Admin Module"}}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="{{config('app.url')}}/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.8.1/jquery.timepicker.css" rel="stylesheet" type="text/css" />
        <link href="{{config('app.url')}}/bower_components/AdminLTE/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <link href="{{config('app.url')}}/bower_components/AdminLTE/dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
        <link href="{{config('app.url')}}/bower_components/AngularJS-Toaster/toaster.min.css" rel="stylesheet" type="text/css" />
        <link href="{{config('app.url')}}/bower_components/angular-material/angular-material.css" rel="stylesheet" type="text/css" />
        <link href="{{config('app.url')}}/js/extra/Loading.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{config('app.url')}}/bower_components/angular-google-places-autocomplete/src/autocomplete.css">
        <script src="{{config('app.url')}}/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="{{config('app.url')}}/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="{{config('app.url')}}/bower_components/angular/angular.js"></script>
        <script src="{{config('app.url')}}/js/extra/Loading.js"></script>
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
    <script src="{{config('app.url')}}/bower_components/AdminLTE/dist/js/app.min.js" type="text/javascript"></script>
    <script src="{{config('app.url')}}/bower_components/angular-animate/angular-animate.min.js" type="text/javascript"></script>
    <script src="{{config('app.url')}}/bower_components/AngularJS-Toaster/toaster.min.js" type="text/javascript"></script>
    <script src="{{config('app.url')}}/bower_components/angular-ui-mask/dist/mask.js" type="text/javascript"></script>
    <script src="{{config('app.url')}}/bower_components/ng-file-upload/ng-file-upload-shim.js" type="text/javascript"></script>
    <script src="{{config('app.url')}}/bower_components/ng-file-upload/ng-file-upload.min.js" type="text/javascript"></script>
    <script src="{{config('app.url')}}/bower_components/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="{{config('app.url')}}/bower_components/ng-ckeditor/ng-ckeditor.js" type="text/javascript"></script>
    <script src="{{config('app.url')}}/bower_components/angular-aria/angular-aria.js" type="text/javascript"></script>
    <script src="{{config('app.url')}}/bower_components/angular-animate/angular-animate.js" type="text/javascript"></script>
    <script src="{{config('app.url')}}/bower_components/angular-material/angular-material.js" type="text/javascript"></script>
    <script src="{{config('app.url')}}/bower_components/angular-paging/dist/paging.min.js" type="text/javascript"></script>

</body>
</html>