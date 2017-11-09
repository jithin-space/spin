
<?php
if(!(isset($json->strength_info) && !(empty($json->strength_info->strength)&&empty($json->strength_info->weakness)&&
empty($json->strength_info->special_interests))))
{ ?>
  <br/><br/>
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                  <div class="panel-heading">No Information found</div>

                  <div class="panel-body">
                      <p>No Strength Information has been added to the student.</p><br/>
                      <div class="models--actions">
                          <a class="btn btn-labeled btn-primary" href="{{route('students.strength_info.create',$student->_id)}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add Info'}}</a>
                      </div>

                  </div>
              </div>
          </div>
      </div>
  </div>
  <?php }
  else {
    echo "helloooooo";
    $da=$json->strength_info;
    \Debugbar::info($da->weakness);
if((isset($da->strength) && !empty($da->strength)))
{ ?>
  @foreach($da->strength as $strength)
    <div class="container">
      <div class="row">
        <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
             <A href="" >Edit strength Information</A><br/>
             <p class=" text-info">Last Updated:May 05,2014,03:00 pm </p>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">strength Information</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                    <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{$student->firstMedia('profile')->getUrl()}}" class="img-circle img-responsive"> </div>

                    <div class=" col-md-9 col-lg-9 ">
                      <table class="table table-user-information">
                        <tbody>
                          <tr><td> Name</td><td>{{$strength->name}}</td><tr>
                          <tr><td>strength Type</td><td>{{$strength->strength_type}}</td><tr>
                          <tr><td>Description</td><td>{{$strength->description}}</td><tr>
                          <tr><td>Remarks</td><td>{{$strength->remarks}}</td><tr>
                        </tbody>
                      </table>

                      <a href="{{route('students.strength_info.create',$student->_id)}}" class="btn btn-primary">Add New strength</a>

                    </div>
                  </div>
            </div>
            <div class="panel-footer">
                   <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                   <span class="pull-right">
                     <form action="{{ route('students.strength_info.destroy', [$student->_id,$loop->index.'.1'])}}" method="post">
                       <input type="hidden" name="_method" value="DELETE">
                       <input type="hidden" name="_token" value="{{ csrf_token() }}">
                         <a href="{{route('students.strength_info.edit',[$student->_id,$loop->index.'.1'])}}" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                         <button type="submit" data-toggle="tooltip" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                     </form>
                   </span>
            </div>
        </div>
      </div>
      </div>


    </div>
  @endforeach;
<?php }
if((isset($da->weakness) && !empty($da->weakness)))
{ echo "weakness" ?>
  @foreach($da->weakness as $weakness)
    <div class="container">
      <div class="row">
        <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
             <A href="" >Edit Weakness Information</A><br/>
             <p class=" text-info">Last Updated:May 05,2014,03:00 pm </p>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Weakness Information</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                    <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{$student->firstMedia('profile')->getUrl()}}" class="img-circle img-responsive"> </div>

                    <div class=" col-md-9 col-lg-9 ">
                      <table class="table table-user-information">
                        <tbody>
                          <tr><td> Name</td><td>{{$weakness->name}}</td><tr>
                          <tr><td>strength Type</td><td>{{$weakness->weakness_type}}</td><tr>
                          <tr><td>Description</td><td>{{$weakness->description}}</td><tr>
                          <tr><td>Remarks</td><td>{{$weakness->remarks}}</td><tr>
                        </tbody>
                      </table>

                      <a href="{{route('students.strength_info.create',$student->_id)}}" class="btn btn-primary">Add New Weakness</a>

                    </div>
                  </div>
            </div>
            <div class="panel-footer">
                   <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                   <span class="pull-right">
                     <form action="{{ route('students.strength_info.destroy', [$student->_id,$loop->index.'.2'])}}" method="post">
                       <input type="hidden" name="_method" value="DELETE">
                       <input type="hidden" name="_token" value="{{ csrf_token() }}">
                         <a href="{{route('students.strength_info.edit',[$student->_id,$loop->index.'.2'])}}" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                         <button type="submit" data-toggle="tooltip" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                     </form>
                   </span>
            </div>
        </div>
      </div>
      </div>


    </div>
  @endforeach;
<?php }
if((isset($da->special_interests) && !empty($da->special_interests)))
{ ?>
  @foreach($da->special_interests as $strength)
    <div class="container">
      <div class="row">
        <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
             <A href="" >Edit strength Information</A><br/>
             <p class=" text-info">Last Updated:May 05,2014,03:00 pm </p>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Special Interest Information</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                    <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{$student->firstMedia('profile')->getUrl()}}" class="img-circle img-responsive"> </div>

                    <div class=" col-md-9 col-lg-9 ">
                      <table class="table table-user-information">
                        <tbody>
                          <tr><td> Name</td><td>{{$strength->name}}</td><tr>
                          <tr><td>strength Type</td><td>{{$strength->interest_type}}</td><tr>
                          <tr><td>Description</td><td>{{$strength->description}}</td><tr>
                          <tr><td>Remarks</td><td>{{$strength->remarks}}</td><tr>
                        </tbody>
                      </table>

                      <a href="{{route('students.strength_info.create',$student->_id)}}" class="btn btn-primary">Add New strength</a>

                    </div>
                  </div>
            </div>
            <div class="panel-footer">
                   <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                   <span class="pull-right">
                     <form action="{{ route('students.strength_info.destroy', [$student->_id,$loop->index.'.3'])}}" method="post">
                       <input type="hidden" name="_method" value="DELETE">
                       <input type="hidden" name="_token" value="{{ csrf_token() }}">
                         <a href="{{route('students.strength_info.edit',[$student->_id,$loop->index.'3'])}}" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                         <button type="submit" data-toggle="tooltip" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                     </form>
                   </span>
            </div>
        </div>
      </div>
      </div>


    </div>
  @endforeach;

<?php }


  }
  ?>
