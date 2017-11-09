@extends('student_layout1',['student'=>$student])
@section('page_heading','Student Feedbacks')
@section('section')
<?php

$myDateSort = function($obj1, $obj2) {
  $date1 = strtotime($obj1->created_at);
  $date2 = strtotime($obj2->created_at);
  return $date2 - $date1;
};
$sorted=array();
$active=array();
foreach($student->feedbacks as $feedback)
{
  array_push($sorted,$feedback);
}
usort($sorted,$myDateSort);
$json=json_decode($student);
?>

@section('section')
<?php
if(!(isset($json->feedbacks) && !empty($json->feedbacks)))
{ ?>
  <br/><br/>
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-danger">
                  <div class="panel-heading"><span class="glyphicon glyphicon-warning-sign">&nbsp;</span>No Information found</div>

                  <div class="panel-body">
                      <p>No Feedbacks has been added to the student.</p><br/>
                      <div class="models--actions">
                          <a class="btn btn-labeled btn-success" href="{{route('students.feedback.create',[\Auth::user()->roles()->first()->name,$student->_id])}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add Info'}}</a>
                      </div>

                  </div>
              </div>
          </div>
      </div>
  </div>
<?php }
else {

  ?>


<div class="container">
  <div class="row">




          <div class="model--actions">
              <a class="btn btn-labeled btn-success" href="{{route('students.feedback.create',[\Auth::user()->roles()->first()->name,$student->_id])}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add New'}}</a>
          </div>


          <div class="panel-group" id="accordion1">

                @foreach($sorted as $feedback)

                     <div class="col-md-10 col-md-offset-1">
                        <br/>
                      <div class="panel panel-default">
                         <div class="panel-heading">
                                <span class="label label-primary">{{$loop->index+1}}</span>
                              {{$feedback->created_by}} on<a data-toggle="collapse" data-parent="#accordion1" href="#collapse{{$feedback->_id}}"> {{Carbon\Carbon::parse($feedback->created_at)->format('F j, Y')}}</a>

                          </div>
                         <div id="collapse{{$feedback->_id}}" class="panel-collapse collapse">
                           <div class="panel-body">
                             <div class="row">
                               <div class="col-md-6">
                                 <div class="panel panel-primary">
                                    <div class="panel-heading">Feedbacks</div>
                                    <div class="panel-body" style="min-height: 300;overflow-y: scroll;">
                                      <p><?php echo $feedback->content; ?></p>
                                    </div>
                                    <div class="panel-footer label-primary">

                                        <form action="{{ route('students.feedback.destroy',[\Auth::user()->roles()->first()->name,$student->_id,$feedback->_id])}}" method="post" class="delete">
                                          <input type="hidden" name="_method" value="DELETE">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <a href="{{route('students.feedback.edit',[\Auth::user()->roles()->first()->name,$student->_id,$feedback->_id])}}"  type="button" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ 'Edit' }}</a>
                                          <button type="submit"  class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ 'delete' }}</button>
                                         </form>

                                    </div>
                                  </div>

                                </div>
                                <div class="col-md-6">
                                  <div class="panel panel-default">
                                     <div class="panel-heading">Comments <span class="badge pull-right">{{$feedback->comments()->count()}}</span></div>
                                       <div class="panel-body">
                                         <div class="actionBox">
                                           <ul class="commentList">

                                             <?php if(isset($feedback->comments))
                                             {
                                              foreach($feedback->comments as $comment)
                                              {
                                                if($comment->author== \Auth::user()->name)
                                                {
                                                  echo '<li>
                                                      <div class="commenterImage1">
                                                        <img src="http://placekitten.com/45/45" />
                                                      </div>
                                                      <div class="commentText">
                                                          <p class="">'.$comment->content.'</p> <span class="date sub-text"><a href="">'.$comment->author.'</a></span>
                                                      </div>
                                                  </li>';
                                                }
                                                else
                                                {
                                                  echo '<li>
                                                      <div class="commenterImage1">
                                                        <img src="http://placekitten.com/45/45" />
                                                      </div>
                                                      <div class="commentText">
                                                          <p class="">'.$comment->content.'</p> <span class="date sub-text"><a href="">'.$comment->author.'</a></span>
                                                      </div>
                                                  </li>';
                                                }

                                              }
                                              }
                                            else
                                            {
                                              echo '<li>

                                                  <div class="commentText">
                                                      <p class="">No comments yet.....</p>
                                                  </div>
                                              </li>';
                                            }

                                             ?>

                                           </ul>
                                         </div>
                                       </div>
                                       <div class="panel-footer">
                                         <form class="form" action="{{route('students.feedback.comment.store',[\Auth::user()->roles()->first()->name,$student->_id,$feedback->_id])}}" method="POST">
                                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                           <textarea class="form form-control" placeholder="Comments........" name="comment"></textarea>
                                           <br/><button type="submit" class="btn btn-labeld btn-default">Post</button>
                                         </form>


                                       </div>
                                   </div>
                                 </div>
                             </div>

                           </div>
                           <div class="panel-footer">



                           </div>



                         </div>



                        </div>
                      </div>
                    @endforeach
          </div>







  </div>


<?php

}
?>
@endsection

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
    max-height:150px;
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
