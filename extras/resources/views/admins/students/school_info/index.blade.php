@extends('student_layout1',['student',$student])
@section('page_heading','Student School Info')
<?php
$json=json_decode($student);
?>
@section('section')

<?php

if(!(isset($json->school_info) && !empty($json->school_info)))
{ ?>
  <br/><br/>
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-danger">
                  <div class="panel-heading"><span class="glyphicon glyphicon-warning-sign">&nbsp;</span>No Information found</div>

                  <div class="panel-body">
                      <p>No School Information has been added to the student.</p><br/>
                      <div class="models--actions">
                          <a class="btn btn-labeled btn-success" href="{{route('students.school_info.create',$student->_id)}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add Info'}}</a>
                      </div>

                  </div>
              </div>
          </div>
      </div>
  </div>
<?php }
else {
  $data=$json->school_info;
  ?>

<!--  -->
<div class="container">
  <div class="row">


    <div class="container col-md-8 col-md-offset-2" >
      <div class="model--actions pull-right">
          <a class="btn btn-labeled btn-success" href="{{route('students.school_info.create',$student->_id)}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add New'}}</a>
      </div>
    </div>
    <div class="container col-md-8 col-md-offset-2" >

      <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">School Information</h3>
        </div>


        <div class="panel-body">

                @foreach($data as $school)
                        <div class="panel panel-default">
                          <span class="label label-primary">{{$loop->index+1}}</span>
                           <div class="panel-body">
                             <div class="row">

                                   <div class=" col-md-6">

                                     <table class="table table-user-information">
                                       <tbody>
                                         <tr><td>School Name</td><td>{{$school->school_name}}</td><tr>
                                         <tr><td>School Type</td><td>{{$school->school_type}}</td><tr>
                                         <tr><td>Year Of Joining</td><td>{{$school->Year_Of_Joining}}</td><tr>
                                         <tr><td>Year Of Completion</td><td>{{$school->Year_Of_Completion}}</td><tr>
                                         <tr><td>Status</td><td>{{$school->status}}</td><tr>
                                         <tr><td>Email</td><td>{{$school->email}}</td><tr>
                                       </tbody>
                                     </table>

                                   </div>
                                   <div class="col-md-6">
                                         <div class="panel panel-default">
                                           <div class="panel-heading">School Address</div>
                                           <div class="panel-body">
                                             <address>
                                               <strong>{{$school->Address->Line1}}</strong><br>
                                               {{$school->Address->Line2}}<br>
                                               {{$school->Address->City}}<br>
                                               {{$school->Address->State}},{{$school->Address->Country}}<br>
                                               <abbr title="Phone">Ph:</abbr> {{$school->Address->Land_Phone}}<br/>
                                               <abbr title="Mob">Mob:</abbr>{{$school->Address->Mobile_Number}}
                                             </address>
                                           </div>
                                         </div>
                                   </div>
                                 </div>
                           </div>
                           <div class="panel-footer">
                             <a class="btn btn-labeled btn-success" href="{{route('students.school_info.edit',[$student->_id,$loop->index])}}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ 'edit' }}</a>
                             <span class="pull-right">
                               <form action="{{ route('students.school_info.destroy', [$student->_id,$loop->index])}}" method="post" class="delete">
                                 <input type="hidden" name="_method" value="DELETE" />
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                 <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ 'delete' }}</button>
                                </form>
                             </span>
                           </div>
                         </div>
                @endforeach
          </div>
        </div>

    </div>
  </div>
  </div>


</div>

<!--  -->
<?php

}
?>


@endsection
