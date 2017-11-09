@extends('student_layout1',['student',$student])
@section('page_heading','Student Medication Info')
<?php
$json=json_decode($student);
?>

@section('section')
<?php
if(!(isset($json->medication_info) && !empty($json->medication_info)))
{ ?>
  <br/><br/>
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-danger">
                  <div class="panel-heading"><span class="glyphicon glyphicon-warning-sign">&nbsp;</span>No Information found</div>

                  <div class="panel-body">
                      <p>No Medication Information has been added to the student.</p><br/>
                      <div class="models--actions">
                          <a class="btn btn-labeled btn-success" href="{{route('students.med_info.create',$student->_id)}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add Info'}}</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <?php }
  else {
    $data=$json->medication_info;
    ?>

    <div class="container">
      <div class="row">

        <div class="container col-md-8 col-md-offset-2" >
          <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Medication Information</h3>
            </div>
            <div class="panel-body">
              <div class="models--actions pull-right">
                          <a class="btn btn-labeled btn-success" href="{{route('students.med_info.create',$student->_id)}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add Info'}}</a>
              </div>
              <table class="table table-striped">
                <tr>
                  <th>Name</th>
                  <th>Doctor</th>
                  <th>Start Date</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                @foreach($data as $medinfo)
                <tr>
                <td><a href="#" data-toggle="popover" title="Remarks" data-content="{{$medinfo->remarks}}">{{$medinfo->MedicationName}}</a></td>
                <td>{{$medinfo->DoctorName}}</td>
                <td>{{$medinfo->start_date}}</td>
                <td>{{$medinfo->status}}</td>
                <td class="col-xs-4">
                  <form action="{{ route('students.med_info.destroy', [$student->_id,$loop->index])}}" method="post" class="delete">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <a class="btn btn-labeled btn-default" href="{{route('students.med_info.edit',[$student->_id,$loop->index])}}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ 'edit' }}</a>
                    <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ 'delete' }}</button>
                  </form>
                </td>
                </tr>
                @endforeach
            </div>
        </div>
      </div>
      </div>


    </div>
    <script>
      $(document).ready(function(){
          $('[data-toggle="popover"]').popover();
      });
   </script>

  <?php

  }
  ?>

@endsection
