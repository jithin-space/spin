@extends('student_layout1',['student'=>$data[0]])
@section('page_heading','Student IEP')
@section('section')


<?php $ieps=$data[1]; $student=$data[0]; ?>
<div class="row">
   <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h4>IEP ({{$ieps->status}})</h4>
         </div>
         <div class="panel-body">
                     <table class="table well">
                        <tr class="row">
                           <td class="col-md-4 alert warning">Objective Description</td>
                           <td class="col-md-8 alert info">{{$ieps->description}}</td>
                        </tr>
                        <tr class="row">
                           <td class="col-md-4 alert success">Long Term Objective</td>
                           <td class="col-md-8 alert warning">{{$ieps->lto_description}}</td>
                        </tr>
                        <tr class="row">
                           <td class="col-md-4 alert danger">Goal Area</td>
                           <td class="col-md-8 alert success">{{$ieps->goal_area_description}}</td>
                        </tr>
                        <tr class="row">
                           <td class="col-md-4 alert info">Example Activity</td>
                           <td class="col-md-8 alert danger"><?php echo($ieps->example_activity); ?></td>
                        </tr>
                        <tr class="row">
                           <td class="col-md-4 alert warning">Created At</td>
                           <td class="col-md-8 alert info"><?php echo($ieps->created_at->format('d-m-Y')); ?></td>
                        </tr>
                        <tr class="row">
                           <td class="col-md-4 alert success">Last Status Update</td>
                           <td class="col-md-8 alert warning"><?php echo date('d-m-Y',strtotime($ieps->date['date'])); ?></td>
                        </tr>
                        <tr class="row">
                           <td class="col-md-4">
                             <button data-toggle="collapse" data-target="#home{{$ieps->_id}}" class="btn btn-primary">Comments&nbsp;&nbsp;<span class="badge">{{count($ieps->comments)}}</span></button>
                           </td>
                           <td class="col-md-8">
                             <div class="pull-right">
                             <form action="{{ route('students.iep.destroy',[\Auth::user()->roles()->first()->name,$student->_id,$ieps->_id])}}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <a class="btn btn-labeled btn-default" href="{{route('students.iep.edit',[\Auth::user()->roles()->first()->name,$student->_id,$ieps->_id])}}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ 'edit' }}</a>
                                <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ 'delete' }}</button>
                             </form>
                           </div>
                            </td>
                        </tr>
                     </table>

                     <div id="home{{$ieps->_id}}" class="collapse">
                        <div class="panel panel-default">
                           <div class="panel-heading">Comments</div>
                           <div class="panel-body">
                              <div class="actionBox">
                                 <ul class="commentList">
                                    <?php
                                       if(isset($ieps->comments)&& (count($ieps->comments) > 0 )){

                                         $sor=$ieps->comments->sortByDesc('created_at');


                                         foreach($sor as $comment)
                                         {
                                                echo '<li> <div class="commenterImage1"><img src="http://placekitten.com/45/45" />
                                                   </div><div class="commentText"><p class="">'.$comment->content.'</p> <span class="date sub-text"><a href="">'.$comment->author.'</a>&nbsp;On&nbsp;'.$comment->created_at->format('F j ,Y').'</span>
                                                   </div></li>';

                                          }
                                       }
                                       else{
                                         echo '<li><div class="commentText"><p class="">No comments yet.....</p></div></li>';
                                       }

                                       ?>
                                 </ul>
                              </div>
                           </div>
                           <div class="panel-footer">
                              <form id="test" class="" action="{{route('students.iep.comment.store',[\Auth::user()->roles()->first()->name,$student->_id,$ieps->_id])}}" method="POST">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                 <textarea class="form form-control" placeholder="Comments........" name="comment"></textarea>
                                 <button type="submit" class="btn btn-labeld btn-default">Post</button>
                              </form>
                           </div>
                        </div>
                     </div>
         </div>
      </div>
   </div>
   <div class="col-lg-4">
   </div>
</div>
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
