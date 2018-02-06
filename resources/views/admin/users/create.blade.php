@extends('partial.extend_angular_default')

@section('content')
<script src="{{config('app.url')}}/js/admin_controller/user_controller.js"></script>
<div class="row" ng-controller="userCreateController">
    <div class="col-xs-6 col-xs-offset-3">
        <form ng-submit="createUser()" novalidate name="createadmin">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Create User</h3>
                </div>
                <div class="box-body">
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" ng-model="user.name" class="form-control" placeholder="Name" required="true"> 
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" ng-model="user.email" class="form-control" placeholder="Email" required="true"> 
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" ng-model="user.password" class="form-control" placeholder="Password" required="true"> 
                    </div>
                    <div class="form-group col-md-6">
                        <label>Status</label>
                        <select class="form-control" ng-model="user.status">
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" ng-disabled="createadmin.$invalid" class="btn btn-primary pull-right">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection