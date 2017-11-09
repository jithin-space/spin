@extends('dashboard_layout')
@section('page_heading','Home')

@section('section')


<div class="col-sm-12">
  <div class="row">
    <div class="col-lg-3 col-md-6">
      <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-graduation-cap fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge">{{\App\Student::count()}}</div>
                    <div>Students!</div>
                </div>
            </div>
        </div>
        <a href="{{ route('students.index',\Auth::user()->roles()->first()->name)}}">
            <div class="panel-footer">
                <span class="pull-left">View All</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="panel panel-green">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-users fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge">{{\App\User::count()}}</div>
                    <div>SPIN Users</div>
                </div>
            </div>
        </div>
        <a href="{{ route('users.index',\Auth::user()->roles()->first()->name)}}">
            <div class="panel-footer">
                <span class="pull-left">View All</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="panel panel-yellow">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-shopping-cart fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge">{{\App\Role::count()}}</div>
                    <div>User Roles!</div>
                </div>
            </div>
        </div>
        <a href="{{ route('roles.index',\Auth::user()->roles()->first()->name)}}">
            <div class="panel-footer">
                <span class="pull-left">View All</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="panel panel-red">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-support fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge">{{\App\Permission::count()}}</div>
                    <div>Role Permissions!</div>
                </div>
            </div>
        </div>
        <a href="{{ route('permissions.index',\Auth::user()->roles()->first()->name)}}">
            <div class="panel-footer">
                <span class="pull-left">View All</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
      </div>
    </div>

  </div>
  <div class="row">
  </div>
</div>

@endsection
