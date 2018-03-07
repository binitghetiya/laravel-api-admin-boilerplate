let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

/*normal page CSS starts*/
mix
        .styles([
            'public/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css',
            'public/bower_components/AdminLTE/dist/css/AdminLTE.min.css',
            'public/bower_components/AdminLTE/dist/css/skins/skin-blue.min.css',
        ], 'public/css/include/all_normal.css')
        .copyDirectory('public/bower_components/AdminLTE/bootstrap/fonts', 'public/css/fonts')
        .combine([
            'public/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js',
            'public/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js',
            'public/bower_components/AdminLTE/dist/js/app.min.js',
        ], 'public/js/include/all_normal.js');
/*normal page CSS ends*/

/*angular page CSS starts*/
mix
        .styles([
            'public/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css',
            'public/bower_components/AdminLTE/dist/css/AdminLTE.min.css',
            'public/bower_components/AdminLTE/dist/css/skins/skin-blue.min.css',
            'public/bower_components/AngularJS-Toaster/toaster.min.css',
            'public/bower_components/angular-material/angular-material.css',
            'public/css/extra/Loading.css',
            'public/bower_components/angular-google-places-autocomplete/src/autocomplete.css',
        ], 'public/css/include/all_angular.css')
        .copyDirectory('public/bower_components/AdminLTE/bootstrap/fonts', 'public/css/fonts')
        .combine([
            'public/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js',
            'public/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js',
            'public/bower_components/angular/angular.js',
            'public/js/extra/Loading.js',
        ], 'public/js/include/all_head_angular.js')
        .combine([
            'public/bower_components/AdminLTE/dist/js/app.min.js',
            'public/bower_components/angular-animate/angular-animate.min.js',
            'public/bower_components/AngularJS-Toaster/toaster.min.js',
            'public/bower_components/angular-ui-mask/dist/mask.js',
            'public/bower_components/ng-file-upload/ng-file-upload-shim.js',
            'public/bower_components/ng-file-upload/ng-file-upload.min.js',
            'public/bower_components/ckeditor/ckeditor.js',
            'public/bower_components/ng-ckeditor/ng-ckeditor.js',
            'public/bower_components/angular-aria/angular-aria.js',
            'public/bower_components/angular-material/angular-material.js',
            'public/bower_components/angular-paging/dist/paging.min.js',
        ], 'public/js/include/all_footer_angular.js');
/*angular page CSS ends*/