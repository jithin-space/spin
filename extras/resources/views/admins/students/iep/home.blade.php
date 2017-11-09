@extends('student_layout1',['student'=>$student])
@section('page_heading','Student IEPs')
@section('section')
<?php
   $json=json_decode($student);
   $active=array();
   foreach($student->ieps as $iep)
   {
     if($iep->status=="Active")
     {
       array_push($active,$iep);
     }
   }

   \Debugbar::info(count($active));
   ?>
<?php
   if(!(isset($json->ieps) && !empty($json->ieps)))
   { ?>
<br/><br/>
<div class="container">
   <div class="row">
      <div class="col-md-8 col-md-offset-2">
         <div class="panel panel-danger">
            <div class="panel-heading"><span class="glyphicon glyphicon-warning-sign">&nbsp;</span>No Information found</div>
            <div class="panel-body">
               <p>No IEP  has been added to the student.</p>
               <br/>
               <div class="models--actions">
                  <a class="goal btn btn-labeled btn-success" href="{{route('students.iep.create',[\Auth::user()->roles()->first()->name,$student->_id])}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add New IEP'}}</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php }
   else {
     ?>
<?php
   $result = array();
   $goal_tag=array();
   $lto_tag=array();
   foreach($json->ieps as $data)
   {
     $ga=$data->goal_area;
     $lts = $data->long_term_objective;
     if(isset($result[$ga]))
     {
       if(isset($result[$ga][$lts]))
       {
         $result[$ga][$lts][]=$data;
       }
       else{
         $result[$ga][$lts]=array($data);
         $lto_tag[$ga][$lts]=$data->lto_description;
       }
     }
     else {
       $result[$ga][$lts]=array($data);
       $goal_tag[$ga]=$data->goal_area_description;
       $lto_tag[$ga][$lts]=$data->lto_description;
     }

   }

   ?>
<div class="row">
<div class="col-md-10 col-md-offset-1">
   <div class="models--actions" style="float:right">
      <a class="goal btn btn-labeled btn-success" href="{{route('students.iep.create',[\Auth::user()->roles()->first()->name,$student->_id])}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add New IEP'}}</a>
      <a class="goal btn btn-labeled btn-danger" target="_blank"
         href="http://192.168.1.2/SPACE-SEP/src/long_term_goal_view.php?student_id={{$student->student_id}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Go to Old IPP'}}</a>
   </div>
   <br/><br/>
   <div class="just-padding ">
      <div class="list-group list-group-root well">
         @foreach($result as $ga=>$lts)
         <a data-toggle="collapse" class="list-group-item panel-success" href="#{{$ga}}">
            <h4><i class="glyphicon glyphicon-chevron-right"></i>
               {{$loop->index+1}}:{{$goal_tag[$ga]}}
            </h4>
         </a>
         <div class="list-group collapse" id="{{$ga}}">
            @foreach($lts as $lto=>$value)
            <a href="#{{$loop->parent->index}}{{$loop->index}}ltos" class="list-group-item" data-toggle="collapse">
               <h4><i class="glyphicon glyphicon-chevron-right"></i>{{$lto_tag[$ga][$lto]}}<span class="badge pull-right">{{count($value)}}</span></h4>
            </a>
            <div class="list-group collapse" id="{{$loop->parent->index}}{{$loop->index}}ltos">
               @foreach($value as $iep)
               <div class="list-group-item">{{$loop->index+1}}:{{$iep->description}}&nbsp;<a href="{{ route('students.iep.show',[\Auth::user()->roles()->first()->name,$student->_id,$iep->_id->{'$oid'}])}}">view</a></div>
               @endforeach
            </div>
            @endforeach
         </div>
         @endforeach
      </div>
   </div>
</div>
</div>
<?php } ?>
<script>
   $(function() {

     $('.list-group-item').on('click', function() {
       $('.glyphicon', this)
         .toggleClass('glyphicon-chevron-right')
         .toggleClass('glyphicon-chevron-down');
     });
   });



</script>
<style>
   .just-padding {
   padding: 15px;
   }
   .list-group.list-group-root {
   padding: 0;
   overflow: hidden;
   border:0;
   }

   .list-group.list-group-root .list-group {
   margin-bottom: 0;
   }
   .list-group.list-group-root .list-group-item {
   border:0;
   border-radius: 0;
   border-width: 1px 0 0 0;
   }
   .list-group.list-group-root > .list-group-item:first-child {
   border-top-width: 0;
   }
   .list-group.list-group-root > .list-group > .list-group-item {
   padding-left: 45px;
   }
   .list-group.list-group-root > .list-group > .list-group > .list-group-item {
   padding-left: 70px;
   }
   .list-group-item .glyphicon {
   margin-right: 5px;
   }
   .detailBox {
   width:320px;
   border:1px solid #bbb;
   margin:50px;
   }
   .titleBox {
   background-color:#fdfdfd;
   padding:10px;
   }
   .titleBox label{
   color:#444;
   margin:0;
   display:inline-block;
   }
   .commentBox {
   padding:10px;
   border-top:1px dotted #bbb;
   }
   .commentBox .form-group:first-child, .actionBox .form-group:first-child {
   width:80%;
   }
   .commentBox .form-group:nth-child(2), .actionBox .form-group:nth-child(2) {
   width:18%;
   }
   .actionBox .form-group * {
   width:100%;
   }
   .taskDescription {
   margin-top:10px 0;
   }
   .commentList {
   padding:0;
   list-style:none;
   max-height:200px;
   overflow:auto;
   }
   .commentList li {
   margin:0;
   margin-top:10px;
   }
   .commentList li > div {
   display:table-cell;
   }
   .commenterImage1 {
   width:30px;
   margin-right:5px;
   height:100%;
   /*float:left;*/
   }
   .commenterImage2{
   width:30px;
   margin-right:5px;
   height:100%;
   float:right;
   }
   .commenterImage1 img {
   width:100%;
   border-radius:50%;
   }
   .commenterImage2 img {
   width:100%;
   border-radius:50%;
   }
   .commentText p {
   margin:0;
   }
   .sub-text {
   color:#aaa;
   font-family:verdana;
   font-size:11px;
   }
   .actionBox {
   border-top:1px dotted #bbb;
   padding:10px;
   }
</style>
@endsection
