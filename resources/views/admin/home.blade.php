@extends('partial.extend_angular_default')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total Users</span>
                <span class="info-box-number">{{$data['total_users'] or null}}</span>
            </div>
        </div>
    </div>
</div>
@endsection