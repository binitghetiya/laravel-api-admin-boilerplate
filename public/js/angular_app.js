//get url parser
var UrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

var myApp = angular.module('myApp', ['ngMaterial', 'toaster', 'ngFileUpload', 'ngCkeditor', 'ui.mask', 'bw.paging'], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

myApp.directive('convertToNumber', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attrs, ngModel) {
            ngModel.$parsers.push(function (val) {
                return val != null ? parseInt(val, 10) : null;
            });
            ngModel.$formatters.push(function (val) {
                return val != null ? '' + val : null;
            });
        }
    };
});

myApp.factory('MyHttpInterceptor', function ($q) {
    return {
        request: function (config) {
            var apiPattern = /\/api\//;

            config.headers = config.headers || {};
            if (apiPattern.test(config.url)) {
                config.headers['X-CLIENT-ID'] = client_id;
            }

            return config || $q.when(config);
        }
    };
});

myApp.config(function ($httpProvider) {
    $httpProvider.interceptors.push('MyHttpInterceptor');
});

myApp.config(['uiMask.ConfigProvider', function (uiMaskConfigProvider) {
        uiMaskConfigProvider.maskDefinitions({'A': /[a-z]/, '*': /[a-zA-Z0-9]/});
        uiMaskConfigProvider.clearOnBlur(false);
        uiMaskConfigProvider.eventsToHandle(['input', 'keyup', 'click']);
    }]);

myApp.directive('myEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if (event.which === 13) {
                scope.$apply(function () {
                    scope.$eval(attrs.myEnter);
                });

                event.preventDefault();
            }
        });
    };
});