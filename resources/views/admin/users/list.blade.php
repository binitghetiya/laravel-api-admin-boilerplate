@extends('partial.extend_angular_default')

@section('content')
<script src="{{config('app.url')}}/js/admin_controller/user_controller.js"></script>
<div class="row" ng-controller="userListController" ng-init="getAllUsers()">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Users List</h3>
            </div>
            <div class="box-body">
                <div class="col">
                    <label>Filter :</label>
                </div>
                <div class="col-md-2">
                    <select class="form-control" ng-change="getAllUsers()" ng-model="filter">
                        <option value="name">Name</option>
                        <option value="email">Email</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <input type="text" my-enter="getAllUsers()" style="margin-bottom:10px;background: #d1ebfa;font-color:black;" ng-model="filter_text" class="form-control bg-light no-border rounded " placeholder="Enter name or email" style="">
                </div>
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap col-md-12" style="overflow-x: auto;margin-top: 15px;margin-left: -5px;"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                    <tr role="row">
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Verified ?</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr role="row"  ng-repeat="user in users" >
                                        <td><%user.name%></td>
                                        <td><%user.email%></td>
                                        <td ng-if="user.is_verified">Verified</td>
                                        <td ng-if="!user.is_verified">Not Verified</td>
                                        <td><%user.created_at%></td>
                                        <td>
                                            <button style="width: 74px;" class="btn m-b-xs w-xs btn-primary" ng-click="editUser(user.id)">Edit</button>
                                            <button style="width: 74px;" ng-if="user.status == 1" class="btn m-b-xs w-xs btn-success" ng-click="statusUser(user.id)">Active</button>
                                            <button style="width: 74px;" ng-if="user.status == 0" class="btn m-b-xs w-xs btn-danger" ng-click="statusUser(user.id)">Inactive</button>
                                            <button style="width: 74px;" class="btn m-b-xs w-xs btn-danger" ng-click="deleteUser(user.id)">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-8">
                    <paging
                        page="current_page" 
                        page-size="limit" 
                        total="total_count"
                        paging-action="changeMyPage('Paging Clicked', page, pageSize, total)"
                        show-prev-next="true"
                        show-first-last="true"
                        >
                    </paging>  
                </div>
            </div>
        </div>
    </div>
</div>

@endsection