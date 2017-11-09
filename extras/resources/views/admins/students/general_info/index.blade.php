@extends('student_layout1',['student'=>$student])
@section('page_heading','Student General Info')
@section('section')
<?php
$json=json_decode($student);
?>

@section('section')
<?php

if(!(isset($json->general_info) && !empty($json->general_info)) )
{ ?>
  <br/><br/>
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-danger">
                  <div class="panel-heading"><span class="glyphicon glyphicon-warning-sign">&nbsp;</span>No Information found</div>

                  <div class="panel-body">
                      <p>No General Information has been added to the student.</p><br/>
                      <div class="models--actions">
                          <a class="btn btn-labeled btn-primary" href="{{route('students.general_info.create',$student->_id)}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add Info'}}</a>
                      </div>

                  </div>
              </div>
          </div>
      </div>
  </div>
<?php }
else {
  $data=$json->general_info;
  \Debugbar::info(Carbon\Carbon::parse($student->created_at)->format('F j, Y'));
  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
           <A href="{{route('students.general_info.edit',[$student->_id,1])}}" >Edit General Information</A><br/>
           <p class=" text-info">Last Updated:{{Carbon\Carbon::parse($student->updated_at)->format('F j, Y')}}</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
        <div class="panel panel-info">
          <div class="panel-heading">
              <h3 class="panel-title">General Information</h3>
          </div>
          <div class="panel-body">
            <div class="row">
                  <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{$student->firstMedia('profile')->getUrl()}}" class="img-circle img-responsive"> </div>

                  <div class=" col-md-9 col-lg-9 ">
                    <table class="table table-user-information">
                      <tbody>
                        <tr><td>Name</td><td>{{$student->fname}} &nbsp; {{$student->lname}}</td></tr>
                        <tr><td>Date Of Birth</td><td>{{$data->date_of_birth}}</td></tr>
                        <tr><td>Age</td><td>
                          <?php
                          $value = str_replace('/', '-', $data->date_of_birth);
                          $from = new DateTime(date("Y-m-d", strtotime($value)));
                          $to   = new DateTime();
                          $interval=$from->diff($to);
                          echo $interval->format("%Y Years, %M Months and %d Days");
                           ?>
                        </td></tr>
                        <tr><td>Date Of Joining</td><td>{{$data->date_of_joining}}</td></tr>
                        <tr><td>Gender</td><td>{{$data->gender}}</td></tr>
                        <tr><td>Disablity Tags:</td><td>
                          @foreach($student->disabilities as $dis)
                            <a href="#" class="btn btn-default">{{$dis->name}}</a>
                          @endforeach
                        </td>
                      </tbody>

                    </table>

                  </div>
                </div>
          </div>
          <div class="panel-footer">
                 <a class="btn btn-labeled btn-success" href="{{route('students.general_info.edit',[$student->_id,1])}}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ 'edit' }}</a>
                 <span class="pull-right">
                   <form action="{{ route('students.general_info.destroy', [$student->_id,1])}}" method="post" class="delete">
                     <input type="hidden" name="_method" value="DELETE" />
                     <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                     <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ 'delete' }}</button>
                    </form>
                 </span>
          </div>
      </div>
    </div>
    </div>
  </div>

<?php

}
?>

@endsection
