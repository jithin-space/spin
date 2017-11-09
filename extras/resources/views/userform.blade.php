@extends('layouts.app')

@section('sidebar')


<div class="navbar-default sidebar" role="navigation">
  <div class="sidebar-nav navbar-collapse">
    <ul class="nav" id="side-menu">
      <li class="sidebar-search">
            <form id="live-search" action=" " class="styled" method="post">
              <fieldset>
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control text-input" placeholder="Search..." id="filter">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
            </fieldset>
        </form>

      </li>
      <li {{ (Request::is('/home') ? 'class="active"' : '') }}>
          <a href="{{ url ('/home') }}"><i class="fa fa-home fa-fw"></i> Home</a>
      </li>
      @if(Entrust::hasRole('admin'))
      <li {{ (Request::is('*users') ? 'class="active"' : '') }}>
          <a href="{{ url ('/admin/users') }}"><i class="fa fa-users fa-fw"></i> Manage Users</a>
          <!-- /.nav-second-level -->
      </li>
      <li {{ (Request::is('*roles') ? 'class="active"' : '') }}>
          <a href="{{ url ('/admin/roles') }}"><i class="fa fa-users fa-fw"></i> Manage Roles</a>
          <!-- /.nav-second-level -->
      </li>
      <li {{ (Request::is('*permissions') ? 'class="active"' : '') }}>
          <a href="{{ url ('/admin/permissions') }}"><i class="fa fa-users fa-fw"></i> Manage Permissions</a>
          <!-- /.nav-second-level -->
      </li>
      <li {{ (Request::is('*students') ? 'class="active"' : '') }}>
          <a href="{{ url ('/admin/students') }}"><i class="fa fa-graduation-cap fa-fw"></i> Manage Students</a>
      </li>
      <li><a href="{{url('/admin/tags')}}"><i class="fa fa-book fa-fw"></i>Manage Vocabularies</a></li>
      @if(0)
      <li><a href=""><i class="fa fa-wrench fa-fw"></i>Administration</a></li>
      @endif
       @endif

       @if(Entrust::hasRole('teacher'))
           <li><a href="{{route('students.index')}}"><i class="fa fa-graduation-cap fa-fw"></i>MyStudents </a></li>
       @endif
      <li {{ (Request::is('') ? 'class="active"' : '') }}>
          <a href="{{ route('profile.show', Auth::user()->id) }}"><i class="fa fa-user-md fa-fw"></i> My Profile</a>
      </li>


      <li><a href="{{url ('/about')}}"><i class="fa fa-info fa-fw"></i>About Us</a></li>


    </ul>
  </div>
</div>
@endsection

@section('page')
<div id="page-wrapper">
   <div class="row">
     <div class="col-md-8 col-md-offset-2">
         <h1 class="page-header">@yield('page_heading')</h1>
     </div>
   </div>
   <div class="row">

    <div class="col-md-8 col-md-offset-2">
       <div class="panel panel-default">
         <div class="panel-heading">SPIN Form</div>
         <div class="panel-body">
           @yield('section')
        </div>
        </div>
    </div>
   </div>
</div>
@endsection
