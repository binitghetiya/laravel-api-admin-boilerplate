myApp.controller('userCreateController', ['$scope', '$http', 'toaster', 'Upload', function ($scope, $http, toaster, Upload) {
        $scope.user = {};
        $scope.user.status = "";
        $scope.createUser = function () {
            Loading(true);
            var data = $scope.user;
            $http({
                method: 'POST',
                url: CallUrl + '/admin/users/create',
                data: data
            }).then(function successCallback(response) {
                toaster.pop("success", "Create User", "User created successfully");
                setTimeout(function () {
                    window.location.href = CallUrl + "/../admin/user_management/list";
                }, 1000);
            }, function errorCallback(error) {
                Loading(false);
                toaster.pop("error", "Create User", error.data.error.message);
            });
        };
    }]);

myApp.controller('userListController', ['$scope', '$http', 'toaster', function ($scope, $http, toaster) {
        $scope.filter = 'name';
        $scope.filter_text = "";
        $scope.current_page = 1;
        $scope.total_page = 0;
        $scope.total_count = 0;
        $scope.limit = 10;
        $scope.offset = $scope.limit * (parseInt($scope.current_page) - 1);
        $scope.changeMyPage = function (name, page, pageSize, total) {
            $scope.offset = (page - 1) * $scope.limit;
            $scope.getAllUsers();
        };
        $scope.getAllUsers = function () {
            var data = {
                'limit': $scope.limit,
                'offset': $scope.offset,
                'filter': $scope.filter,
                'filter_text': $scope.filter_text
            };
            $http({
                method: 'POST',
                url: CallUrl + '/admin/users/list',
                data: data
            }).then(function successCallback(response) {
                $scope.users = response.data.data;
                $scope.total_count = response.data.total_count;
            }, function errorCallback(error) {
                toaster.pop('error', "User Create", error.data.error.message);
            });
        };
        $scope.statusUser = function (user_id) {
            var data = {
                user_id: user_id
            };
            $http({
                method: 'POST',
                url: CallUrl + '/admin/users/status',
                data: data
            }).then(function successCallback(response) {
                $scope.getAllUsers();
            }, function errorCallback(error) {
                toaster.pop('error', "User Status", error.data.error.message);
            });
        };
        $scope.deleteUser = function (user_id) {
            if (window.confirm("Are you sure you want to delete this user and its records?")) {
                var data = {
                    user_id: user_id
                };
                $http({
                    method: 'POST',
                    url: CallUrl + '/admin/users/delete',
                    data: data
                }).then(function successCallback(response) {
                    $scope.getAllUsers();
                }, function errorCallback(error) {
                    toaster.pop('error', "User Delete", error.data.error.message);
                });
            }
        };

        $scope.editUser = function (id) {
            Loading(true);
            setTimeout(function () {
                window.location.href = CallUrl + "/../admin/user_management/edit?id=" + id;
            }, 1000);
        }
        $scope.getAllUsers();
    }]);

myApp.controller('userEditController', ['$scope', '$http', 'toaster', 'Upload', function ($scope, $http, toaster, Upload) {
        $scope.user = {};
        $scope.init = function () {
            $scope.getUser();
        };
        $scope.getUser = function () {
            var data = {};
            data.user_id = UrlParameter('id');
            $http({
                method: 'POST',
                url: CallUrl + '/admin/users/get_user',
                data: data
            }).then(function successCallback(response) {
                $scope.user = response.data.data;
            }, function errorCallback(error) {
                toaster.pop('error', "User Create", error.data.error.message);
            });
        };
        $scope.updateUser = function () {
            var data = $scope.user;
            $http({
                method: 'POST',
                url: CallUrl + '/admin/users/edit',
                data: data
            }).then(function successCallback(response) {
                toaster.pop("success", 'User', 'Updated successfully');
            }, function errorCallback(error) {
                toaster.pop('error', "User Create", error.data.error.message);
            });
        };
    }]);

