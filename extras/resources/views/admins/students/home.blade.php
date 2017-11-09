@extends('student_layout1',['student'=>$student])
@section('page_heading','Student Dashboard')
@section('section')

<?php

$myDateSort = function($obj1, $obj2) {
  $date1 = strtotime($obj1->updated_at);
  $date2 = strtotime($obj2->updated_at);
  return $date2 - $date1;
};
$sorted=array();
$active=array();
foreach($student->feedbacks as $feedback)
{
  array_push($sorted,$feedback);


}


$data=$student->ieps;
foreach($data as $iep)
{

      array_push($sorted,$iep);
      if($iep->status=="Active")
      {
        array_push($active,$iep);
      }

}


usort($sorted,$myDateSort);

?>

  <div class="row">
      <div class="col-lg-3 col-md-6">
          <div class="panel panel-primary">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="fa fa-comments fa-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge">{{count($active)}}+</div>
                          <div>Active IEPs!</div>
                      </div>
                  </div>
              </div>
              <a href="{{route('students.iep.active',[\Auth::user()->roles()->first()->name,$student->_id])}}">
                  <div class="panel-footer">
                      <span class="pull-left">View Active IEPs</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                  </div>
              </a>
          </div>
      </div>
      <div class="col-lg-3 col-md-6">
          <div class="panel panel-green">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="fa fa-tasks fa-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge">{{$student->feedbacks()->count()}}+</div>
                          <div>Feedbacks!</div>
                      </div>
                  </div>
              </div>
              <a href="{{route('students.feedback.index',[\Auth::user()->roles()->first()->name,$student->_id])}}">
                  <div class="panel-footer">
                      <span class="pull-left">View Details</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                  </div>
              </a>
          </div>
      </div>

      <div class="col-lg-3 col-md-6">
          <div class="panel panel-yellow">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="fa fa-shopping-cart fa-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge">{{count($student->ieps)}}</div>
                          <div> IEPs!</div>
                      </div>
                  </div>
              </div>
              <a href="{{route('students.iep.index',[\Auth::user()->roles()->first()->name,$student->_id])}}">
                  <div class="panel-footer">
                      <span class="pull-left">View Details</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                  </div>
              </a>
          </div>
      </div>
      <div class="col-lg-3 col-md-6">
          <div class="panel panel-red">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="fa fa-graduation-cap fa-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge">{{count($student->attendances)}}</div>
                          <div>Insight Classes</div>
                      </div>
                  </div>
              </div>
              <a href="{{ route('students.attendance.index',[\Auth::user()->roles()->first()->name,$student->_id])}}">
                  <div class="panel-footer">
                      <span class="pull-left">View All</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                  </div>
              </a>
          </div>
      </div>
  </div>

<div class="container">
                @foreach($sorted as $response)
                    @if(count($response->comments) > 0)
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                           @if(class_basename($response)=="IEP")
                          <div class="panel panel-danger">
                            @else
                          <div class="panel panel-success">
                           @endif


                             <div class="panel-heading">
                                   <?php
                                    $latest=$response->comments()->orderBy('created_at','desc')->last();
                                    ?>
                                    {{$latest->author}}&nbsp;commented &nbsp;
                                    @if($latest->created_at->diffInMinutes(Carbon\Carbon::now())< 60)
                                    {{$latest->created_at->diffInMinutes(Carbon\Carbon::now())}} minutes ago
                                    @elseif($latest->created_at->diffInHours(Carbon\Carbon::now())< 25)
                                    {{$latest->created_at->diffInHours(Carbon\Carbon::now())}} Hour Ago
                                    @elseif($latest->created_at->diffInDays(Carbon\Carbon::now()) < 31)
                                    {{$latest->created_at->diffInDays(Carbon\Carbon::now())}} Day Ago
                                    @elseif($latest->created_at->diffInMonths(Carbon\Carbon::now())< 12)
                                    {{$latest->created_at->diffInMonths(Carbon\Carbon::now())}} Month Ago
                                    @else
                                    {{$latest->created_at->diffInYears(Carbon\Carbon::now())}} Year Ago
                                    @endif

                             </div>

                              <div class="panel-body">

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="panel panel-default" >
                                        <div class="panel-heading">
                                          {{class_basename($response)}}
                                        </div>

                                          @if(class_basename($response)=="IEP")
                                          <div class="panel-body" style="min-height: 185;overflow-y: scroll;">
                                          <p class="content"><?php echo $response->description; ?></p>
                                          </div>
                                          <div class="panel-footer">
                                              <a href=""> view </a>
                                          </div>
                                           @else
                                           <div class="panel-body" style="min-height: 185;overflow-y: scroll;">
                                             <p class="content"><?php echo $response->content; ?></p>
                                           </div>
                                           <div class="panel-footer"> By <a href="">{{$response->created_by}}</a> on<a href=""> {{Carbon\Carbon::parse($response->updated_at)->format('F j, Y')}}</a></div>
                                          @endif


                                    </div>

                                    </div>
                                    <div class="col-md-6">
                                      <div class="panel panel-default">
                                          <div class="panel-heading">Comments <span class="badge pull-right">{{$response->comments()->count()}}</span></div>

                                              <div class="actionBox">
                                                <ul class="commentList">
                                              <?php
                                              foreach($response->comments as $comment)
                                              {
                                                  echo '<li><div class="commenterImage1">
                                                        <img src="http://placekitten.com/45/45" />
                                                        </div>
                                                        <div class="commentText">
                                                          <p class="">'.$comment->content.'</p> <span class="date sub-text"><a href="">'.$comment->author.'</a></span>
                                                        </div></li>';
                                                }
                                                ?>
                                              </ul>

                                              @if(class_basename($response)=="IEP")
                                              <form class="form" action="{{route('students.iep.comment.store',[\Auth::user()->roles()->first()->name,$student->_id,$response->_id])}}" method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <textarea class="form form-control" rows="1"placeholder="Comments........" name="comment"></textarea>
                                                <button type="submit" class="btn btn-labeld btn-default">Post</button>
                                              </form>
                                               @else
                                               <form class="form" action="{{route('students.feedback.comment.store',[\Auth::user()->roles()->first()->name,$student->_id,$response->_id])}}" method="POST">
                                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                 <textarea class="form form-control" rows="1" placeholder="Comments........" name="comment"></textarea>
                                                 <button type="submit" class="btn btn-labeld btn-default">Post</button>
                                               </form>
                                              @endif
                                            </div>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                            </div>
                          </div>

                    </div>
                     @endif
                @endforeach

</div>



<script>
$(".commentList").animate({ scrollTop: $(this).height() }, "slow");

  </script>
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
