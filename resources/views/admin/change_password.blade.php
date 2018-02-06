@extends('partial.extend_angular_default')

@section('level')
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
    <li class="active">Change Password</li>
</ol>
@endsection

@section('content')
<div class="col-md-3"></div>
<div class="col-md-4">
    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Change Password</h3>
            <p class="login-box-msg" style="margin-top: 20px;margin-bottom: -20px;">{{$message}}</p>
        </div>
        <form method="POST" action="change_password">
            <div class="box-body">
                <div class="form-group">
                    <label for="old_password">Old Password</label>
                    <input type="password" class="form-control" name='old_password' id="old_password" required="true" placeholder="Old Password">
                </div>
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" class="form-control" name='new_password' id="new_password" required="true" placeholder="New Password">
                </div>
                <div class="form-group">
                    <label for="old_password">Confirm New Password</label>
                    <input type="password" class="form-control" name='confirm_new_password' id="confirm_new_password" required="true" placeholder="Confirm New Password">
                </div>
                <div class="form-group pull-right">
                    <button type="submit" value="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection