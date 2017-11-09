@extends('student_layout1',['student'=>$student])
@section('page_heading','Student Background Info')
<?php
$json=json_decode($student);
?>
@section('section')
<?php
if(!(isset($json->background_info) && !empty($json->background_info)))
{ ?>
  <br/><br/>
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-danger">
                  <div class="panel-heading"><span class="glyphicon glyphicon-warning-sign">&nbsp;</span>No Information found</div>

                  <div class="panel-body">
                      <p>No Background Information has been added to the student.</p><br/>
                      <div class="models--actions">
                          <a class="btn btn-labeled btn-success" href="{{route('students.background_info.create',$student->_id)}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add Info'}}</a>
                      </div>

                  </div>
              </div>
          </div>
      </div>
  </div>
<?php }
else {
  $data=$json->background_info;
  ?>


<div class="container">
  <div class="row">

    <div class="container col-md-8 col-md-offset-2" >
      <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Background Information</h3>
        </div>
        <div class="panel-body">
          <div class="col-md-5   pull-right ">
               <A href="{{route('students.background_info.create',$student->_id)}}" >Add Background Information</A><br/>
               <p class=" text-info">Last Updated:{{Carbon\Carbon::parse($student->updated_at)->format('F j, Y')}} </p>
          </div>

                @foreach($json->background_info as $data)
                     <?php
                     $result_explode = explode('|', $data->Info_Type); ?>
                     <div class="col-md-8 col-md-offset-2">

                        <div class="panel panel-default">
                          <span class="label label-primary">{{$loop->index+1}}</span>
                           <div class="panel-body">
                             <p>{{$data->Description}}</p>
                           </div>
                           <div class="panel-footer">
                             <a  href="">{{$result_explode[1]}}</a>
                             <span class="pull-right">
                               <form action="{{ route('students.background_info.destroy', [$student->_id,$loop->index])}}" method="post" class="delete">
                                 <input type="hidden" name="_method" value="DELETE">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <a href="{{route('students.background_info.edit', [$student->_id,$loop->index])}}"  data-toggle="tooltip" title="edit" type="button" class="btn btn-labeled btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                                 <button type="submit" data-toggle="tooltip" title="delete" class="btn btn-labeled btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                                </form>
                             </span>
                           </div>
                         </div>
                       </div>

                    @endforeach



          </div>
        </div>

    </div>
  </div>
  </div>


</div>

<?php

}
?>
@endsection
