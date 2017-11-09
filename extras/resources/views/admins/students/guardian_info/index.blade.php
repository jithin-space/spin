@extends('student_layout1',['student',$student])
@section('page_heading','Student Guardian Info')
<?php
$json=json_decode($student);
?>
@section('section')

<?php

if(!(isset($json->guardian_info) && !empty($json->guardian_info)))
{ ?>
  <br/><br/>
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-danger">
                  <div class="panel-heading"><span class="glyphicon glyphicon-warning-sign">&nbsp;</span>No Information found</div>

                  <div class="panel-body">
                      <p>No Guardian Information has been added to the student.</p><br/>
                      <div class="models--actions">
                          <a class="btn btn-labeled btn-success" href="{{route('students.guardian_info.create',$student->_id)}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add Info'}}</a>
                      </div>

                  </div>
              </div>
          </div>
      </div>
  </div>
<?php }
else {
  $data=$json->guardian_info;
  ?>

<!--  -->
<div class="container">
  <div class="row">


    <div class="container col-md-8 col-md-offset-2" >
      <div class="model--actions pull-right">
          <a class="btn btn-labeled btn-primary" href="{{route('students.guardian_info.create',$student->_id)}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add New'}}</a>
      </div>
    </div>
    <div class="container col-md-8 col-md-offset-2" >

      <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Guardian Information</h3>
        </div>


        <div class="panel-body">

                @foreach($data as $guardian)
                        <div class="panel panel-default">
                           <div class="panel-body">
                             <div class="row">

                                   <div class=" col-md-6">

                                           <table class="table table-user-information">

                                               <tr><td>Name</td><td>{{$guardian->first_name}} &nbsp;{{$guardian->last_name}}</td><tr>
                                               <tr><td>Occupation</td><td>{{$guardian->occupation}}</td><tr>
                                               <tr><td>Relationship</td><td>{{$guardian->relationship}}</td><tr>
                                               <tr><td>Status</td><td>{{$guardian->status}}</td><tr>
                                               <tr><td>Email</td><td>{{$guardian->email}}</td><tr>

                                           </table>

                                   </div>
                                   <div class="col-md-6">
                                         <div class="panel panel-default">
                                           <div class="panel-heading">Address</div>
                                           <div class="panel-body">
                                             <address>
                                               <strong>{{$guardian->Address->Line1}}</strong><br>
                                               {{$guardian->Address->Line2}}<br>
                                               {{$guardian->Address->City}}<br>
                                               {{$guardian->Address->State}},{{$guardian->Address->Country}}<br>
                                               <abbr title="Phone">Ph:</abbr> {{$guardian->Address->Land_Phone}}<br/>
                                               <abbr title="Mob">Mob:</abbr>{{$guardian->Address->Mobile_Number}}
                                             </address>
                                           </div>
                                         </div>
                                   </div>
                                 </div>
                           </div>
                           <div class="panel-footer">
                             <a class="btn btn-labeled btn-success" href="{{route('students.guardian_info.edit',[$student->_id,$loop->index])}}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ 'edit' }}</a>
                             <span class="pull-right">
                               <form action="{{ route('students.guardian_info.destroy', [$student->_id,$loop->index])}}" method="post" class="delete">
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
