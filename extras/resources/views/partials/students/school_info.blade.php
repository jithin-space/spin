
<?php
if(!(isset($json->school_info) && !empty($json->school_info)))
{ ?>
  <br/><br/>
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                  <div class="panel-heading">No Information found</div>

                  <div class="panel-body">
                      <p>No School Information has been added to the student.</p><br/>
                      <div class="models--actions">
                          <a class="btn btn-labeled btn-primary" href="{{route('students.school_info.create',$student->_id)}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add Info'}}</a>
                      </div>

                  </div>
              </div>
          </div>
      </div>
  </div>
  <?php }
  else {
    echo "helloooooo";
    $data=$json->school_info;
    ?>

  @foreach($data as $school)
    <div class="container">
      <div class="row">
        <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
             <A href="" >Edit Background Information</A><br/>
             <p class=" text-info">Last Updated:May 05,2014,03:00 pm </p>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">School Information</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                    <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{$student->firstMedia('profile')->getUrl()}}" class="img-circle img-responsive"> </div>

                    <div class=" col-md-9 col-lg-9 ">
                      <table class="table table-user-information">
                        <tbody>
                          <tr><td>School Name</td><td>{{$school->school_name}}</td><tr>
                          <tr><td>School Type</td><td>{{$school->school_type}}</td><tr>
                          <tr><td>Year Of Joining</td><td>{{$school->Year_Of_Joining}}</td><tr>
                          <tr><td>Year Of Completion</td><td>{{$school->Year_Of_Completion}}</td><tr>
                          <tr><td>Status</td><td>{{$school->status}}</td><tr>
                          <tr><td>Email</td><td>{{$school->email}}</td><tr>
                          <tr><td rowspan="6">Address</td><td>{{$school->Address->Line1}}</td></tr>
                                              <tr><td>{{$school->Address->Line2}}</td></tr>
                                              <tr><td>{{$school->Address->City}}</td></tr>
                                              <tr><td>{{$school->Address->State}}</td></tr>
                                              <tr><td>{{$school->Address->Country}}</td></tr>
                                              <tr><td>{{$school->Address->PostCode}}</td></tr>
                          <tr><td>LandLine</td><td>{{$school->Address->Land_Phone}}</td><tr>
                          <tr><td>Mobile</td><td>{{$school->Address->Mobile_Number}}</td><tr>
                        </tbody>
                      </table>

                      <a href="{{route('students.school_info.create',$student->_id)}}" class="btn btn-primary">Add New school</a>

                    </div>
                  </div>
            </div>
            <div class="panel-footer">
                   <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                   <span class="pull-right">
                     <form action="{{ route('students.school_info.destroy', [$student->_id,$loop->index])}}" method="post">
                       <input type="hidden" name="_method" value="DELETE">
                       <input type="hidden" name="_token" value="{{ csrf_token() }}">
                         <a href="{{route('students.school_info.edit',[$student->_id,$loop->index])}}" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                         <button type="submit" data-toggle="tooltip" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                     </form>
                   </span>
            </div>
        </div>
      </div>
      </div>


    </div>
  @endforeach;
  <?php

  }
  ?>
