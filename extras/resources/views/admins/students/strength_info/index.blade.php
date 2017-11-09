@extends('student_layout1',['student',$student])
@section('page_heading','Strength & Weakness Info')
<?php
$json=json_decode($student);
?>

@section('section')


<div class="container-fluid">
  <div class="row">
  <div class="models--actions pull-right">
      <a class="btn btn-labeled btn-success" href="{{route('students.strength_info.create',$student->_id)}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add Info'}}</a>
  </div>
</div>
  <br/>
  <div class="row">
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">strength Information</h3>
        </div>
        <?php
        if(!(isset($json->strength_info) && !(empty($json->strength_info->strength))))
        { ?>

          <div class="panel-body">
              <p>No Strength Information has been added to the student.</p>
              <div class="models--actions">
                  <a class="btn btn-labeled btn-success" href="{{route('students.strength_info.create',$student->_id)}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add Info'}}</a>
              </div>
          </div>


        <?php }
        else {

          $da=$json->strength_info;
          if((isset($da->strength) && !empty($da->strength)))
          { ?>
            <!--  -->
            <div class="panel-body">
              @foreach($da->strength as $strength)

                  <div class="panel panel-default">
                    <div class="panel-body">

                      <a href="#" data-toggle="popover" title="Remarks" data-content="{{$strength->remarks}}">{{$strength->description}}</a>
                    </div>
                    <div class="panel-footer">
                      <a>{{$strength->strength_type}}</a>
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


              @endforeach

            </div>
<!--  -->
            <?php }
          } ?>

      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-danger">
        <div class="panel-heading">
            <h3 class="panel-title">weakness Information</h3>
        </div>
        <?php
        if(!(isset($json->strength_info) && !(empty($json->strength_info->weakness))))
        { ?>

          <div class="panel-body">
              <p>No Weakness Information has been added to the student.</p>
              <div class="models--actions">
                  <a class="btn btn-labeled btn-success" href="{{route('students.strength_info.create',$student->_id)}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add Info'}}</a>
              </div>
          </div>


        <?php }
        else {

          $da=$json->strength_info;
          if((isset($da->weakness) && !empty($da->weakness)))
          { ?>
            <!--  -->
            <div class="panel-body">
              @foreach($da->weakness as $strength)

                  <div class="panel panel-default">
                    <div class="panel-body">

                      <a href="#" data-toggle="popover" title="Remarks" data-content="{{$strength->remarks}}">{{$strength->description}}</a>
                    </div>
                    <div class="panel-footer">
                      <a>{{$strength->weakness_type}}</a>
                      <span class="pull-right">
                        <form action="{{ route('students.strength_info.destroy', [$student->_id,$loop->index.'.2'])}}" method="post">
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <a href="{{route('students.strength_info.edit',[$student->_id,$loop->index.'.2'])}}" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <button type="submit" data-toggle="tooltip" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                        </form>
                      </span>
                    </div>
                  </div>


              @endforeach

            </div>
<!--  -->
            <?php }
          } ?>

      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">special interests</h3>
        </div>
        <?php
        if(!(isset($json->strength_info) && !(empty($json->strength_info->special_interests))))
        { ?>

          <div class="panel-body">
              <p>No Special Interests has been added to the student.</p>
              <div class="models--actions">
                  <a class="btn btn-labeled btn-success" href="{{route('students.strength_info.create',$student->_id)}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add Info'}}</a>
              </div>

          </div>


        <?php }
        else {

          $da=$json->strength_info;
          if((isset($da->special_interests) && !empty($da->special_interests)))
          { ?>
            <!--  -->
            <div class="panel-body">
              @foreach($da->special_interests as $strength)

                  <div class="panel panel-default">
                    <div class="panel-body">

                      <a href="#" data-toggle="popover" title="Remarks" data-content="{{$strength->remarks}}">{{$strength->description}}</a>
                    </div>
                    <div class="panel-footer">
                      <a>{{$strength->interest_type}}</a>
                      <span class="pull-right">
                        <form action="{{ route('students.strength_info.destroy', [$student->_id,$loop->index.'.3'])}}" method="post">
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <a href="{{route('students.strength_info.edit',[$student->_id,$loop->index.'.3'])}}" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <button type="submit" data-toggle="tooltip" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                        </form>
                      </span>
                    </div>
                  </div>


              @endforeach

            </div>
        <!--  -->
            <?php }
          }
         ?>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });
 </script>
@endsection
