@extends('layouts.app')

@section('sidebar')


<div class="navbar-default sidebar" role="navigation">
  <div class="sidebar-nav navbar-collapse">

    <ul class="nav" id="side-menu">
      <div class="profile-sidebar">
              <!-- SIDEBAR USERPIC -->
              <div class="profile-userpic">
                <br/><img src="{{$student->firstMedia('profile')->getUrl()}}" class="img-responsive" alt="">
              </div>

              <div class="profile-usertitle">
                <div class="profile-usertitle-name">
                  {{$student->fname}} {{$student->lname}}
                </div>
              </div>

              <div class="profile-userbuttons">
                <a class="btn btn-labeled btn-success btn-sm" href="{{route('students.feedback.create',[\Auth::user()->roles()->first()->name,$student->_id])}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Feedback'}}</a>
              <a class="btn btn-labeled btn-danger btn-sm" href="{{route('students.attendance.index',[\Auth::user()->roles()->first()->name,$student->_id])}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Attendance'}}</a>
              </div>
        </div>

      <br/><li></li>
      <li {{ (Request::is('/home') ? 'class="active"' : '') }}>
          <a href="{{ url ('/home') }}"><i class="fa fa-home fa-fw"></i> Home</a>
      </li>
      <li>
          <a href="{{route('students.show', [\Auth::user()->roles()->first()->name,$student->_id])}}"><i class="fa fa-dashboard fa-fw"></i>{{$student->fname}}'s Dashboard</a>
      </li>

      <li><a href="{{route('students.iep.index',[\Auth::user()->roles()->first()->name,$student->_id])}}"><i class="fa fa-info fa-fw"></i>IEP</a></li>

      <li data-toggle="collapse" data-target="#service" class="collapsed">
                <a href="#"><i class="fa fa-graduation-cap fa-fw"></i>Student Info<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level sub-menu collapse" id="service">
                  <li><a  href="{{route('students.general_info.index',$student->_id)}}"> General Information </a></li>
                  <li><a  href="{{route('students.background_info.index',$student->_id)}}"> Background Information </a></li>
                  <li><a  href="{{route('students.guardian_info.index',$student->_id)}}"> Guardian Information </a></li>
                  <li><a  href="{{route('students.med_info.index',$student->_id)}}"> Medication Information </a></li>
                  <li><a  href="{{route('students.school_info.index',$student->_id)}}"> School Information </a></li>
                </ul>

      </li>



      <li><a  href="{{route('students.feedback.index',[\Auth::user()->roles()->first()->name,$student->_id])}}"><i class="fa fa-comment fa-fw"></i> Feedbacks </a></li>
       <li><a  href="{{route('students.status_report.index',$student->_id)}}"><i class="fa fa-file fa-fw"></i> Status Report </a></li>
        <li><a  href="{{route('students.strength_info.index',$student->_id)}}"><i class="fa fa-life-saver fa-fw"></i> Strength & Needs </a></li>
        <li><a  href="{{route('students.other_services.index',$student->_id)}}"><i class="fa fa-exchange fa-fw"></i> Other Services </a></li>
        @if(0)
        <li><a  href="{{route('students.media_gallery.index',$student->_id)}}"><i class="fa fa-file-image-o fa-fw"></i> Media Gallery </a></li>
        @endif


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
      @include('partials.notifications')
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
