<html>
    <head>
        <meta charset="UTF-8">
        <title>{{ "Admin Login" }}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{config('app.url')}}/css/include/all_normal.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#" class="logo"><img src="{{config('app.url')}}/site_img/logo.png" style="max-width: 185px;"></a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Admin Login</p>
                <p class="login-box-msg">{{$message}}</p>
                <form action="login" method="post">
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" name='email' placeholder="Email" required="true">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name='password' placeholder="Password" required="true">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="{{config('app.url')}}/js/include/all_normal.js" type="text/javascript"></script>
    </body></html>